<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 *
 * @version $Id$
 * @package phpMyAdmin
 */

/**
 *
 */
require_once './libraries/common.inc.php';

/**
 * Does the common work
 */
$GLOBALS['js_include'][] = 'server_privileges.js';
$GLOBALS['js_include'][] = 'functions.js';
$GLOBALS['js_include'][] = 'mootools.js';
$GLOBALS['js_include'][] = 'mootools_common.js';

require './libraries/server_common.inc.php';
require './libraries/replication.inc.php';
require './libraries/replication_gui.lib.php';
require_once './libraries/server_synchronize.lib.php';

/**
 * Checks if the user is allowed to do what he tries to...
 */
if (!$is_superuser) {
    require './libraries/server_links.inc.php';
    echo '<h2>' . "\n"
        . PMA_getIcon('s_replication.png')
        . $GLOBALS['strReplication'] . "\n"
        . '</h2>' . "\n";
    PMA_Message::error('strNoPrivileges')->display();
    require_once './libraries/footer.inc.php';
}

/**
 * Handling control requests
 */

if (isset($GLOBALS['sr_take_action'])) {
    $refresh = false;
    if (isset($GLOBALS['slave_changemaster'])) {
        $_SESSION['replication']['m_username'] = $sr['username'] = PMA_sqlAddslashes($GLOBALS['username']);
        $_SESSION['replication']['m_password'] = $sr['pma_pw']   = PMA_sqlAddslashes($GLOBALS['pma_pw']);
        $_SESSION['replication']['m_hostname'] = $sr['hostname'] = PMA_sqlAddslashes($GLOBALS['hostname']);
        $_SESSION['replication']['m_port']     = $sr['port']     = PMA_sqlAddslashes($GLOBALS['port']);
        $_SESSION['replication']['m_correct']  = '';
        $_SESSION['replication']['sr_action_status'] = 'error';
        $_SESSION['replication']['sr_action_info'] = $strReplicationUnknownError;
        $url = $sr['hostname'];

        if ($sr['port'] != '') {
            $url .= ':' . $sr['port'];
        }

        // Attempt to connect to the new master server
        $check_master = null;
        $old_error_reporting = error_reporting(0);
        $check_master = @mysql_connect($url, $sr['username'], $sr['pma_pw']);
        error_reporting($old_error_reporting);
        unset($url);

        if (!$check_master) {
            $_SESSION['replication']['sr_action_status'] = 'error';
            $_SESSION['replication']['sr_action_info'] = sprintf($GLOBALS['strReplicationErrorMasterConnect'], $sr['hostname']);
        } else {
            $link_to_master = PMA_replication_connect_to_master($sr['username'], $sr['pma_pw'], $sr['hostname'], $sr['port']);

            // Read the current master position
            $position = PMA_replication_slave_bin_log_master($link_to_master);

            if (empty($position)) {
                $_SESSION['replication']['sr_action_status'] = 'error';
                $_SESSION['replication']['sr_action_info'] = $GLOBALS['strReplicationErrorGetPosition'];
            } else {
                $_SESSION['replication']['m_correct']  = true;

                if (!PMA_replication_slave_change_master($sr['username'], $sr['pma_pw'], $sr['hostname'], $sr['port'], $position, true, false)) {
                    $_SESSION['replication']['sr_action_status'] = 'error';
                    $_SESSION['replication']['sr_action_info'] = $GLOBALS['strReplicationUnableToChange'];
                } else {
                    $_SESSION['replication']['sr_action_status'] = 'success';
                    $_SESSION['replication']['sr_action_info'] = sprintf($GLOBALS['strReplicationChangedSuccesfully'], $sr['hostname']);
                }
            }
        }
    } elseif (isset($GLOBALS['sr_slave_server_control'])) {
        if ($GLOBALS['sr_slave_action'] == 'reset') {
            PMA_replication_slave_control("STOP");
            PMA_DBI_try_query("RESET SLAVE;");
            PMA_replication_slave_control("START");
        } else {
            PMA_replication_slave_control($GLOBALS['sr_slave_action'], $GLOBALS['sr_slave_control_parm']);
        }
        $refresh = true;

    } elseif (isset($GLOBALS['sr_slave_skip_error'])) {
        $count = 1;
        if (isset($GLOBALS['sr_skip_errors_count'])) {
            $count = $GLOBALS['sr_skip_errors_count'] * 1;
        }
        PMA_replication_slave_control("STOP");
        PMA_DBI_try_query("SET GLOBAL SQL_SLAVE_SKIP_COUNTER = ".$count.";");
        PMA_replication_slave_control("START");

    } elseif (isset($GLOBALS['sl_sync'])) {
        // TODO username, host and port could be read from 'show slave status', 
        // when asked for a password this might work in more situations the just after changing master (where the master password is stored in session)
        $src_link = PMA_replication_connect_to_master($_SESSION['replication']['m_username'], $_SESSION['replication']['m_password'], $_SESSION['replication']['m_hostname'], $_SESSION['replication']['m_port']);
        $trg_link = null; // using null to indicate the current PMA server

        $data = PMA_DBI_fetch_result('SHOW MASTER STATUS', null, null, $src_link); // let's find out, which databases are replicated

        $do_db     = array();
        $ignore_db = array();
        $dblist    = array();

        if (!empty($data[0]['Binlog_Do_DB'])) {
            $do_db     = explode(',', $data[0]['Binlog_Do_DB']);
        }
        if (!empty($data[0]['Binlog_Ignore_DB'])) {
            $ignore_db = explode(',', $data[0]['Binlog_Ignore_DB']);
        }

        $tmp_alldbs = PMA_DBI_query('SHOW DATABASES;', $src_link);
        while ($tmp_row = PMA_DBI_fetch_row($tmp_alldbs)) {
            if ($tmp_row[0] == 'information_schema') {
                continue;
            }
            if (count($do_db) == 0) {
                if (array_search($tmp_row[0], $ignore_db) !== false) {
                    continue;
                }
                $dblist[] = $tmp_row[0];

                PMA_DBI_query('CREATE DATABASE IF NOT EXISTS '.$tmp_row[0], $trg_link);
            } else {
                if (array_search($tmp_row[0], $do_db) !== false) {
                    $dblist[] = $tmp_row[0];
                    PMA_DBI_query('CREATE DATABASE IF NOT EXISTS '.$tmp_row[0], $trg_link);
                }
            }	  
        } // end while

        unset($do_db, $ignore_db, $data);

        if (isset($GLOBALS['repl_data'])) {
            $include_data = true;
        } else {
            $include_data = false;
        }
        foreach ($dblist as $db) {
            PMA_replication_synchronize_db($db, $src_link, $trg_link, $include_data);
        }
        // TODO some form of user feedback error/success would be nice
        //  What happens if $dblist is empty?
        //  or sync failed?
    }

    if ($refresh) {
        Header("Location: ". PMA_generate_common_url($GLOBALS['url_params']));
    }
    unset($refresh);
}
/**
 * Displays the links
 */
