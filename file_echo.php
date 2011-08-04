<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * "Echo" service to allow force downloading of exported charts (png or svg)
 * and server status monitor settings
 *
 * @package phpMyAdmin
 */

require_once './libraries/common.inc.php';

if (isset($_REQUEST['filename']) && isset($_REQUEST['image'])) {
    $allowed = array(
        'image/png'     => 'png',
        'image/svg+xml' => 'svg',
    );

    /* Check whether MIME type is allowed */
    if (! isset($allowed[$_REQUEST['type']])) {
        die('Invalid export type');
    }

    /*
     * Check file name to match mime type and not contain new lines
     * to prevent response splitting.
     */
    if (! preg_match('/^[^\n\r]*\.' . $allowed[$_REQUEST['type']] . '$/', $_REQUEST['filename'])) {
        if (! preg_match('/^[^\n\r]*$/', $_REQUEST['filename'])) {
            /* Add extension */
            $filename = 'dowload.' . $allowed[$_REQUEST['type']];
        } else {
            /* Filename is unsafe, discard it */
            $filename = $_REQUEST['filename'] . '.' . $allowed[$_REQUEST['type']];
        }
    } else {
        /* Filename from request should be safe here */
        $filename = $_REQUEST['filename'];
    }

    /* Send download header */
    PMA_download_header($filename, $_REQUEST['type']);

    /* Send data */
    if ($allowed[$_REQUEST['type']] != 'svg') {
        echo base64_decode(substr($_REQUEST['image'], strpos($_REQUEST['image'],',') + 1));
    } else {
        echo $_REQUEST['image'];
    }

} else if (isset($_REQUEST['monitorconfig'])) {
    PMA_download_header('monitor.cfg', 'application/force-download');
    echo urldecode($_REQUEST['monitorconfig']);
} else if (isset($_REQUEST['import'])) {
    echo '<html><body>' . file_get_contents($_FILES['file']['tmp_name']) . '</body></html>';
}
?>
