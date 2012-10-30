<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Navigation styles for the pmahomme theme
 *
 * @package    PhpMyAdmin-theme
 * @subpackage PMAHomme
 */

// unplanned execution path
if (! defined('PMA_MINIMUM_COMMON') && ! defined('TESTSUITE')) {
    exit();
}
?>

/******************************************************************************/
/* Navigation */

#pma_navigation {
    width: 240px;
    overflow: hidden;
    position: fixed;
    top: 0;
    <?php echo $left; ?>: 0;
    height: 100%;
    background: url(./themes/pmahomme/img/left_nav_bg.png) repeat-y right 0% #f3f3f3;
    color: <?php echo $GLOBALS['cfg']['NaviColor']; ?>;
}

#pma_navigation_content {
    width: 100%;
    position: absolute;
    top: 0;
    <?php echo $left; ?>: 0;
    z-index: 0;
}

#pma_navigation ul {
    margin: 0;
}

#pma_navigation form {
    margin: 0;
    padding: 0;
    display: inline;
}

#pma_navigation select#select_server,
#pma_navigation select#lightm_db {
    width: 100%;
}

/******************************************************************************/
/* classes */

#pma_navigation .navi_dbName {
    font-weight: bold;
    color: <?php echo $GLOBALS['cfg']['NaviDatabaseNameColor']; ?>;
}

/******************************************************************************/
/* specific elements */

#pma_navigation div.pageselector {
    text-align: center;
    margin: 0px 10px 0px 10px;
    border-left: 1px solid #666;
}

#pma_navigation div#pmalogo {
    <?php //better echo $GLOBALS['cfg']['logoBGC']; ?>
}

#pma_navigation div#recentTableList {
    text-align: center;
    margin: 20px 10px 0px 10px;
}

#pma_navigation div#recentTableList select {
    width: 80%;
}

#pma_navigation div#pmalogo,
#pma_navigation div#leftframelinks,
#pma_navigation div#databaseList,
#pma_navigation div.pageselector.dbselector {
    text-align: center;
    margin: 5px 10px 0px 10px;
    border: 0;
}

/* Navigation tree*/
#pma_navigation_tree {
    margin: 5px 0 0 10px;
    color: #444;
}
#pma_navigation_tree a {
    color: <?php echo $GLOBALS['cfg']['NaviColor']; ?>;
}
#pma_navigation_tree a:hover {
    color: <?php echo $GLOBALS['cfg']['NaviPointerColor']; ?>;
    text-decoration: underline;
}
#pma_navigation_tree ul {
    clear: both;
    padding: 0;
    list-style-type: none;
    margin: 0;
}
#pma_navigation_tree ul ul {
    position: relative;
}
#pma_navigation_tree li {
    white-space: nowrap;
    clear: both;
    min-height: 16px;
}
#pma_navigation_tree img {
	margin: 0;
}
#pma_navigation_tree div.block {
    position: relative;
    width:1.5em;
    height:1.5em;
    min-width: 16px;
    min-height: 16px;
    float: <?php echo $left; ?>;
}
#pma_navigation_tree div.block i,
#pma_navigation_tree div.block b {
    width: 1.5em;
    height: 1.5em;
    min-width: 16px;
    min-height: 8px;
    position: absolute;
    bottom: 0.7em;
    <?php echo $left; ?>: 0.75em;
    z-index: 0;
}
#pma_navigation_tree div.block i { /* Top and right segments for the tree element connections */
    display: block;
    border-<?php echo $left; ?>: 1px solid #666;
    border-bottom: 1px solid #666;
}
#pma_navigation_tree div.block i.first { /* Removes top segment */
    border-<?php echo $left; ?>: 0;
}
#pma_navigation_tree div.block b { /* Bottom segment for the tree element connections */
    display: block;
    height: 0.75em;
    bottom: 0;
    left: 0.75em;
    border-<?php echo $left; ?>: 1px solid #666;
}
#pma_navigation_tree div.block a {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 10;
}
#pma_navigation_tree div.block img {
    position: relative;
    top: -7px;
    left: -7px;
}
#pma_navigation_tree div.throbber img {
    top: 2px;
    left: 2px;
}
#pma_navigation_tree li.last > ul {
    background: none;
}
#pma_navigation_tree li > a, #pma_navigation_tree li > i {
    line-height: 1.5em;
    height: 1.5em;
    padding-<?php echo $left; ?>: 0.3em;
}
#pma_navigation_tree .list_container {
    border-<?php echo $left; ?>: 1px solid #666;
    margin-<?php echo $left; ?>: 0.75em;
    padding-<?php echo $left; ?>: 0.75em;
}
#pma_navigation_tree .last > .list_container {
    border-<?php echo $left; ?>: 0 solid #666;
}

/* Fast filter */
li.fast_filter {
    padding-<?php echo $left; ?>: 0.75em;
    margin-<?php echo $left; ?>: 0.75em;
    padding-<?php echo $right; ?>: 35px;
    border-<?php echo $left; ?>: 1px solid #666;
}
li.fast_filter input {
    width: 100%;
}
li.fast_filter span {
    position: relative;
    <?php echo $right; ?>: 1.5em;
    padding: 0.2em;
    cursor: pointer;
    font-weight: bold;
    color: #800;
}

/* Resize handler */
#pma_navigation_resizer {
    width: 3px;
    height: 100%;
    background-color: #aaa;
    cursor: col-resize;
    position: fixed;
    top: 0;
    <?php echo $left; ?>: 240px;
    z-index: 801;
}
#pma_navigation_collapser {
    width: 20px;
    height: 23px;
    line-height: 23px;
    background: #eee;
    color: #555;
    font-weight: bold;
    position: fixed;
    top: 0;
    <?php echo $left; ?>: 220px;
    text-align: center;
    cursor: pointer;
    z-index: 800;
    text-shadow: 0px 1px 0px #fff;
    filter: dropshadow(color=#fff, offx=0, offy=1);
    border: 1px solid #888;
}

/* Scroll handler */
#pma_navigation_scrollbar {
    display: none;
    position: fixed;
    top: 25px;
    <?php echo $left; ?>: 220px;
    width: 20px;
    background: #ddd;
    height: 100%;
    z-index: 1;
}
#pma_navigation_scrollbar_handle {
    position: absolute;
    width: 20px;
    background: #888;
}
