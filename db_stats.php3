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
include('./header.inc.php3');


/**
 * Get the list and number of available databases.
 * Skipped if no server selected: in this case no database should be displayed
 * before the user choose among available ones at the welcome screen.
 */
if ($server > 0) {
    // Get the valid databases list
    $num_dbs = count($dblist);
    $dbs     = @mysql_list_dbs() or mysql_die();
    while ($a_db = mysql_fetch_object($dbs)) {
        if (!$num_dbs) {
            $dblist[]                     = $a_db->Database;
        } else {
            $true_dblist[$a_db->Database] = '';
        }
    }
    if ($num_dbs && empty($true_dblist)) {
        $dblist = array();
    } else if ($num_dbs) {
        for ($i = 0; $i < $num_dbs; $i++) {
            if (isset($true_dblist[$dblist[$i]])) {
                $dblist_valid[] = $dblist[$i];
            }
        }
        if (isset($dblist_valid)) {
            $dblist = $dblist_valid;
            unset($dblist_valid);
        } else {
            $dblist = array();
        }
        unset($true_dblist);
    }
    // Get the valid databases count
    $num_dbs = count($dblist);
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
</head>

<body bgcolor="#D0DCE0">

<h1><?php echo ucfirst($strDatabasesStats); ?> - 
<?php echo ($strHost . ': ' . $cfgServer['host']); ?>
</h1>   
<h2><?php echo ($strGenTime . ': ' . date('F j, Y, g:i a')); ?></h2>

    <!-- Databases and tables list -->

<table border="<?php echo $cfgBorder; ?>">
<tr>
<th><?php echo ucfirst($strDatabase); ?></th>
<th><?php echo ucfirst($strData); ?></th>
<th><?php echo ucfirst($strIndexes); ?></th>
<th><?php echo ucfirst($strTotal); ?></th>
</tr>

<?php
if ($num_dbs > 1) {
    $selected_db = 0;

    // Gets the tables list per database
    for ($i = 0; $i < $num_dbs; $i++) {
        $db = $dblist[$i];
        $j  = $i + 2;
	$bgcolor          = ($i % 2) ? $cfgBgcolorOne : $cfgBgcolorTwo;

        if (!empty($db_start) && $db == $db_start) {
            $selected_db = $j;
        }
        $tables              = @mysql_list_tables($db);
        $num_tables          = @mysql_numrows($tables);
        $common_url_query    = 'lang=' . $lang
                             . '&server=' . urlencode($server)
                             . '&db=' . urlencode($db);

	// get size of data and indexes

	$db_clean = backquote($db);
        $tot_data = 0; $tot_idx = 0; $tot_all = 0;
        $result = mysql_query("SHOW TABLE STATUS FROM $db_clean") or mysql_die();
	if (mysql_num_rows($result)) {
           while ($row = mysql_fetch_array($result)) {
               $tot_data += $row['Data_length'];
               $tot_idx += $row['Index_length'];
           } 
           $tot_all = $tot_data + $tot_idx;
        }

        list($tot_data_format,$unit_data) = format_byte_down($tot_data,3,1);
        list($tot_idx_format,$unit_idx) = format_byte_down($tot_idx,3,1);
        list($tot_all_format,$unit_all) = format_byte_down($tot_all,3,1);

        echo "<tr bgcolor=\"$bgcolor\"><td>" . urlencode($db) . " </td>";
        echo "<td>$tot_data_format $unit_data </td>";
        echo "<td>$tot_idx_format $unit_idx </td>";
        echo "<td><b>$tot_all_format $unit_all<b> </td>";
        echo "</tr>";

    }

    echo "</table>";

} // end if ($num_dbs == 1)
else {
    echo "\n";
    echo '<p>' . $strNoDatabases . '</p>';
} // end if ($num_dbs == 0)
echo "\n";
?>

</body>
</html>
