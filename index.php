<?php
/* $Id$ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * Gets core libraries and defines some variables
 */
require_once('./libraries/grab_globals.lib.php');
require_once('./libraries/common.lib.php');
/**
 * Includes the ThemeManager if it hasn't been included yet
 */
require_once('./libraries/select_theme.lib.php');
// Gets the default font sizes
PMA_setFontSizes();

// Gets the host name
// loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
if (empty($HTTP_HOST)) {
    if (!empty($_ENV) && isset($_ENV['HTTP_HOST'])) {
        $HTTP_HOST = $_ENV['HTTP_HOST'];
    }
    else if (@getenv('HTTP_HOST')) {
        $HTTP_HOST = getenv('HTTP_HOST');
    }
    else {
        $HTTP_HOST = '';
    }
}
/**
 * Defines the frameset
 */
// loic1: If left light mode -> urldecode the db name
if (isset($lightm_db)) {
// no longer urlencoded because of html entities in the db name
//    $db    = urldecode($lightm_db);
    $db    = $lightm_db;
    unset($lightm_db);
}
$url_query = PMA_generate_common_url(isset($db) ? $db : '');
header('Content-Type: text/html; charset=' . $GLOBALS['charset']);

require_once('./libraries/relation.lib.php');
$cfgRelation = PMA_getRelationsParam();

if ($cfg['QueryHistoryDB'] && $cfgRelation['historywork']) {
    PMA_purgeHistory($cfg['Server']['user']);
}

$phpmain_hash = md5($cfg['PmaAbsoluteUri']);
$phpmain_hash_js = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $available_languages[$lang][2]; ?>" lang="<?php echo $available_languages[$lang][2]; ?>" dir="<?php echo $text_dir; ?>">
<head>
<title>phpMyAdmin <?php echo PMA_VERSION; ?> - <?php echo $HTTP_HOST; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<link rel="stylesheet" type="text/css" href="./css/phpmyadmin.css.php?lang=<?php echo $lang; ?>&amp;js_frame=right" />
</head>

<?php
$query_frame_height = 60;
if ($cfg['LeftDisplayServers'] && !$cfg['DisplayServersList']) {
    $query_frame_height = $query_frame_height + 40;
}
if ($server > 0) {
    PMA_availableDatabases(); // this function is defined in "common.lib.php"
} else {
    $num_dbs = 0;
}
if ($num_dbs > 1) {
    if ($cfg['LeftFrameLight']) {
        $query_frame_height = $query_frame_height + 40;
    }
}
if ($cfg['LeftDisplayLogo']) {
    $query_frame_height = $query_frame_height + 50;
}
if ($cfg['QueryFrame']) {
    /* Will we show list of servers? */
    if ($cfg['LeftDisplayServers'] && $cfg['DisplayServersList'] && count($cfg['Servers']) > 1) {
        $query_frame_height += (count($cfg['Servers']) + 1)*15;
    }

    if ($cfg['QueryFrameJS']) {
        echo '<script type="text/javascript">' . "\n";
        echo '<!--' . "\n";
        echo '    document.writeln(\'<frameset cols="' . $cfg['LeftWidth'] . ',*" rows="*" border="1" frameborder="1" framespacing="0">\');' . "\n";
        echo '    document.writeln(\'    <frameset rows="' . $query_frame_height . ', *" framespacing="0" frameborder="0" border="0">\');' . "\n";
        echo '    document.writeln(\'        <frame src="queryframe.php?' . $url_query . '&amp;hash=' . $phpmain_hash . $phpmain_hash_js . '" name="queryframe" frameborder="0" scrolling="no" />\');' . "\n";
        echo '    document.writeln(\'        <frame src="left.php?' . $url_query . '&amp;hash=' . $phpmain_hash . $phpmain_hash_js . '" name="nav" frameborder="0" />\');' . "\n";
        echo '    document.writeln(\'    </frameset>\');' . "\n";
        echo '    document.writeln(\'    <frame src="' . (empty($db) ? $cfg['DefaultTabServer']  : $cfg['DefaultTabDatabase']) . '?' . $url_query . '" name="phpmain' . $phpmain_hash . $phpmain_hash_js . '" border="0" frameborder="0" style="border-left: 1px solid #000000;" />\');' . "\n";
        echo '    document.writeln(\'    <noframes>\');' . "\n";
        echo '    document.writeln(\'        <body bgcolor="#FFFFFF">\');' . "\n";
        echo '    document.writeln(\'            <p>' . str_replace("'", "\'", $strNoFrames) . '</p>\');' . "\n";
        echo '    document.writeln(\'        </body>\');' . "\n";
        echo '    document.writeln(\'    </noframes>\');' . "\n";
        echo '    document.writeln(\'</frameset>\');' . "\n";
        echo '//-->' . "\n";
        echo '</script>' . "\n";
        echo "\n";
        echo '<noscript>' . "\n";
    }
    
    echo '<frameset cols="' . $cfg['LeftWidth'] . ',*" rows="*"  border="1" frameborder="1" framespacing="0">' . "\n";
    echo '    <frameset rows="' . $query_frame_height . ', *" framespacing="0" frameborder="0" border="0">' . "\n";
    echo '        <frame src="queryframe.php?' . $url_query . '&amp;hash=' . $phpmain_hash . '" name="queryframe" frameborder="0" scrolling="no" />' . "\n";
    echo '        <frame src="left.php?' . $url_query . '&amp;hash=' . $phpmain_hash . '" name="nav" frameborder="0" />' . "\n";
    echo '    </frameset>' . "\n";
    echo '    <frame src="' . (empty($db) ? $cfg['DefaultTabServer']  : $cfg['DefaultTabDatabase']) . '?' . $url_query . '" name="phpmain' . $phpmain_hash . '" frameborder="0" />' . "\n";

} else {

    echo '<frameset cols="' . $cfg['LeftWidth'] . ',*" rows="*" border="1" frameborder="1" framespacing="0">' . "\n";
    echo '    <frame src="left.php?' . $url_query . '&amp;hash=' . $phpmain_hash . '" name="nav" frameborder="0" />' . "\n";
    echo '    <frame src="' . (empty($db) ? $cfg['DefaultTabServer']  : $cfg['DefaultTabDatabase']) . '?' . $url_query . '" name="phpmain' . $phpmain_hash . '" frameborder="1" />' . "\n";

}
?>

    <noframes>
        <body bgcolor="#FFFFFF">
            <p><?php echo $strNoFrames; ?></p>
        </body>
    </noframes>
</frameset>
<?php
if ($cfg['QueryFrame'] && $cfg['QueryFrameJS']) {
    echo '</noscript>' . "\n";
}
?>

</html>
