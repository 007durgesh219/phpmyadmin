<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Set of functions used with the relation and pdf feature
 *
 * This file also provides basic functions to use in other plungins!
 * These are declared in the 'GLOBAL Plugin functions' section
 *
 * Please use short and expressive names.
 * For now, special characters which aren't allowed in
 * filenames or functions should not be used.
 *
 * Please provide a comment for your function,
 * what it does and what parameters are available.
 *
 * @package PhpMyAdmin
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/**
 * Returns array of options from string with options separated by comma,
 * removes quotes
 *
 * <code>
 * PMA_transformation_getOptions("'option ,, quoted',abd,'2,3',");
 * // array {
 * //     'option ,, quoted',
 * //     'abc',
 * //     '2,3',
 * //     '',
 * // }
 * </code>
 *
 * @param string $option_string comma separated options
 *
 * @return array options
 */
function PMA_transformation_getOptions($option_string)
{
    $result = array();

    if (! strlen($option_string)
        || ! $transform_options = preg_split('/,/', $option_string)
    ) {
        return $result;
    }

    while (($option = array_shift($transform_options)) !== null) {
        $trimmed = trim($option);
        if (strlen($trimmed) > 1
            && $trimmed[0] == "'"
            && $trimmed[strlen($trimmed) - 1] == "'"
        ) {
            // '...'
            $option = substr($trimmed, 1, -1);
        } elseif (isset($trimmed[0]) && $trimmed[0] == "'") {
            // '...,
            $trimmed = ltrim($option);
            while (($option = array_shift($transform_options)) !== null) {
                // ...,
                $trimmed .= ',' . $option;
                $rtrimmed = rtrim($trimmed);
                if ($rtrimmed[strlen($rtrimmed) - 1] == "'") {
                    // ,...'
                    break;
                }
            }
            $option = substr($rtrimmed, 1, -1);
        }
        $result[] = stripslashes($option);
    }

    return $result;
}

/**
 * Gets all available MIME-types
 *
 * @access  public
 * @staticvar   array   mimetypes
 * @return array    array[mimetype], array[transformation]
 */
function PMA_getAvailableMIMEtypes()
{
    static $stack = null;

    if (null !== $stack) {
        return $stack;
    }

    $stack = array();
    $filestack = array();

    $handle = opendir('./libraries/plugins/transformations');

    if (! $handle) {
        return $stack;
    }

    while ($file = readdir($handle)) {
        $filestack[] = $file;
    }

    closedir($handle);
    sort($filestack);

    foreach ($filestack as $file) {
        if (preg_match('|^.*_.*_.*\.class\.php$|', $file)) {
            // File contains transformation functions.
            $parts = explode('_', str_replace('.class.php', '', $file));
            $mimetype = $parts[0] . "/" . $parts[1];
            $stack['mimetype'][$mimetype] = $mimetype;
            $stack['transformation'][] = $mimetype . ': ' . $parts[2];
            $stack['transformation_file'][] = $file;

        } elseif (preg_match('|^.*\.class.php$|', $file)) {
            // File is a plain mimetype, no functions.
            $base = str_replace('.class.php', '', $file);

            if ($base != 'global') {
                $mimetype = str_replace('_', '/', $base);
                $stack['mimetype'][$mimetype] = $mimetype;
                $stack['empty_mimetype'][$mimetype] = $mimetype;
            }
        }
    }

    return $stack;
}

/**
 * Returns the description of the transformation
 *
 * @param string $file           transformation file
 * @param string $html_formatted whether the description should be formatted
 *                               as HTML
 *
 * @return the description of the transformation
 */
function PMA_getTransformationDescription($file, $html_formatted = true)
{
    // get the transformation class name
    $class_name = explode(".class.php", $file);
    $class_name = $class_name[0];

    // include and instantiate the class
    require_once 'libraries/plugins/transformations/' . $file;
    return $class_name::getInfo();
}

/**
 * Gets the mimetypes for all columns of a table
 *
 * @param string $db     the name of the db to check for
 * @param string $table  the name of the table to check for
 * @param string $strict whether to include only results having a mimetype set
 *
 * @access  public
 *
 * @return array [field_name][field_key] = field_value
 */
