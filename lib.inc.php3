<?php
/* $Id$ */



if (!defined('__LIB_INC__')){
    define('__LIB_INC__', 1);

    /* Order of sections for lib.inc.php3 
     *
     * in PHP3, functions and constants must be physically defined
     * before they are referenced
     *
     * some functions need the constants of defines.inc.php3
     *
     * the include of defines.inc.php3 must be after the connection to db
     * 
     * the auth() function must be before the connection to db
     *
     * ... so the required order is:
     *
     * - definition of auth()
     * - parsing of the configuration file
     * - load of mysql extension (if necessary)
     * - db connection
     * - defines.inc.php3
     * - other functions, respecting dependencies 
     */

    /* avoid undefined variables in PHP3
     *
     */

     if (!isset($use_backquotes)) {
	$use_backquotes=0;
     }
     if (!isset($pos)) {
	$pos=0;
     }
    /* ---------------------- Advanced authentification -------------------- */

    /**
     * Advanced authentication work
     * Requires Apache loaded as a php module.
     */
    function auth()
    {
        header('status: 401 Unauthorized');
        header('HTTP/1.0 401 Unauthorized');
        header('WWW-authenticate: basic realm="phpMyAdmin on ' . $GLOBALS['cfgServer']['host'] . '"');
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>

<head>
<title><?php echo $GLOBALS['strAccessDenied']; ?></title>
</head>

<body bgcolor="#FFFFFF">
<br /><br />
<center>
    <h1><?php echo $GLOBALS['strWrongUser']; ?></h1>
</center>
</body>

</html>
        <?php
        echo "\n";
        exit();
    } // end of the 'auth()' function

    /**
     * Parses the configuration file
     */
    include('./config.inc.php3');
    // For compatibility with old config.inc.php3
    if (!isset($cfgTextareaCols)) {
        $cfgTextareaCols = 40;
    }
    if (!isset($cfgTextareaRows)) {
        $cfgTextareaRows = 7;
    }


    /**
     * Loads the mysql extensions if it is not loaded yet
     * staybyte - 26. June 2001
     */
    if ((intval(phpversion()) == 3 && substr(phpversion(), 4) > 9)
        || intval(phpversion()) == 4) {
        if (defined('PHP_OS') && eregi('win', PHP_OS)) {
            $suffix = '.dll';
        } else {
            $suffix = '.so';
        }
        if (intval(phpversion()) == 3) {
            $extension = 'MySQL';
        } else {
            $extension = 'mysql';
        }
        if (!@extension_loaded($extension) && !@get_cfg_var('safe_mode')) {
            @dl($extension.$suffix);
        }
        if (!@extension_loaded($extension)) {
            echo $strCantLoadMySQL;
            exit();
        }
    } // end load mysql extension


    /**
     * Use mysql_connect() or mysql_pconnect()?
     */
    $connect_func = ($cfgPersistentConnections) ? 'mysql_pconnect' : 'mysql_connect';
    $dblist = array();


    /**
     * Gets the valid servers list and parameters
     */
    reset($cfgServers);
    while(list($key, $val) = each($cfgServers)) {
        // Don't use servers with no hostname
        if (empty($val['host'])) {
            unset($cfgServers[$key]);
        }
    }
 
    if (empty($server) || !isset($cfgServers[$server]) || !is_array($cfgServers[$server])) {
        $server = $cfgServerDefault;
    }


    /**
     * If no server is selected, make sure that $cfgServer is empty (so that
     * nothing will work), and skip server authentication.
     * We do NOT exit here, but continue on without logging into any server.
     * This way, the welcome page will still come up (with no server info) and
     * present a choice of servers in the case that there are multiple servers
     * and '$cfgServerDefault = 0' is set.
     */
    if ($server == 0) {
        $cfgServer = array();
    }

    /**
     * Otherwise, set up $cfgServer and do the usual login stuff.
     */
    else if (isset($cfgServers[$server])) {
        $cfgServer = $cfgServers[$server];

        // The user can work with only one database
        if (isset($cfgServer['only_db']) && !empty($cfgServer['only_db'])) {
            $dblist[] = $cfgServer['only_db'];
        }

        // Advanced authentification is required
        if ($cfgServer['adv_auth']) {
            // Grabs the $PHP_AUTH_USER variable whatever are the values of the
            // 'register_globals' and the 'variables_order' directives
            if (empty($PHP_AUTH_USER)) {
                if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['PHP_AUTH_USER'])) {
                    $PHP_AUTH_USER = $HTTP_SERVER_VARS['PHP_AUTH_USER'];
                }
                else if (isset($REMOTE_USER)) {
                    $PHP_AUTH_USER = $REMOTE_USER;
                }
                else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['REMOTE_USER'])) {
                    $PHP_AUTH_USER = $HTTP_ENV_VARS['REMOTE_USER'];
                }
                else if (@getenv('REMOTE_USER')) {
                    $PHP_AUTH_USER = getenv('REMOTE_USER');
                }
            }
            // Grabs the $PHP_AUTH_PW variable whatever are the values of the
            // 'register_globals' and the 'variables_order' directives
            if (empty($PHP_AUTH_PW)) {
                if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['PHP_AUTH_PW'])) {
                    $PHP_AUTH_PW = $HTTP_SERVER_VARS['PHP_AUTH_PW'];
                }
                else if (isset($REMOTE_PASSWORD)) {
                    $PHP_AUTH_PW = $REMOTE_PASSWORD;
                }
                else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['REMOTE_PASSWORD'])) {
                    $PHP_AUTH_PW = $HTTP_ENV_VARS['REMOTE_PASSWORD'];
                }
                else if (@getenv('REMOTE_PASSWORD')) {
                    $PHP_AUTH_PW = getenv('REMOTE_PASSWORD');
                }
            }
            // Grabs the $old_usr variable whatever are the values of the
            // 'register_globals' and the 'variables_order' directives
            if (empty($old_usr) && !empty($HTTP_GET_VARS) && isset($HTTP_GET_VARS['old_usr'])) {
                $old_usr = $HTTP_GET_VARS['old_usr'];
            }

            // First load -> checks if authentification is required
            if (!isset($old_usr)) {
                if (empty($PHP_AUTH_USER)) {
                    $do_auth = TRUE;
                } else {
                    $do_auth = FALSE;
                }
            }
            // Else ensure the username is not the same
            else {
                // force user to enter a different username
                if ($old_usr == $PHP_AUTH_USER) {
                    $do_auth = TRUE;
                } else {
                    $do_auth = FALSE;
                }
            }

            // Calls the authentification window or validates user's login
            if ($do_auth) {
                auth();
            } else {
                if (empty($cfgServer['port'])) {
                    $dbh = $connect_func($cfgServer['host'], $cfgServer['stduser'], $cfgServer['stdpass']) or mysql_die();
                } else {
                    $dbh = $connect_func($cfgServer['host'] . ':' . $cfgServer['port'], $cfgServer['stduser'], $cfgServer['stdpass']) or mysql_die();
                }
                $PHP_AUTH_USER = str_replace('\'', '\\\'', $PHP_AUTH_USER);
                $PHP_AUTH_PW   = str_replace('\'', '\\\'', $PHP_AUTH_PW);
                $auth_query = 'SELECT User, Password, Select_priv '
                            . 'FROM mysql.user '
                            . 'WHERE '
                            .    'User = \'' . $PHP_AUTH_USER . '\' '
                            .    'AND Password = PASSWORD(\'' . $PHP_AUTH_PW . '\')';
                $rs         = mysql_query($auth_query, $dbh) or mysql_die();

                // Invalid login -> relog
                if (@mysql_numrows($rs) <= 0) {
                    auth();
                }
                // Seems to be a valid login...
                else {
                    $row = mysql_fetch_array($rs);
                    // Correction uva 19991215
                    // Previous code assumed database "mysql" admin table "db"
                    // column "db" contains literal name of user database, and
                    // works if so.
                    // Mysql usage generally (and uva usage specifically)
                    // allows this column to contain regular expressions (we
                    // have all databases owned by a given
                    // student/faculty/staff beginning with user i.d. and
                    // governed by default by a single set of privileges with
                    // regular expression as key). This breaks previous code.
                    // This maintenance is to fix code to work correctly for
                    // regular expressions.
                    if ($row['Select_priv'] != 'Y') {
                        $rs = mysql_query('SELECT DISTINCT Db FROM mysql.db WHERE Select_priv = \'Y\' AND User = \'' . $PHP_AUTH_USER . '\'') or mysql_die();
                        if (@mysql_numrows($rs) <= 0) {
                            $rs = mysql_query('SELECT Db FROM mysql.tables_priv WHERE Table_priv LIKE \'%Select%\' AND User = \'' . $PHP_AUTH_USER . '\'') or mysql_die();
                            if (@mysql_numrows($rs) <= 0) {
                                auth();
                            } else {
                                while ($row = mysql_fetch_array($rs)) {
                                    $dblist[] = $row['Db'];
                                }
                            }
                        } else {
                            // Will use as associative array of the following 2
                            // code lines:
                            //   the 1st is the only line intact from before
                            //     correction,
                            //   the 2nd replaces $dblist[] = $row['Db'];
                            $uva_mydbs = array();
                            // Code following those 2 lines in correction
                            // continues populating $dblist[], as previous code
                            // did. But it is now populated with actual
                            // database names instead of with regular
                            // expressions.
                            while ($row = mysql_fetch_array($rs)) {
                                $uva_mydbs[$row['Db']] = 1;
                            }
                            $uva_alldbs = mysql_list_dbs();
                            while ($uva_row = mysql_fetch_array($uva_alldbs)) {
                                $uva_db = $uva_row[0];
                                if (isset($uva_mydbs[$uva_db]) && 1 == $uva_mydbs[$uva_db]) {
                                    $dblist[]           = $uva_db;
                                    $uva_mydbs[$uva_db] = 0;
                                } else {
                                    reset($uva_mydbs);
                                    while (list($uva_matchpattern, $uva_value) = each($uva_mydbs)) {
                                        $uva_regex = ereg_replace('%', '.+', $uva_matchpattern);
                                        // Fixed db name matching
                                        // 2000-08-28 -- Benjamin Gandon
                                        if (ereg('^' . $uva_regex . '$', $uva_db)) {
                                            $dblist[] = $uva_db;
                                            break;
                                        }
                                    } // end while
                                } // end if ... else ....
                            } // end while
                        } // end else
                    } // end if
                } // end else
            }

            // Validation achived -> store user's login/password
            $cfgServer['user']     = $PHP_AUTH_USER;
            $cfgServer['password'] = $PHP_AUTH_PW;
        } // end Advanced authentification

        // Do connect to the user's database
        if (empty($cfgServer['port'])) {
            $link = $connect_func($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or mysql_die();
        } else {
            $link = $connect_func($cfgServer['host'] . ':' . $cfgServer['port'], $cfgServer['user'], $cfgServer['password']) or mysql_die();
        }
    } // end server connecting

    /**
     * Missing server hostname
     */
    else {
        echo $strHostEmpty;
    }

    /**
     * Gets constants that defines the PHP, MySQL... releases.
     * This include must be located physically before any code that
     * needs to reference the constants, else PHP 3.0.16 won't be happy;
     * and must be located after we are connected to db
     */
    include('./defines.inc.php3');



    /* ----------------------- Set of misc functions ----------------------- */

    /**
     * Adds backquotes on both sides of a database, table or field name.
     * Since MySQL 3.23.6 this allows to use non-alphanumeric characters in
     * these names.
     *
     * @param   string   the database, table or field name to "backquote"
     * @param   boolean  a flag to bypass this function (used by dump functions)
     *
     * @return  string   the "backquoted" database, table or field name if the
     *                   current MySQL release is >= 3.23.6, the original one
     *                   else
     */
    function backquote($a_name, $do_it = TRUE)
    {
        if ($do_it
            && MYSQL_MAJOR_VERSION >= 3.23 && intval(MYSQL_MINOR_VERSION) >= 6
            && !empty($a_name) && $a_name != '*') {
            return '`' . $a_name . '`';
        } else {
            return $a_name;
        }
    } // end of the 'backquote()' function


    /**
     * Add slashes before "'" and "\" characters so a value containing them can
     * be used in a sql comparison.
     *
     * @param   string   the string to slash
     * @param   boolean  whether the string will be used in a 'LIKE' clause
     *                   (it then requires two more escaped sequences) or not
     *
     * @return  string   the slashed string
     */
    function sql_addslashes($a_string = '', $is_like = FALSE)
    {
        if ($is_like) {
            $a_string = str_replace('\\', '\\\\\\\\', $a_string);
        } else {
            $a_string = str_replace('\\', '\\\\', $a_string);
        }
        $a_string = str_replace('\'', '\\\'', $a_string);
    
        return $a_string;
    } // end of the 'sql_addslashes()' function


    /**
     * Defines the <CR><LF> value depending on the user OS that may be grabbed
     * from the 'HTTP_USER_AGENT' variable.
     *
     * @return  string   the <CR><LF> value to use
     */
    function which_crlf()
    {
        $the_crlf = "\n";
        
        // Gets the 'HTTP_USER_AGENT' variable
        if (!isset($GLOBALS['HTTP_USER_AGENT'])) {
            if (!empty($GLOBALS['HTTP_SERVER_VARS']) && isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'])) {
                $GLOBALS['HTTP_USER_AGENT'] = $GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'];
            } else {
                $GLOBALS['HTTP_USER_AGENT'] = @getenv('HTTP_USER_AGENT');
            }
        } // end if
        
        // Searches for the word 'win'
        if (!empty($GLOBALS['HTTP_USER_AGENT'])
            && ereg('[^(]*\((.*)\)[^)]*', $GLOBALS['HTTP_USER_AGENT'], $regs)) {
            if (eregi('Win', $regs[1])) {
                $the_crlf = "\r\n";
            }
        } // end if

    
        return $the_crlf;
    } // end of the 'which_crlf()' function


    /**
     * Counts and displays the number of records in a table
     *
     * Last revision 13 July 2001: Patch for limiting dump size from
     * vinay@sanisoft.com & girish@sanisoft.com
     *
     * @param   string   the current database name
     * @param   string   the current table name
     * @param   boolean  whether to retain or to displays the result
     *
     * @return  mixed    the number of records if retain is required, true else
     */
    function count_records($db, $table, $ret = FALSE)
    {
        $result = mysql_query('select count(*) as num from ' . backquote($db) . '.' . backquote($table));
        $num    = mysql_result($result,0,"num");
        if ($ret) {
            return $num;
        } else {
            echo number_format($num, 0, $GLOBALS['number_decimal_separator'], $GLOBALS['number_thousands_separator']);
            return TRUE;
        }
    } // end of the 'count_records()' function


    /**
     * Displays a MySQL error message in the right frame.
     *
     * @param   string   the error mesage
     * @param   string   the sql query that failed
     */
    function mysql_die($error_message = '', $the_query = '')
    {
        global $sql_query;

        if (empty($error_message)) {
            $error_message = mysql_error();
        }
        if (empty($the_query)) {
            $the_query     = $GLOBALS['sql_query'];
        }

        echo '<b>'. $GLOBALS['strError'] . '</b>' . "\n";
        echo '<p>' . "\n";
        if (!empty($the_query)) {
            $edit_link = '<a href="db_details.php3?lang=' . $GLOBALS['lang'] . '&server=' . urlencode($GLOBALS['server']) . '&db=' . urlencode($GLOBALS['db']) . '&sql_query=' . urlencode($the_query) . '&show_query=y">' . $GLOBALS['strEdit'] . '</a>';
            echo '    ' . $GLOBALS['strSQLQuery'] . '&nbsp;:&nbsp;[' . $edit_link . ']<pre>' . htmlspecialchars($the_query) . '</pre>' . "\n";
        }
        echo '</p>' . "\n";
        echo '<p>' . "\n";
        echo '    ' . $GLOBALS['strMySQLSaid'] . '&nbsp;' . htmlspecialchars($error_message) . "\n";
        echo '</p>' . "\n";
        echo '<a href="javascript:history.go(-1)">' . $GLOBALS['strBack'] . '</a>';

        include('./footer.inc.php3');
        exit();
    } // end of the 'mysql_die()' function


    /**
     * Displays a message at the top of the "main" (right) frame
     *
     * @param  string  the message to display
     */
    function show_message($message)
    {
        // Reloads the navigation frame via JavaScript if required
        if (!empty($GLOBALS['reload']) && ($GLOBALS['reload'] == 'true')) {
            echo "\n";
            ?>
<script type="text/javascript" language="javascript1.2">
<!--
window.parent.frames['nav'].location.replace('./left.php3?lang=<?php echo $GLOBALS['lang']; ?>&server=<?php echo $GLOBALS['server'];?>&db=<?php echo urlencode($GLOBALS['db']); ?>');
//-->
</script>
            <?php
        }
        echo "\n";
        ?>
<div align="left">
    <table border="<?php echo $GLOBALS['cfgBorder']; ?>">
    <tr>
        <td bgcolor="<?php echo $GLOBALS['cfgThBgcolor']; ?>">
            <b><?php echo stripslashes($message); ?></b><br />
        </td>
    </tr>
        <?php
        if ($GLOBALS['cfgShowSQL'] == TRUE && !empty($GLOBALS['sql_query'])) {
            echo "\n";
            ?>
    <tr>
        <td bgcolor="<?php echo $GLOBALS['cfgBgcolorOne']; ?>">
            <?php
            echo "\n";
            // The nl2br function isn't used because its result isn't a valid
            // xhtml1.0 statement before php4.0.5 ("<br>" and not "<br />")
            $new_line   = '<br />' . "\n" . '            ';
            $query_base = htmlspecialchars($GLOBALS['sql_query']);
            $query_base = ereg_replace("(\015\012)|(\015)|(\012)", $new_line, $query_base);
            if (!isset($GLOBALS['show_query']) || $GLOBALS['show_query'] != 'y') {
                $edit_link = '<a href="db_details.php3?lang=' . $GLOBALS['lang'] . '&server=' . urlencode($GLOBALS['server']) . '&db=' . urlencode($GLOBALS['db']) . '&sql_query=' . urlencode($GLOBALS['sql_query']) . '&show_query=y">' . $GLOBALS['strEdit'] . '</a>';
                echo '            ' . $GLOBALS['strSQLQuery'] . '&nbsp;:&nbsp;[' . $edit_link . ']<br />' . "\n";
            } else {
                echo '            ' . $GLOBALS['strSQLQuery'] . '&nbsp;:<br />' . "\n";
            }
            echo '            ' . $query_base;
            if (isset($GLOBALS['sql_order'])) {
                echo ' ' . $GLOBALS['sql_order'];
            }
            // If a 'LIMIT' clause has been programatically added to the query
            // displays it
            $is_append_limit = (isset($GLOBALS['pos'])
                                && eregi('^SELECT', $GLOBALS['sql_query'])
                                && !eregi('LIMIT[ 0-9,]+$', $GLOBALS['sql_query']));
            if ($is_append_limit) {
                echo ' LIMIT ' . $GLOBALS['pos'] . ', ' . $GLOBALS['cfgMaxRows'];
            }
            echo "\n";
            ?>
        </td>
    </tr>
           <?php
        }
        echo "\n";
        ?>
    </table>
</div><br />
        <?php
    } // end of the 'show_message()' function


    /**
     * Displays a link to the official MySQL documentation
     *
     * @param   string  an anchor to move to
     *
     * @return  string  the html link
     */
    function show_docu($link)
    {
        if (!empty($GLOBALS['cfgManualBase'])) {
            return '[<a href="' . $GLOBALS['cfgManualBase'] . '/' . $link .'" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]';
        }
    } // end of the 'show_docu()' function


    /**
     * Formats $value to byte view
     *
     * @param    double   the value to format
     * @param    integer  the sensitiveness
     * @param    integer  the number of decimals to retain
     *
     * @return   array    the formatted value and its unit
     *
     * @author   staybyte
     * @version  1.1 - 07 July 2001
     */
    function format_byte_down($value, $limes = 6, $comma = 0)
    {
        $dh           = pow(10, $comma);
        $li           = pow(10, $limes);
        $return_value = $value;
        $unit         = $GLOBALS['byteUnits'][0];

        if ($value >= $li*1000000) {
            $value = round($value/(1073741824/$dh))/$dh;
            $unit  = $GLOBALS['byteUnits'][3];
        }
        else if ($value >= $li*1000) {
            $value = round($value/(1048576/$dh))/$dh;
            $unit  = $GLOBALS['byteUnits'][2];
        }
        else if ($value >= $li) {
            $value = round($value/(1024/$dh))/$dh;
            $unit  = $GLOBALS['byteUnits'][1];
        }
        if ($unit != $GLOBALS['byteUnits'][0]) {
            $return_value = number_format($value, $comma, $GLOBALS['number_decimal_separator'], $GLOBALS['number_thousands_separator']);
        } else {
            $return_value = number_format($value, 0, $GLOBALS['number_decimal_separator'], $GLOBALS['number_thousands_separator']);
        }

        return array($return_value, $unit);
    } // end of the 'format_byte_down' function



    /* ----- Functions used to display records returned by a sql query ----- */

    /**
     * Displays a navigation bar to browse among the results of a sql query
     *
     * @param   integer  the offset for the "next" page
     * @param   integer  the offset for the "previous" page
     * @param   array    the result of the query
     *
     * @global  string   the current language
     * @global  integer  the server to use (refers to the number in the
     *                   configuration file)
     * @global  string   the database name
     * @global  string   the table name
     * @global  string   the current sql query
     * @global  string   the sort order sql query part
     * @global  integer  the current position in results
     * @global  string   the url to go back in case of errors
     * @global  integer  the maximum number of rows per page
     * @global  integer  the total number of rows returned by the sql query
     */
    function show_table_navigation($pos_next, $pos_prev, $dt_result)
    {
        global $lang, $server, $db, $table;
        global $sql_query, $sql_order, $pos, $goto;
        global $sessionMaxRows, $SelectNumRows;
        
        // $sql_query and $sql_order will be stripslashed in 'sql.php3' if the
        // 'magic_quotes_gpc' directive is set to 'on'
        if (get_magic_quotes_gpc()) {
            $encoded_sql_query = urlencode(addslashes($sql_query));
            $encoded_sql_order = urlencode(addslashes($sql_order));
        } else {
            $encoded_sql_query = urlencode($sql_query);
            $encoded_sql_order = urlencode($sql_order);
        }
        ?>

<!--  Beginning of table navigation bar -->
<table border="0">
<tr>
        <?php
        // Move to the beginning or to the previous page
        if ($pos > 0) {
            ?>
    <td>
        <form action="sql.php3" method="post">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="db" value="<?php echo $db; ?>" />
            <input type="hidden" name="table" value="<?php echo $table; ?>" />
            <input type="hidden" name="sql_query" value="<?php echo $encoded_sql_query; ?>" />
            <input type="hidden" name="sql_order" value="<?php echo $encoded_sql_order; ?>" />
            <input type="hidden" name="pos" value="0" />
            <input type="hidden" name="sessionMaxRows" value="<?php echo $sessionMaxRows; ?>" />
            <input type="hidden" name="goto" value="<?php echo $goto; ?>" />
            <input type="submit" name="navig" value="<?php echo $GLOBALS['strPos1'] . ' &lt;&lt;'; ?>" />
        </form>
    </td>
    <td>
        <form action="sql.php3" method="post">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="db" value="<?php echo $db; ?>" />
            <input type="hidden" name="table" value="<?php echo $table; ?>" />
            <input type="hidden" name="sql_query" value="<?php echo $encoded_sql_query; ?>" />
            <input type="hidden" name="sql_order" value="<?php echo $encoded_sql_order; ?>" />
            <input type="hidden" name="pos" value="<?php echo $pos_prev; ?>" />
            <input type="hidden" name="sessionMaxRows" value="<?php echo $sessionMaxRows; ?>" />
            <input type="hidden" name="goto" value="<?php echo $goto; ?>" />
            <input type="submit" name="navig" value="<?php echo $GLOBALS['strPrevious'] . ' &lt;'; ?>" />
        </form>
    </td>
            <?php
        } // end move back
        echo "\n";
        ?>
    <td>
        &nbsp;&nbsp;&nbsp;
    </td>
    <td>
        <form action="sql.php3" method="post"
            onsubmit="return (checkFormElementInRange(this, 'pos', 0, <?php echo $SelectNumRows-1; ?>) && checkFormElementInRange(this, 'sessionMaxRows'))">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="db" value="<?php echo $db; ?>" />
            <input type="hidden" name="table" value="<?php echo $table; ?>" />
            <input type="hidden" name="sql_query" value="<?php echo $encoded_sql_query; ?>" />
            <input type="hidden" name="sql_order" value="<?php echo $encoded_sql_order; ?>" />
            <input type="hidden" name="goto" value="<?php echo $goto; ?>" />
            <input type="submit" name="navig" value="<?php echo $GLOBALS['strShow']; ?>&nbsp;:" />
            <input type="text" name="sessionMaxRows" size="3" value="<?php echo $sessionMaxRows; ?>" />
            <?php echo $GLOBALS['strRowsFrom'] . "\n"; ?>
            <input type="text" name="pos" size="3" value="<?php echo (($pos_next >= $SelectNumRows) ? 0 : $pos_next); ?>" />
        </form>
    </td>
    <td>
        &nbsp;&nbsp;&nbsp;
    </td>
        <?php
        // Move to the next page or to the last one
        if (($pos + $sessionMaxRows < $SelectNumRows) && mysql_num_rows($dt_result) >= $sessionMaxRows) {
            ?>
    <td>
        <form action="sql.php3" method="post">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="db" value="<?php echo $db; ?>" />
            <input type="hidden" name="table" value="<?php echo $table; ?>" />
            <input type="hidden" name="sql_query" value="<?php echo $encoded_sql_query; ?>" />
            <input type="hidden" name="sql_order" value="<?php echo $encoded_sql_order; ?>" />
            <input type="hidden" name="pos" value="<?php echo $pos_next; ?>" />
            <input type="hidden" name="sessionMaxRows" value="<?php echo $sessionMaxRows; ?>" />
            <input type="hidden" name="goto" value="<?php echo $goto; ?>" />
            <input type="submit" name="navig" value="<?php echo '&gt; ' . $GLOBALS['strNext']; ?>" />
        </form>
    </td>
    <td>
        <form action="sql.php3" method="post"
            onsubmit="return <?php echo (($pos + $sessionMaxRows < $SelectNumRows && mysql_num_rows($dt_result) >= $sessionMaxRows) ? 'true' : 'false'); ?>">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="db" value="<?php echo $db; ?>" />
            <input type="hidden" name="table" value="<?php echo $table; ?>" />
            <input type="hidden" name="sql_query" value="<?php echo $encoded_sql_query; ?>" />
            <input type="hidden" name="sql_order" value="<?php echo $encoded_sql_order; ?>" />
            <input type="hidden" name="pos" value="<?php echo $SelectNumRows - $sessionMaxRows; ?>" />
            <input type="hidden" name="sessionMaxRows" value="<?php echo $sessionMaxRows; ?>" />
            <input type="hidden" name="goto" value="<?php echo $goto; ?>" />
            <input type="submit" name="navig" value="<?php echo '&gt;&gt; ' . $GLOBALS['strEnd']; ?>" />
        </form>
    </td>
            <?php
        } // end move toward
        echo "\n";
        ?>
</tr>
</table>
<!-- End of table navigation bar -->

        <?php
    } // end of the 'show_table_navigation()' function


    /**
     * Displays a table of results returned by a sql query
     *
     * @param   array   the result table to display
     * @param   mixed   whether to display navigation bar and bookmarks links
     *                  or not
     *
     * @global  string   the current language
     * @global  integer  the server to use (refers to the number in the
     *                   configuration file)
     * @global  string   the database name
     * @global  string   the table name
     * @global  string   the current sql query
     * @global  string   the sort order sql query part
     * @global  string   the url to go back in case of errors
     * @global  integer  the total number of rows returned by the sql query
     */
    function display_table($dt_result, $is_simple = FALSE)
    {
        global $lang, $server, $db, $table;
        global $sql_query, $goto, $sql_order, $pos;
        global $SelectNumRows;

        // Gets the number of rows per page
        if (isset($GLOBALS['sessionMaxRows'])) {
            $GLOBALS['cfgMaxRows']     = $GLOBALS['sessionMaxRows'];
        } else {
            $GLOBALS['sessionMaxRows'] = $GLOBALS['cfgMaxRows'];
        }

        // Loads a javascript library that does quick validations
        ?>

<script type="text/javascript" language="javascript">
<!--
var errorMsg1 = '<?php echo(str_replace('\'', '\\\'', $GLOBALS['strNotNumber'])); ?>';
var errorMsg2 = '<?php echo(str_replace('\'', '\\\'', $GLOBALS['strNotValidNumber'])); ?>';
//-->
</script>
<script src="functions.js" type="text/javascript" language="javascript"></script>

        <?php
        echo "\n";

        // Counts the number of rows in the table if required
        if (!$is_simple && !empty($table) && !empty($db)) {
            $result = mysql_query('SELECT COUNT(*) as total FROM ' . backquote($db) . '.' . backquote($table)) or mysql_die();
            $row    = mysql_fetch_array($result);
            $total  = $row['total'];
        } // end if

        // Defines offsets for the next and previous pages
        if (!$is_simple) {
            if (!isset($pos)) {
                $pos      = 0;
            }
            $pos_next     = $pos + $GLOBALS['cfgMaxRows'];
            $pos_prev     = $pos - $GLOBALS['cfgMaxRows'];
            if ($pos_prev < 0) {
                $pos_prev = 0;
            }
        } // end if

        // Displays a messages with position informations
        if (isset($total) && $total > 1) {
            if (isset($SelectNumRows) && $SelectNumRows != $total) {
                $selectstring = ', ' . $SelectNumRows . ' ' . $GLOBALS['strSelectNumRows'];
            } else {
                $selectstring = '';
            }
            $lastShownRec     = ($pos_next > $total) ? $total : $pos_next;
            show_message($GLOBALS['strShowingRecords'] . " $pos - $lastShownRec ($total " . $GLOBALS['strTotal'] . $selectstring . ')');
        } else {
            show_message($GLOBALS['strSQLQuery']);
        }

        // Displays the navigation bars
        $field     = mysql_fetch_field($dt_result);
        if (!isset($table) || strlen(trim($table)) == 0) {
            $table = $field->table;
        }
        mysql_field_seek($dt_result, 0);
        if (!$is_simple) {
            show_table_navigation($pos_next, $pos_prev, $dt_result);
        } else {
            echo '<br /><br /><br /><br />';
        }

        // Displays the results
        ?>

