<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Events management.
 *
 * @package phpMyAdmin
 */

/**
 * Include required files
 */
require_once './libraries/common.inc.php';
require_once './libraries/common.lib.php';

/**
 * Include JavaScript libraries
 */
$GLOBALS['js_include'][] = 'jquery/jquery-ui-1.8.custom.js';
$GLOBALS['js_include'][] = 'jquery/timepicker.js';
$GLOBALS['js_include'][] = 'db_events.js';
$GLOBALS['js_include'][] = 'db_routines.js'; // FIXME

/**
 * Include all other files
 */
require_once './libraries/rte/rte_events.lib.php';
require_once './libraries/rte/rte_common.lib.php';

/**
 * Do the magic
 */
define('ITEM', 'events');
require_once './libraries/rte/rte_main.inc.php';

?>