require './libraries/server_links.inc.php';

echo '<div id="replication">'."\n";
echo ' <h2>'."\n";
echo '   <img class="icon" src="'. $GLOBALS['pmaThemeImage'] .'s_replication.png"  width="16" height="16" alt="" />'."\n";
echo     $GLOBALS['strReplication']."\n";
echo ' </h2>'."\n";

// Display error messages
if (isset($_SESSION['replication']['sr_action_status']) && isset($_SESSION['replication']['sr_action_info'])) {
    if ($_SESSION['replication']['sr_action_status'] == 'error') {
        PMA_Message::error($_SESSION['replication']['sr_action_info'])->display();
        $_SESSION['replication']['sr_action_status'] = 'unknown';
    } elseif ($_SESSION['replication']['sr_action_status'] == 'success') {
        PMA_Message::success($_SESSION['replication']['sr_action_info'])->display();
        $_SESSION['replication']['sr_action_status'] = 'unknown';
    }
}

if ($server_master_status) {
    if (!isset($GLOBALS['repl_clear_scr'])) {
        echo PMA_js_mootools_domready($jscode['master_replication']);
        echo '<fieldset>'."\n";
        echo '<legend>'. $GLOBALS['strReplicationMaster'] .'</legend>'."\n";
        echo $GLOBALS['strReplicationConfiguredMaster']."\n";
        echo '<ul>'."\n";
        echo '  <li><a href="#" id="master_status_href">'. $GLOBALS['strReplicationShowMasterStatus'] .'</a></li>' . "\n";
        PMA_replication_print_status_table('master', true, false);

        echo '  <li><a href="#" id="master_slaves_href">'. $GLOBALS['strReplicationShowConnectedSlaves'] .'</a></li>' . "\n";
        PMA_replication_print_slaves_table(true);

        $_url_params = $GLOBALS['url_params'];
        $_url_params['mr_adduser'] = true;
        $_url_params['repl_clear_scr'] = true;

        echo '  <li><a href="'.PMA_generate_common_url($_url_params).'" id="master_addslaveuser_href">'. $GLOBALS['strReplicationAddSlaveUser'] .'</a></li>';
    }

    // Display 'Add replication slave user' form
    if (isset($GLOBALS['mr_adduser'])) {
        PMA_replication_gui_master_addslaveuser();
    } elseif (!isset($GLOBALS['repl_clear_scr'])) {
        echo "</ul>\n";
        echo "</fieldset>\n";
    }
} elseif (!isset($GLOBALS['mr_configure']) && !isset($GLOBALS['repl_clear_scr'])) {
    $_url_params = $GLOBALS['url_params'];
    $_url_params['mr_configure'] = true;

    echo '<fieldset>'."\n";
    echo '<legend>'. $GLOBALS['strReplicationMaster'] .'</legend>'."\n";
    echo sprintf($GLOBALS['strReplicationServernConfiguredMaster'], PMA_generate_common_url($_url_params)) ."\n";
    echo '</fieldset>'."\n";
}