function PMA_getMIME($db, $table, $strict = false)
{
    $cfgRelation = PMA_getRelationsParam();

    if (! $cfgRelation['commwork']) {
        return false;
    }

    $com_qry  = '
         SELECT `column_name`,
                `mimetype`,
                `transformation`,
                `transformation_options`
         FROM ' . PMA_backquote($cfgRelation['db']) . '.'
        . PMA_backquote($cfgRelation['column_info']) . '
         WHERE `db_name`    = \'' . PMA_sqlAddSlashes($db) . '\'
           AND `table_name` = \'' . PMA_sqlAddSlashes($table) . '\'
           AND ( `mimetype` != \'\'' . (!$strict ? '
              OR `transformation` != \'\'
              OR `transformation_options` != \'\'' : '') . ')';
    return PMA_DBI_fetch_result(
        $com_qry, 'column_name', null, $GLOBALS['controllink']
    );
} // end of the 'PMA_getMIME()' function

/**
 * Set a single mimetype to a certain value.
 *
 * @param string $db                     the name of the db
 * @param string $table                  the name of the table
 * @param string $key                    the name of the column
 * @param string $mimetype               the mimetype of the column
 * @param string $transformation         the transformation of the column
 * @param string $transformation_options the transformation options of the column
 * @param string $forcedelete            force delete, will erase any existing
 *                                       comments for this column
 *
 * @access  public
 *
 * @return boolean  true, if comment-query was made.
 */
function PMA_setMIME($db, $table, $key, $mimetype, $transformation,
    $transformation_options, $forcedelete = false
) {
    $cfgRelation = PMA_getRelationsParam();

    if (! $cfgRelation['commwork']) {
        return false;
    }

    $test_qry  = '
         SELECT `mimetype`,
                `comment`
           FROM ' . PMA_backquote($cfgRelation['db']) . '.'
        . PMA_backquote($cfgRelation['column_info']) . '
          WHERE `db_name`     = \'' . PMA_sqlAddSlashes($db) . '\'
            AND `table_name`  = \'' . PMA_sqlAddSlashes($table) . '\'
            AND `column_name` = \'' . PMA_sqlAddSlashes($key) . '\'';
    $test_rs   = PMA_queryAsControlUser($test_qry, true, PMA_DBI_QUERY_STORE);

    if ($test_rs && PMA_DBI_num_rows($test_rs) > 0) {
        $row = @PMA_DBI_fetch_assoc($test_rs);
        PMA_DBI_free_result($test_rs);

        if (! $forcedelete
            && (strlen($mimetype) || strlen($transformation)
            || strlen($transformation_options) || strlen($row['comment']))
        ) {
            $upd_query = '
               UPDATE ' . PMA_backquote($cfgRelation['db']) . '.'
                . PMA_backquote($cfgRelation['column_info']) . '
                   SET `mimetype`               = \''
                . PMA_sqlAddSlashes($mimetype) . '\',
                       `transformation`         = \''
                . PMA_sqlAddSlashes($transformation) . '\',
                       `transformation_options` = \''
                . PMA_sqlAddSlashes($transformation_options) . '\'';
        } else {
            $upd_query = 'DELETE FROM ' . PMA_backquote($cfgRelation['db']) . '.'
                . PMA_backquote($cfgRelation['column_info']);
        }
        $upd_query .= '
            WHERE `db_name`     = \'' . PMA_sqlAddSlashes($db) . '\'
              AND `table_name`  = \'' . PMA_sqlAddSlashes($table) . '\'
              AND `column_name` = \'' . PMA_sqlAddSlashes($key) . '\'';
    } elseif (strlen($mimetype) || strlen($transformation)
     || strlen($transformation_options)) {
        $upd_query = 'INSERT INTO ' . PMA_backquote($cfgRelation['db'])
            . '.' . PMA_backquote($cfgRelation['column_info'])
            . ' (db_name, table_name, column_name, mimetype, transformation,'
            . ' transformation_options) '
            . ' VALUES('
            . '\'' . PMA_sqlAddSlashes($db) . '\','
            . '\'' . PMA_sqlAddSlashes($table) . '\','
            . '\'' . PMA_sqlAddSlashes($key) . '\','
            . '\'' . PMA_sqlAddSlashes($mimetype) . '\','
            . '\'' . PMA_sqlAddSlashes($transformation) . '\','
            . '\'' . PMA_sqlAddSlashes($transformation_options) . '\')';
    }

    if (isset($upd_query)) {
        return PMA_queryAsControlUser($upd_query);
    } else {
        return false;
    }
} // end of 'PMA_setMIME()' function


/**
 * GLOBAL Plugin functions
 */


/**
 * Replaces "[__BUFFER__]" occurences found in $options['string'] with the text
 * in $buffer, after performing a regular expression search and replace on
 * $buffer using $options['regex'] and $options['regex_replace'].
 *
 * @param string $buffer  text that will be replaced in $options['string'],
 *                        after being formatted
 * @param array  $options the options required to format $buffer
 *     = array (
 *         'string'        => 'string', // text containing "[__BUFFER__]"
 *         'regex'         => 'mixed',  // the pattern to search for
 *         'regex_replace' => 'mixed',  // string or array of strings to replace
 *                                      // with
 *     );
 *
 * @return string containing the text with all the replacements
 */
function PMA_transformation_global_html_replace($buffer, $options = array())
{
    if ( ! isset($options['string']) ) {
        $options['string'] = '';
    }

    if (isset($options['regex']) && isset($options['regex_replace'])) {
        $buffer = preg_replace(
            '@' . str_replace('@', '\@', $options['regex']) . '@si',
            $options['regex_replace'],
            $buffer
        );
    }

    // Replace occurences of [__BUFFER__] with actual text
    $return = str_replace("[__BUFFER__]", $buffer, $options['string']);
    return $return;
}
?>
