<?php
/* $Id$ */


/**
 * Gets core libraries and defines some variables
 */
require('./libraries/grab_globals.lib.php3');
require('./libraries/common.lib.php3');


/**
 * Displays PHP information
 */
$is_superuser = @mysql_query('USE mysql', $userlink);
if ($is_superuser || $cfg['ShowPhpInfo']) {
    phpinfo();
}
?>
