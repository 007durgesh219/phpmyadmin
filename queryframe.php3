<?php
/* $Id$ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * Gets the variables sent to this script, retains the db name that may have
 * been defined as startup option and include a core library
 */
require('./libraries/grab_globals.lib.php3');
if (!empty($db)) {
    $db_start = $db;
}


/**
 * Gets a core script and starts output buffering work
 */
require('./libraries/common.lib.php3');
require('./libraries/ob.lib.php3');
if ($cfg['OBGzip']) {
    $ob_mode = PMA_outBufferModeGet();
    if ($ob_mode) {
        PMA_outBufferPre($ob_mode);
    }
}

/**
 * Send http headers
 */
// Don't use cache (required for Opera)
$now = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $now);
header('Last-Modified: ' . $now);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
// Define the charset to be used
header('Content-Type: text/html; charset=' . $charset);


/**
 * Displays the frame
 */
// Gets the font sizes to use
PMA_setFontSizes();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $available_languages[$lang][2]; ?>" lang="<?php echo $available_languages[$lang][2]; ?>" dir="<?php echo $text_dir; ?>">

<head>
    <title>phpMyAdmin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
    <base<?php if (!empty($cfg['PmaAbsoluteUri'])) echo ' href="' . $cfg['PmaAbsoluteUri'] . '"'; ?> />
    <style type="text/css">
    <!--
    body {font-family: <?php echo $left_font_family; ?>; font-size: <?php echo $font_size; ?>}
    div {font-family: <?php echo $left_font_family; ?>; font-size: <?php echo $font_size; ?>; color: #000000}
    .heada {font-family: <?php echo $left_font_family; ?>; font-size: <?php echo $font_size; ?>; color: #000000}
    .headaCnt {font-family: <?php echo $left_font_family; ?>; font-size: <?php echo $font_smaller; ?>; color: #000000}
    .parent {font-family: <?php echo $left_font_family; ?>; color: #000000; text-decoration: none}
    .child {font-family: <?php echo $left_font_family; ?>; font-size: <?php echo $font_smaller; ?>; color: #333399; text-decoration: none}
    .item, .item:active, .item:hover, .tblItem, .tblItem:active {font-size: <?php echo $font_smaller; ?>; color: #333399; text-decoration: none}
    .tblItem:hover {color: #FF0000; text-decoration: underline}
    //-->
    </style>
<?php
if ($cfg['QueryFrame'] && $cfg['QueryFrameJS']) {
?>
<script type="text/javascript" language="javascript">    
var querywindow = '';

function open_querywindow(url) {
    
    if (!querywindow.closed && querywindow.location) {
        querywindow.focus();
    } else {
        querywindow=window.open(url + '&db=' + document.queryframeform.db.value + '&table=' + document.queryframeform.table.value, 'js_querywindow','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=yes,resizable=yes,width=750,height=500');
    }

    if (!querywindow.opener) {
       querywindow.opener = self;
    }

	if (window.focus) {
        querywindow.focus();
    }
    
    return false;
}
</script>
<?php
}
?>
</head>

<body bgcolor="<?php echo $cfg['LeftBgColor']; ?>">
<form name="queryframeform" action="queryframe.php3" method="get">
<input type="hidden" name="db" value="" />
<input type="hidden" name="table" value="" />
<input type="hidden" name="framename" value="queryframe" />
</form>

<?php
$anchor = 'querywindow.php3?' . PMA_generate_common_url('', '');
if ($cfg['QueryFrameJS']) {
    $href = '#';
    $target = '';
    $onclick = 'onClick="javascript:open_querywindow(\'' . $anchor . '\'); return false;"';
} else {
    $href = $anchor;
    $target = 'target="phpmain"';
    $onclick = '';
}
?>
<center>
<a href="<?php echo $href; ?>" <?php echo $target . ' ' . $onclick; ?>><?php echo $strQueryFrame; ?></a>
</center>

</body>
</html>

<?php
/**
 * Close MySql connections
 */
if (isset($dbh) && $dbh) {
    @mysql_close($dbh);
}
if (isset($userlink) && $userlink) {
    @mysql_close($userlink);
}


/**
 * Sends bufferized data
 */
if (isset($cfg['OBGzip']) && $cfg['OBGzip']
    && isset($ob_mode) && $ob_mode) {
     PMA_outBufferPost($ob_mode);
}
?>