<table border="<?php echo $GLOBALS['cfgBorder']; ?>">
<tr>
        <?php
        echo "\n";
        if ($GLOBALS['cfgModifyDeleteAtLeft'] && !$is_simple) {
            echo '    <td></td>' . "\n";
            echo '    <td></td>' . "\n";
        }
        if ($sql_query == 'SHOW PROCESSLIST') {
            echo '    <td></td>' . "\n";
        }
        while ($field = mysql_fetch_field($dt_result)) {
            // Result is more than one row long
            if (@mysql_num_rows($dt_result) > 1 && !$is_simple) {
                if (empty($sql_order)) {
                    $sort_order = ' ORDER BY ' . backquote($field->name) . ' ' . $GLOBALS['cfgOrder'];
                }
                else if (substr($sql_order, -3) == 'ASC') {
                    $sort_order = ' ORDER BY ' . backquote($field->name) . ' DESC';
                }
                else if (substr($sql_order, -4) == 'DESC') {
                    $sort_order = ' ORDER BY ' . backquote($field->name) . ' ASC';
                }
                $url_query = 'lang=' . $lang
                           . '&server=' . urlencode($server)
                           . '&db=' . urlencode($db)
                           . '&table=' . urlencode($table)
                           . '&pos=' . $pos
                           . '&sql_query=' . urlencode($sql_query)
                           . '&sql_order=' . urlencode($sort_order);
                ?>
    <th>
        <a href="sql.php3?<?php echo $url_query; ?>">
            <?php echo htmlspecialchars($field->name); ?></a>
    </th>
                <?php
            } // end if

            // Result is one row long
            else {
                echo "\n";
                ?>
    <th>
        <?php echo htmlspecialchars($field->name); ?>
    </th>
                <?php
            } // end else
            echo "\n";
        } // end while
        ?>