if (isset($GLOBALS['mr_configure'])) {
    // Render the 'Master configuration' section 
    echo PMA_js_mootools_domready($jscode['configure_master']);
    echo '<fieldset>'."\n";
    echo '<legend>'. $GLOBALS['strReplicationMasterConfiguration'] .'</legend>'."\n";
    echo $GLOBALS['strReplicationMasterChooseMode'].'<br /><br />'."\n";

    echo '<select name="db_type" id="db_type">'."\n";
    echo '<option value="all">'. $GLOBALS['strReplicationMasterChooseAll'] .'</option>'."\n";
    echo '<option value="ign">'. $GLOBALS['strReplicationMasterChooseIgn'] .'</option>'."\n";
    echo '</select>'."\n";
    echo '<br /><br />'."\n";
    echo $GLOBALS['strReplicationSelectDatabases'].'<br />'."\n";
    echo PMA_replication_db_multibox();
    echo '<br /><br />'."\n";
    echo $GLOBALS['strReplicationAddLines'].'<br />'."\n";
    echo '<pre><div id="rep">server-id='. $serverid .'<br />log-bin=mysql-bin<br />log-error=mysql-bin.err<br /></div></pre>'."\n";
    echo $GLOBALS['strReplicationRestartServer'] ."\n";
    echo '</fieldset>'."\n";
    echo '<fieldset class="tblFooters">';
    echo ' <form autocomplete="off" method="post" action="server_replication.php" >'."\n";
    echo PMA_generate_common_hidden_inputs('', '');
    echo '  <input type="submit" value="' . $GLOBALS['strGo'] . '" id="goButton" />';
    echo ' </form>'."\n";
    echo '</fieldset>';

    require_once './libraries/footer.inc.php';
    exit;
}

