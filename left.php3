<?php
/* $Id$ */


/** 
 * Gets the variables sent to this script, retains the db name that may have
 * been defined as startup option and include a core library
 */
require('./grab_globals.inc.php3');
if (!empty($db)) {
    $db_start = $db;
}
require('./lib.inc.php3');


/**
 * Get the list and number of available databases.
 * Skipped if no server selected: in this case no database should be displayed
 * before the user choose among available ones at the welcome screen.
 */
if ($server > 0) {
    // Get databases list
    if (empty($dblist)) {
        $dbs     = @mysql_list_dbs() or mysql_die();
        $num_dbs = mysql_numrows($dbs);
    } else {
        $num_dbs = count($dblist);
    }
} else {
        $num_dbs = 0;
}


/**
 * Send http headers
 */
// Don't use cache (required for Opera)
$now = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $now);
header('Last-Modified: ' . $now);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
// Define the charset to be used
header('Content-Type: text/html; charset=' . $charset);


/**
 * Displays the frame
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>phpMyAdmin</title>
    <base target="phpmain" />
<?php
// Expandable/collapsible databases list is only used if there is more than one
// database to display
if ($num_dbs > 1) {
    echo "\n";
    ?>
    <!-- Collapsible tables list scripts -->
    <script type="text/javascript" language="javascript1.2">
    <!--
    var isDOM      = (typeof(document.getElementsByTagName) != 'undefined') ? 1 : 0;
    var isIE4      = ((typeof(document.all) != 'undefined') && (parseInt(navigator.appVersion) >= 4)) ? 1 : 0;
    var isNS4      = (typeof(document.layers) != 'undefined') ? 1 : 0;
    var capable    = (isDOM || isIE4 || isNS4) ? 1 : 0;
    // Uggly fix for Konqueror and Opera that are not fully DOM compliant
    if (capable && typeof(navigator.userAgent) != 'undefined') {
        var browserName = ' ' + navigator.userAgent.toLowerCase();
        if (browserName.indexOf('opera') > 0 || browserName.indexOf('konqueror') > 0) {
            capable = 0;
        }
    }
    var fontFamily = '<?php echo $left_font_family; ?>';
    var isServer   = <?php echo ($server > 0) ? 'true' : 'false'; ?>;
    //-->
    </script>
    <script src="left.js" type="text/javascript" language="javascript1.2"></script>
    <noscript>
        <style type="text/css">
        <!--
        div {color: #000000}
        .heada {font-family: <?php echo $left_font_family; ?>; font-size: 10pt}
        .parent {font-family: <?php echo $left_font_family; ?>; color: #000000; text-decoration: none}
        .child {font-family: <?php echo $left_font_family; ?>; font-size: 8pt; color: #333399; text-decoration: none}
        .item, .item:active, .item:hover, .tblItem, .tblItem:active {color: #333399; text-decoration: none}
        .tblItem:hover {color: #FF0000; text-decoration: underline}
        //-->
        </style>
    </noscript>

    <style type="text/css">
    <!--
    body {font-family: <?php echo $left_font_family; ?>; font-size: 10pt}
    //-->
    </style>
    <?php
} // end if ($num_dbs > 1)

else if ($num_dbs == 1) {
    echo "\n";
    ?>
    <style type="text/css">
    <!--
    body {font-family: <?php echo $left_font_family; ?>; font-size: 10pt}
    div {color: #000000}
    .heada {font-family: <?php echo $left_font_family; ?>; font-size: 10pt}
    .heada_cnt {font-family: <?php echo $left_font_family; ?>; font-size: 8pt}
    .parent {font-family: <?php echo $left_font_family; ?>; color: #000000; text-decoration: none}
    .child {font-family: <?php echo $left_font_family; ?>; font-size: 8pt; color: #333399; text-decoration: none}
    .item, .item:active, .item:hover, .tblItem, .tblItem:active {color: #333399; text-decoration: none}
    .tblItem:hover {color: #FF0000; text-decoration: underline}
    //-->
    </style>
    <?php
} // end if ($num_dbs == 1)

else {
    echo "\n";
    ?>
    <style type="text/css">
    <!--
    body {font-family: <?php echo $left_font_family; ?>; font-size: 10pt}
    div {color: #000000}
    .heada {font-family: <?php echo $left_font_family; ?>; font-size: 10pt}
    .heada_cnt {font-family: <?php echo $left_font_family; ?>; font-size: 8pt}
    //-->
    </style>
    <?php
} // end if ($num_dbs < 1)

echo "\n";
?>
</head>

<body bgcolor="#D0DCE0">
    <!-- Link to the welcome page -->
    <div id="el1Parent" class="parent" style="margin-bottom: 5px">
        <a class="item" href="main.php3?lang=<?php echo $lang; ?>&server=<?php echo $server; ?>">
            <font color="black" class="heada"><b><?php echo $strHome; ?></b></font></a>
    </div>

   
    <!-- Databases and tables list -->
<?php
// Don't display expansible/collapsible database info if:
// 1. $server == 0 (no server selected)
//    This is the case when there are multiple servers and
//    '$cfgServerDefault = 0' is set. In that case, we want the welcome screen
//    to appear with no database info displayed.
// 2. there is only one database available (ie either only one database exists
//    or $cfgServers['only_db'] is defined)
//    In this case, the database should not be collapsible/expandable
if ($num_dbs > 1) {
    $selected_db = 0;

    // Gets the tables list per database
    for ($i = 0; $i < $num_dbs; $i++) {
        if (empty($dblist)) {
            $db  = mysql_dbname($dbs, $i);
        } else {
            $db  = $dblist[$i];
        }
        $j = $i + 2;
        if (!empty($db_start) && $db == $db_start) {
            $selected_db = $j;
        }
        $tables              = @mysql_list_tables($db);
        $num_tables          = @mysql_numrows($tables);
        $common_url_query    = 'lang=' . $lang
                             . '&server=' . urlencode($server)
                             . '&db=' . urlencode($db);
        if ($num_tables) {
            $num_tables_disp = $num_tables;
        } else {
            $num_tables_disp = '-';
        }

        // Displays the database name
        echo "\n";
        echo '    <div id="el' . $j . 'Parent" class="parent">';

        if (!empty($num_tables)) {
            echo "\n";
            ?>
        <a class="item" href="db_details.php3?<?php echo $common_url_query; ?>" onclick="expandBase('el<?php echo $j; ?>', true); return false;">
            <img name="imEx" id="el<?php echo $j; ?>Img" src="images/plus.gif" border="0" width="9" height="9" alt="+" /></a>
            <?php
        } else {
            echo "\n";
            ?>
        <img name="imEx" src="images/minus.gif" border="0" width="9" height="9" />
            <?php
        }
        echo "\n";
        ?>
        <a class="item" href="db_details.php3?<?php echo $common_url_query; ?>" onclick="expandBase('el<?php echo $j; ?>', false);">
            <font color="black" class="heada"><?php echo $db; ?>&nbsp;&nbsp;<span class="heada_cnt">(<?php echo $num_tables_disp; ?>)</span></font></a>
    </div>

    <div id="el<?php echo $j;?>Child" class="child" style="margin-bottom: 5px">

        <?php
        // Displays the list of tables from the current database
        for ($j = 0; $j < $num_tables; $j++) {
            $table = mysql_tablename($tables, $j);
            echo "\n";
            ?>
        <nobr><img src="images/spacer.gif" border="0" width="9" height="9" alt="" />
        <a target="phpmain" href="sql.php3?<?php echo $common_url_query; ?>&table=<?php echo urlencode($table); ?>&sql_query=<?php echo urlencode('SELECT * FROM ' . backquote($table)); ?>&pos=0&goto=tbl_properties.php3">
            <img src="images/browse.gif" border="0" alt="<?php echo "$strBrowse: $table"; ?>" /></a>&nbsp;
        <a class="tblItem" target="phpmain" href="tbl_properties.php3?<?php echo $common_url_query; ?>&table=<?php echo urlencode($table); ?>">
            <?php echo $table; ?></a></nobr><br />
            <?php
        } // end for $j (tables list)
        echo "\n";
        ?>
    </div>
        <?php
        echo "\n";
    } // end for $t (db list)
    ?>


    <!-- Arrange collapsible/expandable db list at startup -->
    <script type="text/javascript" language="javascript1.2">
    <!--
    if (isNS4) {
      firstEl  = 'el1Parent';
      firstInd = nsGetIndex(firstEl);
      nsShowAll();
      nsArrangeList();
    }
    expandedDb = '<?php echo (empty($selected_db)) ? '' : 'el' . $selected_db . 'Child'; ?>';
    //-->
    </script>
    <?php
} // end if ($server > 1)

// Case where only one database has to be displayed
else if ($num_dbs == 1) {
    // Get tables list of the database
    if (empty($dblist)) {
        $db  = mysql_dbname($dbs, 0);
    } else {
        $db  = $dblist[0];
    }
    $tables              = @mysql_list_tables($db);
    $num_tables          = @mysql_numrows($tables);
    $common_url_query    = 'lang=' . $lang
                         . '&server=' . urlencode($server)
                         . '&db=' . urlencode($db);
    if ($num_tables) {
        $num_tables_disp = $num_tables;
    } else {
        $num_tables_disp = '-';
    }
    
    // Displays the database name
    echo "\n";
    ?>
    <div id="el2Parent" class="parent">
        <a class="item" href="db_details.php3?<?php echo $common_url_query; ?>">
            <font color="black" class="heada"><?php echo $db; ?>&nbsp;&nbsp;<span class="heada_cnt">(<?php echo $num_tables_disp; ?>)</span></font></a>
    </div>
    <div id="el2Child" class="child" style="margin-bottom: 5px">
    <?php
    // Displays the list of tables from the current database
    for ($j = 0; $j < $num_tables; $j++) {
        $table = mysql_tablename($tables, $j);
        echo "\n";
        ?>
        <nobr><a target="phpmain" href="sql.php3?<?php echo $common_url_query; ?>&table=<?php echo urlencode($table); ?>&sql_query=<?php echo urlencode('SELECT * FROM ' . backquote($table)); ?>&pos=0&goto=tbl_properties.php3">
                  <img src="images/browse.gif" border="0" alt="<?php echo "$strBrowse: $table"; ?>" /></a>&nbsp;
              <a class="tblItem" target="phpmain" href="tbl_properties.php3?<?php echo $common_url_query; ?>&table=<?php echo urlencode($table); ?>">
                  <?php echo $table; ?></a></nobr><br />
        <?php
    } // end for $j (tables list)
    echo "\n";
    ?>
    </div>
    <?php
} // end if ($server == 1)
echo "\n";
?>

</body>
</html>