</tr>

        <?php
        echo "\n";
        $foo = 0;

        // Correction uva 19991216 in the while below
        // Previous code assumed that all tables have keys, specifically that
        // the phpMyAdmin GUI should support row delete/edit only for such
        // tables.
        // Although always using keys is arguably the prescribed way of
        // defining a relational table, it is not required. This will in
        // particular be violated by the novice.
        // We want to encourage phpMyAdmin usage by such novices. So the code
        // below has been changed to conditionally work as before when the
        // table being displayed has one or more keys; but to display
        // delete/edit options correctly for tables without keys.

        while ($row = mysql_fetch_row($dt_result)) {
            $primary_key              = '';
            $uva_nonprimary_condition = '';
            $bgcolor                  = ($foo % 2) ? $GLOBALS['cfgBgcolorOne'] : $GLOBALS['cfgBgcolorTwo'];
            
            ?>
<tr bgcolor="<?php echo $bgcolor; ?>">
            <?php
            echo "\n";
            for ($i = 0; $i < mysql_num_fields($dt_result); ++$i) {
                $primary   = mysql_fetch_field($dt_result, $i);
                $condition = ' ' . backquote($primary->name) . ' ';
                if (!isset($row[$i])) {
                    $row[$i]   = '';
                    $condition .= 'IS NULL AND';
                } else {
                    $condition .= '= \'' . str_replace('\'', '\\\'', $row[$i]) . '\' AND';
                }
                if ($primary->numeric == 1) {
                    if ($sql_query == 'SHOW PROCESSLIST') {
                        $Id = $row[$i];
                    }
                }
                if ($primary->primary_key > 0) {
                    $primary_key .= $condition;
                }
                $uva_nonprimary_condition .= $condition;
            } // end for

            // Correction uva 19991216: prefer primary keys for condition, but
            // use conjunction of all values if no primary key
            if ($primary_key) {
                $uva_condition = $primary_key;
            } else {
                $uva_condition = $uva_nonprimary_condition;
            }
            $uva_condition     = urlencode(ereg_replace('AND$', '', $uva_condition));
            
            $url_query  = 'lang=' . $lang
                        . '&server=' . urlencode($server)
                        . '&db=' . urlencode($db)
                        . '&table=' . urlencode($table)
                        . '&pos=' . $pos;

            $goto       = (!empty($goto) && empty($GLOBALS['QUERY_STRING'])) ? $goto : 'sql.php3';
            $edit_url   = 'tbl_change.php3'
                        . '?' . $url_query
                        . '&primary_key=' . $uva_condition
                        . '&sql_query=' . urlencode($sql_query)
                        . '&goto=' . urlencode($goto);

            $goto       = 'sql.php3'
                        . '?' . $url_query
                        . '&sql_query=' . urlencode($sql_query)
                        . '&zero_rows=' . urlencode(htmlspecialchars($GLOBALS['strDeleted']))
                        . '&goto=tbl_properties.php3';
            $delete_url = 'sql.php3'
                        . '?' . $url_query
                        . '&sql_query=' . urlencode('DELETE FROM ' . backquote($table) . ' WHERE') . $uva_condition
                        . '&zero_rows=' . urlencode(htmlspecialchars($GLOBALS['strDeleted']))
                        . '&goto=' . urlencode($goto);

            if ($GLOBALS['cfgModifyDeleteAtLeft'] && !$is_simple) {
                ?>
    <td>
        <a href="<?php echo $edit_url; ?>">
            <?php echo $GLOBALS['strEdit']; ?></a>
    </td>
    <td>
        <a href="<?php echo $delete_url; ?>">
            <?php echo $GLOBALS['strDelete']; ?></a>
    </td>
                <?php
                echo "\n";
            } // end if

            if ($sql_query == 'SHOW PROCESSLIST') {
                ?>
    <td align="right">
        <a href="sql.php3?db=mysql&sql_query=<?php echo urlencode('KILL ' . $Id); ?>&goto=main.php3">
            <?php echo $GLOBALS['strKill']; ?></a>
    </td>
                <?php
                echo "\n";
            } // end if

            // Possibility to have the modify/delete button on the left added
            // Benjamin Gandon -- 2000-08-29
            for ($i = 0; $i < mysql_num_fields($dt_result); ++$i) {
                if (!isset($row[$i])) {
                    $row[$i] = '';
                }
                $primary = mysql_fetch_field($dt_result, $i);
                if ($primary->numeric == 1) {
                    echo '    <td align="right">&nbsp;' . $row[$i] . '&nbsp;</td>' . "\n";
                } else if ($GLOBALS['cfgShowBlob'] == FALSE && eregi('BLOB', $primary->type)) {
                    echo '    <td align="right">&nbsp;[BLOB]&nbsp;</td>' . "\n";
                } else {
                    echo '    <td>&nbsp;' . htmlspecialchars($row[$i]) . '&nbsp;</td>' . "\n";
                }
            } // end for
            if ($GLOBALS['cfgModifyDeleteAtRight'] && !$is_simple) {
                ?>
    <td>
        <a href="<?php echo $edit_url; ?>">
            <?php echo $GLOBALS['strEdit']; ?></a>
    </td>
    <td>
        <a href="<?php echo $delete_url; ?>">
            <?php echo $GLOBALS['strDelete']; ?></a>
    </td>
                <?php
                echo "\n";
            } // end if
            ?>
</tr>
            <?php
            echo "\n";
            $foo++;
        } // end while
        ?>
