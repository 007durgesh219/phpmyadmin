<?php
/* $Id$ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Library for extracting information about the available storage engines
 */

$GLOBALS['mysql_storage_engines'] = array();

if (PMA_MYSQL_INT_VERSION >= 40102) {
    /**
     * For MySQL >= 4.1.2, the job is easy...
     */
    $res = PMA_DBI_query('SHOW STORAGE ENGINES');
    while ($row = PMA_DBI_fetch_assoc($res)) {
        $GLOBALS['mysql_storage_engines'][strtolower($row['Engine'])] = $row;
    }
    PMA_DBI_free_result($res);
    unset($res, $row);
} else {
    /**
     * Emulating SHOW STORAGE ENGINES...
     */
    $GLOBALS['mysql_storage_engines'] = array(
        'myisam' => array(
            'Engine'  => 'MyISAM',
            'Support' => 'DEFAULT'
        ),
        'merge' => array(
            'Engine'  => 'MERGE',
            'Support' => 'YES'
        ),
        'heap' => array(
            'Engine'  => 'HEAP',
            'Support' => 'YES'
        ),
        'memory' => array(
            'Engine'  => 'MEMORY',
            'Support' => 'YES'
        )
    );
    $known_engines = array(
        'archive' => 'ARCHIVE',
        'bdb'     => 'BDB',
        'csv'     => 'CSV',
        'innodb'  => 'InnoDB',
        'isam'    => 'ISAM'
    );
    $res = PMA_DBI_query('SHOW VARIABLES LIKE \'have\\_%\';');
    while ($row = PMA_DBI_fetch_row($res)) {
        $current = substr($row[0], 5);
        if (!empty($known_engines[$current])) {
            $GLOBALS['mysql_storage_engines'][$current] = array(
                'Engine'  => $known_engines[$current],
                'Support' => $row[1]
            );
        }
    }
    PMA_DBI_free_result($res);
    unset($known_engines, $res, $row);
}

?>