echo '</div>';

if (!isset($GLOBALS['repl_clear_scr'])) {
    // Render the 'Slave configuration' section 
    echo '<fieldset>'."\n";
    echo '<legend>' . $GLOBALS['strReplicationSlave'] . '</legend>'."\n";
    if ($server_slave_status) { 
        echo PMA_js_mootools_domready($jscode['slave_control']);
        echo '<div id="slave_configuration_gui">'."\n";

        $_url_params = $GLOBALS['url_params'];
        $_url_params['sr_take_action'] = true;
        $_url_params['sr_slave_server_control'] = true;

        if ($server_slave_replication[0]['Slave_IO_Running'] == 'No') {
            $_url_params['sr_slave_action'] = 'start'; 
        } else {
            $_url_params['sr_slave_action'] = 'stop'; 
        }

        $_url_params['sr_slave_control_parm'] = 'IO_THREAD'; 
        $slave_control_io_link = PMA_generate_common_url($_url_params); 

        if ($server_slave_replication[0]['Slave_SQL_Running'] == 'No') {
            $_url_params['sr_slave_action'] = 'start'; 
        } else {
            $_url_params['sr_slave_action'] = 'stop'; 
        }

        $_url_params['sr_slave_control_parm'] = 'SQL_THREAD'; 
        $slave_control_sql_link = PMA_generate_common_url($_url_params); 

        if ($server_slave_replication[0]['Slave_IO_Running'] == 'No' 
            || $server_slave_replication[0]['Slave_SQL_Running'] == 'No'
        ) {
            $_url_params['sr_slave_action'] = 'start'; 
        } else {
            $_url_params['sr_slave_action'] = 'stop'; 
        }

        $_url_params['sr_slave_control_parm'] = null; 
        $slave_control_full_link = PMA_generate_common_url($_url_params); 

        $_url_params['sr_slave_action'] = 'reset'; 
        $slave_control_reset_link = PMA_generate_common_url($_url_params); 

        $_url_params = $GLOBALS['url_params'];
        $_url_params['sr_slave_skip_error'] = true;
        $slave_skip_error_link = PMA_generate_common_url($_url_params); 

        if ($server_slave_replication[0]['Slave_SQL_Running'] == 'No') 
            PMA_Message::warning('Slave SQL Thread not running!')->display();
        if ($server_slave_replication[0]['Slave_IO_Running'] == 'No') 
            PMA_Message::warning('Slave IO Thread not running!')->display();

        $_url_params = $GLOBALS['url_params'];
        $_url_params['sl_configure'] = true;
        $_url_params['repl_clear_scr'] = true;

        $reconfiguremaster_link = PMA_generate_common_url($_url_params); 

        echo $GLOBALS['strReplicationSlaveConfigured']."\n";
        echo '<br />'."\n";
        echo '<ul>'."\n";
        echo ' <li><a href="#" id="slave_status_href">'. $GLOBALS['strReplicationSlaveSeeStatus'].'</a></li>'."\n";
        echo PMA_replication_print_status_table('slave', true, false);
        if (isset($_SESSION['replication']['m_correct']) && $_SESSION['replication']['m_correct'] == true) {
            echo PMA_js_mootools_domready($jscode['slave_control_sync']);
            echo ' <li><a href="#" id="slave_synchronization_href">'.$GLOBALS['strReplicationSynchronize'].'</a></li>'."\n";
            echo ' <div id="slave_synchronization_gui" style="display: none">'."\n";
            echo '  <form method="post" action="server_replication.php">'."\n";
            echo PMA_generate_common_hidden_inputs('', '');
            echo '   <input type="checkbox" name="repl_struc" value="1" checked disabled /> '. $GLOBALS['strStructure']. '<br />'."\n"; // this is just for vizualization, it has no other purpose
            echo '   <input type="checkbox" name="repl_data"  value="1" checked /> '. $GLOBALS['strData'] .' <br />'."\n";
            echo '   <input type="hidden" name="sr_take_action" value="1" />'."\n";
            echo '   <input type="submit" name="sl_sync" value="'. $GLOBALS['strGo'] .'" />'."\n";
            echo '  </form>'."\n";
            echo ' </div>'."\n";
        }
        echo ' <li><a href="#" id="slave_control_href">'. $GLOBALS['strReplicationControlSlave'] .'</a>'."\n";
        echo ' <div id="slave_control_gui" style="display: none">'."\n";
        echo '  <ul>'."\n";
        echo '   <li><a href="'. $slave_control_full_link .'">'. (($server_slave_replication[0]['Slave_IO_Running'] == 'No' || $server_slave_replication[0]['Slave_SQL_Running'] == 'No') ? $GLOBALS['strFullStart'] : $GLOBALS['strFullStop']). ' </a></li>'."\n";
        echo '   <li><a href="'. $slave_control_reset_link .'">'. $GLOBALS['strReplicationSlaveReset'] .'</a></li>'."\n";
        echo '   <li><a href="'. $slave_control_sql_link .'">'. sprintf($GLOBALS['strReplicationSlaveSQLThread'], ($server_slave_replication[0]['Slave_SQL_Running'] == 'No' ? $GLOBALS['strStart'] : $GLOBALS['strStop'])) .'</a></li>'."\n";
        echo '   <li><a href="'. $slave_control_io_link .'">'. sprintf($GLOBALS['strReplicationSlaveIOThread'], ($server_slave_replication[0]['Slave_IO_Running'] == 'No' ? $GLOBALS['strStart'] : $GLOBALS['strStop'])) .'</a></li>'."\n";
        echo '  </ul>'."\n";
        echo ' </div>'."\n";
        echo ' </li>'."\n";
        echo ' <li><a href="#" id="slave_errormanagement_href">'. $GLOBALS['strReplicationSlaveErrorManagement'] .'</a>'."\n";
        echo ' <div id="slave_errormanagement_gui" style="display: none">'."\n";
        PMA_Message::warning($GLOBALS['strReplicationSkippingErrorWarn'])->display();
        echo '  <ul>'."\n";
        echo '   <li><a href="'. $slave_skip_error_link .'">'. $GLOBALS['strReplicationSlaveSkipCurrentError'] .'</a></li>'."\n";
        echo '   <li>'.$GLOBALS['strReplicationSlaveSkipNext']."\n";
        echo '    <form method="post" action="server_replication.php">'."\n";
        echo PMA_generate_common_hidden_inputs('', '');
        echo '      <input type="text" name="sr_skip_errors_count" value="1" style="width: 30px" />'.$GLOBALS['strReplicationSlaveSkipNextErrors']."\n";
        echo '              <input type="submit" name="sr_slave_skip_error" value="'. $GLOBALS['strGo'] .'" />'."\n";
        echo '      <input type="hidden" name="sr_take_action" value="1" />'."\n";
        echo '    </form></li>'."\n";
        echo '  </ul>'."\n";
        echo ' </div>'."\n";
        echo ' </li>'."\n";
        echo ' <li><a href="'. $reconfiguremaster_link .'">'.$GLOBALS['strReplicationSlaveChangeMaster'].'</a></li>'."\n";
        echo '</ul>'."\n";

    } elseif (!isset($GLOBALS['sl_configure'])) {
        $_url_params = $GLOBALS['url_params'];
        $_url_params['sl_configure'] = true;
        $_url_params['repl_clear_scr'] = true;

        echo sprintf($GLOBALS['strReplicationSlaveNotConfigured'], PMA_generate_common_url($_url_params))."\n"; 
    }
    echo '</div>'."\n";
    echo '</fieldset>'."\n";
}
if (isset($GLOBALS['sl_configure'])) {
    PMA_replication_gui_changemaster("slave_changemaster");
}
require_once './libraries/footer.inc.php';
?>
