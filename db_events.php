<?php

/**
 *
 */
require_once './libraries/common.inc.php';

$GLOBALS['js_include'][] = 'jquery/jquery-ui-1.8.custom.js';
$GLOBALS['js_include'][] = 'db_events.js';

require_once './libraries/common.lib.php';
require_once './libraries/db_common.inc.php';
require_once './libraries/db_info.inc.php';

/**
 * Create labels for the list
 */
$titles = PMA_buildActionTitles();

/**
 * Displays the header
 */
require_once './libraries/header.inc.php';

/**
 * Displays the tabs
 */
require_once './libraries/db_links.inc.php';

/**
 * Displays the list of events
 */
require_once './libraries/db_events.inc.php';

/**
 * Displays the footer
 */
require './libraries/footer.inc.php';


?>