</table>

        <?php
        echo "\n";
        if (!$is_simple) {
            echo '<br />';
            show_table_navigation($pos_next, $pos_prev, $dt_result);
        }
    } // end of the 'display_table()' function



    /* ------------------- Functions used to build dumps ------------------- */

    /**
     * Uses the 'htmlspecialchars()' php function on databases, tables and fields
     * name if the dump has to be displayed on screen.
     *
     * @param   string   the string to format
     */
    function html_format($a_string = '')
    {
        return (empty($GLOBALS['asfile']) ? htmlspecialchars($a_string) : $a_string);
    } // end of the 'html_format()' function


    /**
     * Returns $table's CREATE definition
     *
     * Uses the 'html_format()' function defined in 'tbl_dump.php3'
     *
     * @param   string   the database name
     * @param   string   the table name
     * @param   string   the end of line sequence
     *
     * @return  string   the CREATE statement on success
     *
     * @global  boolean  whether to add 'drop' statements or not
     * @global  boolean  whether to use backquotes to allow the use of special
     *                   characters in database, table and fields names or not
     */
    function get_table_def($db, $table, $crlf)
    {
        global $drop;
        global $use_backquotes;

        $schema_create = '';
        if (!empty($drop)) {
            $schema_create .= 'DROP TABLE IF EXISTS ' . backquote(html_format($table), $use_backquotes) . ';' . $crlf;
        }

        // Steve Alberty's patch for complete table dump,
        // modified by Lem9 to allow older MySQL versions to continue to work
        if (MYSQL_MAJOR_VERSION == 3.23 && intval(MYSQL_MINOR_VERSION) > 20) {
            // Whether to quote table and fields names or not
            if ($use_backquotes) {
                mysql_query('SET SQL_QUOTE_SHOW_CREATE = 1');
            } else {
                mysql_query('SET SQL_QUOTE_SHOW_CREATE = 0');
            }
            $result = mysql_query('SHOW CREATE TABLE ' . backquote($db) . '.' . backquote($table));
            if ($result != FALSE && mysql_num_rows($result) > 0) {
                $tmpres        = mysql_fetch_array($result);
                $schema_create .= str_replace("\n", $crlf, html_format($tmpres[1]));
            }
            return $schema_create;
        } // end if MySQL >= 3.23.20

        // For MySQL < 3.23.20
        $schema_create .= 'CREATE TABLE ' . html_format(backquote($table), $use_backquotes) . ' (' . $crlf;

        $result        = mysql_query('SHOW FIELDS FROM ' . backquote($db) . '.' . backquote($table)) or mysql_die();
        while ($row = mysql_fetch_array($result)) {
            $schema_create     .= '   ' . html_format(backquote($row['Field'], $use_backquotes)) . ' ' . $row['Type'];
            if (isset($row['Default']) && $row['Default'] != '') {
                $schema_create .= ' DEFAULT \'' . html_format(sql_addslashes($row['Default'])) . '\'';
            }
            if ($row['Null'] != 'YES') {
                $schema_create .= ' NOT NULL';
            }
            if ($row['Extra'] != '') {
                $schema_create .= ' ' . $row['Extra'];
            }
            $schema_create     .= ',' . $crlf;
        } // end while
        $schema_create         = ereg_replace(',' . $crlf . '$', '', $schema_create);

        $result = mysql_query('SHOW KEYS FROM ' . backquote($db) . '.' . backquote($table)) or mysql_die();
        while ($row = mysql_fetch_array($result))
        {
            $kname    = $row['Key_name'];
            $comment  = (isset($row['Comment'])) ? $row['Comment'] : '';
            $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';

            if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) {
                $kname = "UNIQUE|$kname";
            }
            if ($comment == 'FULLTEXT') {
                $kname = 'FULLTEXT|$kname';
            }
            if (!isset($index[$kname])) {
                $index[$kname] = array();
            }
            if ($sub_part > 1) {
                $index[$kname][] = html_format(backquote($row['Column_name'], $use_backquotes)) . '(' . $sub_part . ')';
            } else {
                $index[$kname][] = html_format(backquote($row['Column_name'], $use_backquotes));
            }
        } // end while

        while (list($x, $columns) = @each($index)) {
            $schema_create     .= ',' . $crlf;
            if ($x == 'PRIMARY') {
                $schema_create .= '   PRIMARY KEY (';
            } else if (substr($x, 0, 6) == 'UNIQUE') {
                $schema_create .= '   UNIQUE ' . substr($x, 7) . ' (';
            } else if (substr($x, 0, 8) == 'FULLTEXT') {
                $schema_create .= '   FULLTEXT ' . substr($x, 9) . ' (';
            } else {
                $schema_create .= '   KEY ' . $x . ' (';
            }
            $schema_create     .= implode($columns, ', ') . ')';
        } // end while

        $schema_create .= $crlf . ')';

        // ??? Why bother about get_magic_quotes_gpc() here ???
        // if (get_magic_quotes_gpc()) {
        //     return stripslashes($schema_create);
        // } else {
        //     return $schema_create;
        // }
          return $schema_create;
    } // end of the 'get_table_def()' function


    /**
     * php >= 4.0.5 only : get the content of $table as a series of INSERT
     * statements.
     * After every row, a custom callback function $handler gets called.
     *
     * Last revision 13 July 2001: Patch for limiting dump size from
     * vinay@sanisoft.com & girish@sanisoft.com
     *
     * @param   string   the current database name
     * @param   string   the current table name
     * @param   string   the 'limit' clause to use with the sql query
     * @param   string   the name of the handler (function) to use at the end
     *                   of every row. This handler must accept one parameter
     *                   ($sql_insert)
     *
     * @return  boolean  always true
     *
     * @global  boolean  whether to use backquotes to allow the use of special
     *                   characters in database, table and fields names or not
     *
     * @see     get_table_content()
     *
     * @author  staybyte
     */
    function get_table_content_fast($db, $table, $add_query = '', $handler)
    {
        global $use_backquotes;

        $result = mysql_query('SELECT * FROM ' . backquote($db) . '.' . backquote($table) . $add_query) or mysql_die();
        if ($result != FALSE) {

            // Checks whether the field is an integer or not
            for ($j = 0; $j < mysql_num_fields($result); $j++) {
                $field_set[$j] = backquote(mysql_field_name($result, $j), $use_backquotes);
                $type          = mysql_field_type($result, $j);
                if ($type == 'tinyint' || $type == 'smallint' || $type == 'mediumint' || $type == 'int' ||
                    $type == 'bigint'  ||$type == 'timestamp') {
                    $field_num[$j] = TRUE;
                } else {
                    $field_num[$j] = FALSE;
                }
            } // end for

            // Sets the scheme
            if (isset($GLOBALS['showcolumns'])) {
                $fields        = implode(', ', $field_set);
                $schema_insert = 'INSERT INTO ' . backquote(html_format($table), $use_backquotes)
                               . ' (' . html_format($fields) . ') VALUES (';
            } else {
                $schema_insert = 'INSERT INTO ' . backquote(html_format($table), $use_backquotes)
                               . ' VALUES (';
            }
        
            $field_count = mysql_num_fields($result);

            $search  = array("\x0a","\x0d","\x1a"); //\x08\\x09, not required
            $replace = array("\\n","\\r","\Z");

            @set_time_limit(1200); // 20 Minutes

            while ($row = mysql_fetch_row($result)) {
                for ($j = 0; $j < $field_count; $j++) {
                    if (!isset($row[$j])) {
                        $values[]     = 'NULL';
                    } else if (!empty($row[$j])) {
                        // a number
                        if ($field_num[$j]) {
                            $values[] = $row[$j];
                        }
                        // a string
                        else {
                            $values[] = "'" . str_replace($search, $replace, sql_addslashes($row[$j])) . "'";
                        }
                    } else {
                        $values[]     = "''";
                    } // end if
                } // end for

                $insert_line = $schema_insert . implode(',', $values) . ')';
                unset($values);

                // Call the handler
                $handler($insert_line);
            } // end while
        } // end if ($result != FALSE)
    
        return TRUE;
    } // end of the 'get_table_content_fast()' function


    /**
     * php < 4.0.5 only: get the content of $table as a series of INSERT
     * statements.
     * After every row, a custom callback function $handler gets called.
     *
     * Last revision 13 July 2001: Patch for limiting dump size from
     * vinay@sanisoft.com & girish@sanisoft.com
     *
     * @param   string   the current database name
     * @param   string   the current table name
     * @param   string   the 'limit' clause to use with the sql query
     * @param   string   the name of the handler (function) to use at the end
     *                   of every row. This handler must accept one parameter
     *                   ($sql_insert)
     *
     * @return  boolean  always true
     *
     * @global  boolean  whether to use backquotes to allow the use of special
     *                   characters in database, table and fields names or not
     *
     * @see     get_table_content()
     */
    function get_table_content_old($db, $table, $add_query = '', $handler)
    {
        global $use_backquotes;

        $result = mysql_query('SELECT * FROM ' . backquote($db) . '.' . backquote($table) . $add_query) or mysql_die();
        $i      = 0;
        while ($row = mysql_fetch_row($result)) {
            @set_time_limit(60); // HaRa
            $table_list     = '(';

            for ($j = 0; $j < mysql_num_fields($result); $j++) {
                $table_list .= backquote(mysql_field_name($result, $j), $use_backquotes) . ', ';
            }

            $table_list     = substr($table_list, 0, -2);
            $table_list     .= ')';

            if (isset($GLOBALS['showcolumns'])) {
                $schema_insert = 'INSERT INTO ' . backquote(html_format($table), $use_backquotes)
                               . ' ' . html_format($table_list) . ' VALUES (';
            } else {
                $schema_insert = 'INSERT INTO ' . backquote(html_format($table), $use_backquotes)
                               . ' VALUES (';
            }

            for ($j = 0; $j < mysql_num_fields($result); $j++) {
                if (!isset($row[$j])) {
                    $schema_insert .= ' NULL,';
                } else if ($row[$j] != '') {
                    $dummy  = '';
                    $srcstr = $row[$j];
                    for ($xx = 0; $xx < strlen($srcstr); $xx++) {
                        $yy = strlen($dummy);
                        if ($srcstr[$xx] == "\\")   $dummy .= "\\\\";
                        if ($srcstr[$xx] == "'")    $dummy .= "\\'";
                        if ($srcstr[$xx] == "\"")   $dummy .= "\\\"";
                        if ($srcstr[$xx] == "\x00") $dummy .= "\\0";
                        if ($srcstr[$xx] == "\x0a") $dummy .= "\\n";
                        if ($srcstr[$xx] == "\x0d") $dummy .= "\\r";
                        if ($srcstr[$xx] == "\x08") $dummy .= "\\b";
                        if ($srcstr[$xx] == "\t")   $dummy .= "\\t";
                        if ($srcstr[$xx] == "\x1a") $dummy .= "\\Z";
                        if (strlen($dummy) == $yy)  $dummy .= $srcstr[$xx];
                    }
                    $schema_insert .= " '" . $dummy . "',";
                } else {
                    $schema_insert .= " '',";
                } // end if
            } // end for
            $schema_insert = ereg_replace(',$', '', $schema_insert);
            $schema_insert .= ')';
            $handler(trim($schema_insert));
            ++$i;
        } // end while

        return TRUE;
    } // end of the 'get_table_content_old()' function


    /**
     * Dispatches between the versions of 'get_table_content' to use depending
     * on the php version
     *
     * Last revision 13 July 2001: Patch for limiting dump size from
     * vinay@sanisoft.com & girish@sanisoft.com
     *
     * @param   string   the current database name
     * @param   string   the current table name
     * @param   integer  the offset on this table
     * @param   integer  the last row to get
     * @param   string   the name of the handler (function) to use at the end
     *                   of every row. This handler must accept one parameter
     *                   ($sql_insert)
     *
     * @see     get_table_content_fast(), get_table_content_old()
     * @author  staybyte
     */
    function get_table_content($db, $table, $limit_from = 0, $limit_to = 0, $handler)
    {
        // Defines the offsets to use
        if ($limit_from > 0) {
            $limit_from--;
        } else {
            $limit_from = 0;
        }
        if ($limit_to > 0 && $limit_from >= 0) {
            $add_query  = " LIMIT $limit_from, $limit_to";
        } else {
            $add_query  = '';
        }

        // Call the working function depending on the php version
        if (PMA_INT_VERSION >= 40005) {
            get_table_content_fast($db, $table, $add_query, $handler);
        } else {
            get_table_content_old($db, $table, $add_query, $handler);
        }
    } // end of the 'get_table_content()' function


    /**
     * Outputs the content of a table in CSV format
     *
     * Last revision 14 July 2001: Patch for limiting dump size from
     * vinay@sanisoft.com & girish@sanisoft.com
     *
     * @param   string   the database name
     * @param   string   the table name
     * @param   integer  the offset on this table
     * @param   integer  the last row to get
     * @param   string   the separation string
     * @param   string   the handler (function) to call. It must accept one
     *                   parameter ($sql_insert)
     *
     * @return  boolean always true
     */
    function get_table_csv($db, $table, $limit_from = 0, $limit_to = 0, $sep, $handler)
    {
        // Handles the separator character
        if (empty($sep)) {
            $sep     = ';';
        }
        else {
            if (get_magic_quotes_gpc()) {
                $sep = stripslashes($sep);
            }
            $sep     = str_replace('\\t', "\011", $sep);
        }

        // Defines the offsets to use
        if ($limit_from > 0) {
            $limit_from--;
        } else {
            $limit_from = 0;
        }
        if ($limit_to > 0 && $limit_from >= 0) {
            $add_query  = " LIMIT $limit_from, $limit_to";
        } else {
            $add_query  = '';
        }

        // Gets the data from the database
        $result = mysql_query('SELECT * FROM ' . backquote($db) . '.' . backquote($table) . $add_query) or mysql_die();

        // Format the data
        $i      = 0;
        while ($row = mysql_fetch_row($result)) {
            @set_time_limit(60);
            $schema_insert = '';
            $fields_cnt    = mysql_num_fields($result);
            for ($j = 0; $j < $fields_cnt; $j++) {
                if (!isset($row[$j])) {
                    $schema_insert .= 'NULL';
                }
                else if ($row[$j] != '') {
                    $schema_insert .= $row[$j];
                }
                else {
                    $schema_insert .= '';
                }
                if ($j < $fields_cnt-1) {
                    $schema_insert .= $sep;
                }
            } // end for
            $handler(trim($schema_insert));
            ++$i;
        } // end while

        return TRUE;
    } // end of the 'get_table_csv()' function



    /* -------- Functions used to format commands from imported file ------- */

    /**
     * Splits up large sql files into individual queries
     *
     * Last revision: 16th July 2001 - loic1
     *
     * @param   string   the sql commands
     * @param   string   the end of command line delimiter 
     *
     * @return  array    the splitted sql commands
     */
    function split_sql_file($sql, $delimiter)
    {
        $sql       = trim($sql);
        $char      = '';
        $last_char = '';
        $ret       = array();
        $in_string = TRUE;

        for ($i = 0; $i < strlen($sql); $i++) {
            $char = $sql[$i];

            // if delimiter found, add the parsed part to the returned array
            if ($char == $delimiter && !$in_string) {
                $ret[]     = substr($sql, 0, $i);
                $sql       = substr($sql, $i + 1);
                $i         = 0;
                $last_char = '';
            }

            if ($last_char == $in_string && $char == ')') {
                $in_string = FALSE;
            }
            if ($char == $in_string && $last_char != '\\') {
                $in_string = FALSE;
            }
            else if (!$in_string
                     && ($char == '"' || $char == '\'' || $char == '`')
                     && ($last_char != '\\')) {
                $in_string = $char;
            }
            $last_char = $char;
        } // end for

        if (!empty($sql)) {
            $ret[] = $sql;
        }
        return $ret;
    } // end of the 'split_sql_file()' function


    /**
     * Removes # type remarks from large sql files
     *
     * Version 3 20th May 2001 - Last Modified By Pete Kelly
     *
     * @param   string   the sql commands
     *
     * @return  string   the cleaned sql commands
     */
    function remove_remarks($sql)
    {
        $i = 0;

        while ($i < strlen($sql)) {
            // Patch from Chee Wai
            // (otherwise, if $i==0 and $sql[$i] == "#", the original order
            // in the second part of the AND bit will fail with illegal index)
            //    if ($sql[$i] == "#" and ($sql[$i-1] == "\n" or $i==0)) {
            if ($sql[$i] == '#' && ($i == 0 || $sql[$i-1] == "\n")) { 
                $j = 1;
                while ($sql[$i+$j] != "\n") {
                    $j++;
                    if ($j+$i > strlen($sql)) {
                        break;
                    }
                } // end while
                $sql = substr($sql, 0, $i) . substr($sql, $i+$j);
            } // end if
            $i++;
        } // end while

        return $sql;
    } // end of the 'remove_remarks()' function



    /* ------------------------ The bookmark feature ----------------------- */

    /**
     * Defines the bookmark parameters for the current user
     *
     * @return  array    the bookmark parameters for the current user
     *
     * @global  array    the list of servers settings defined in the
     *                   configuration file
     * @global  array    the list of settings for the current server
     * @global  integer  the id of the current server
     */
    function get_bookmarks_param()
    {
        global $cfgServers;
        global $cfgServer;
        global $server;

        $cfgBookmark = FALSE;
        $cfgBookmark = '';

        // No server selected -> no bookmark table
        if ($server == 0) {
            return '';
        }
    
        // Defines the hostname, database and table to use for bookmarks 
        $i = 1;
        while ($i <= sizeof($cfgServers)) {
            // Advanced authentification mode
            if ($cfgServer['adv_auth']) {
                if (($cfgServers[$i]['host'] == $cfgServer['host'] || $cfgServers[$i]['host'] == '')
                    && $cfgServers[$i]['adv_auth'] == TRUE && $cfgServers[$i]['stduser'] == $cfgServer['user'] && $cfgServers[$i]['stdpass'] == $cfgServer['password']) {
                    $cfgBookmark['db']    = $cfgServers[$i]['bookmarkdb'];
                    $cfgBookmark['table'] = $cfgServers[$i]['bookmarktable'];
                    break;
                }
            } // end advanced authentification

            // No authentification
            else {
                if (($cfgServers[$i]['host'] == $cfgServer['host'] || $cfgServers[$i]['host'] == '')
                    && $cfgServers[$i]['adv_auth'] == FALSE && $cfgServers[$i]['user'] == $cfgServer['user'] && $cfgServers[$i]['password'] == $cfgServer['password']) {
                    $cfgBookmark['db']    = $cfgServers[$i]['bookmarkdb'];
                    $cfgBookmark['table'] = $cfgServers[$i]['bookmarktable'];
                    break;
                }
            } // end no authentification

            $i++;
        } // end while

        return $cfgBookmark;
    } // end of the 'get_bookmarks_param()' function


    /**
     * Gets the list of bookmarks defined for the current database
     *
     * @param   string   the current database name
     * @param   array    the bookmark parameters for the current user
     *
     * @return  array    the bookmarks list
     */
    function list_bookmarks($db, $cfgBookmark)
    {
        $query  = 'SELECT label, id FROM '. backquote($cfgBookmark['db']) . '.' . backquote($cfgBookmark['table'])
                . ' WHERE dbase = \'' . str_replace('\'', '\\\'', $db) . '\'';
        $result = mysql_query($query);

        // There is some bookmarks -> store them
        if ($result > 0 && mysql_num_rows($result) > 0) {
            $flag = 1;
            while ($row = mysql_fetch_row($result)) {
                $bookmark_list[$flag . ' - ' . $row[0]] = $row[1];
                $flag++;
            } // end while
            return $bookmark_list;
        }
        // No bookmarks for the current database
        else {
            return FALSE;
        }
    } // end of the 'list_bookmarks()' function


    /**
     * Gets the sql command from a bookmark
     *
     * @param   string   the current database name
     * @param   array    the bookmark parameters for the current user
     * @param   integer  the id of the bookmark to get
     *
     * @return  string   the sql query
     */
    function query_bookmarks($db, $cfgBookmark, $id)
    {
        $query          = 'SELECT query FROM ' . backquote($cfgBookmark['db']) . '.' . backquote($cfgBookmark['table'])
                        . ' WHERE dbase = \'' . str_replace('\'', '\\\'', $db) . '\' AND id = ' . $id;
        $result         = mysql_query($query);
        $bookmark_query = mysql_result($result, 0, 'query');

        return $bookmark_query;
    } // end of the 'query_bookmarks()' function


    /**
     * Deletes a bookmark
     *
     * @param   string   the current database name
     * @param   array    the bookmark parameters for the current user
     * @param   integer  the id of the bookmark to get
     *
     * @return  string   the sql query
     */
    function delete_bookmarks($db, $cfgBookmark, $id)
    {
        $query  = 'DELETE FROM ' . backquote($cfgBookmark['db']) . '.' . backquote($cfgBookmark['table'])
                . ' WHERE id = ' . $id;
        $result = mysql_query($query);
    } // end of the 'delete_bookmarks()' function




    /* -------------------- End of functions definitions ------------------- */

    /**
     * Bookmark Support
     */
    $cfgBookmark = get_bookmarks_param();


} // $__LIB_INC__

?>
