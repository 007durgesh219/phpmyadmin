<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Displays form for editing and inserting new table rows
 *
 * register_globals_save (mark this file save for disabling register globals)
 *
 * @version $Id$
 */

/**
 * Gets the variables sent or posted to this script and displays the header
 */
require_once './libraries/common.inc.php';

/**
 * Ensures db and table are valid, else moves to the "parent" script
 */
require_once './libraries/db_table_exists.lib.php';


/**
 * Sets global variables.
 * Here it's better to use a if, instead of the '?' operator
 * to avoid setting a variable to '' when it's not present in $_REQUEST
 */
/**
 * @todo this one is badly named, it's really a WHERE condition
 *       and exists even for tables not having a primary key or unique key
 */
if (isset($_REQUEST['primary_key'])) {
    $primary_key = $_REQUEST['primary_key'];
}
if (isset($_SESSION['edit_next'])) {
    $primary_key = $_SESSION['edit_next'];
    unset($_SESSION['edit_next']);
    $after_insert = 'edit_next';
}
if (isset($_REQUEST['sql_query'])) {
    $sql_query = $_REQUEST['sql_query'];
}
if (isset($_REQUEST['ShowFunctionFields'])) {
    $cfg['ShowFunctionFields'] = $_REQUEST['ShowFunctionFields'];
}

/**
 * load relation data, foreign keys
 */
require_once './libraries/relation.lib.php';

/**
 * file listing
 */
require_once './libraries/file_listing.php';


/**
 * Defines the url to return to in case of error in a sql statement
 * (at this point, $GLOBALS['goto'] will be set but could be empty)
 */
if (empty($GLOBALS['goto'])) {
    $GLOBALS['goto'] = 'db_sql.php';
}
/**
 * @todo check if we could replace by "db_|tbl_" - please clarify!?
 */
$_url_params = array(
    'db'        => $db,
    'sql_query' => $sql_query
);

if (preg_match('@^tbl_@', $GLOBALS['goto'])) {
    $_url_params['table'] = $table;
}

$err_url = $GLOBALS['goto'] . PMA_generate_common_url($_url_params);
unset($_url_params);


/**
 * Sets parameters for links
 * where is this variable used?
 * replace by PMA_generate_common_url($url_params);
 */
$url_query = PMA_generate_common_url($url_params, 'html', '');

/**
 * get table information
 * @todo should be done by a Table object
 */
require_once './libraries/tbl_info.inc.php';

/**
 * Get comments for table fileds/columns
 */
$comments_map = array();

if ($GLOBALS['cfg']['ShowPropertyComments']) {
    require_once './libraries/relation.lib.php';
    require_once './libraries/transformations.lib.php';

    $cfgRelation = PMA_getRelationsParam();

    $comments_map = PMA_getComments($db, $table);
}

/**
 * START REGULAR OUTPUT
 */

/**
 * used in ./libraries/header.inc.php to load JavaScript library file
 */
$js_to_run = 'tbl_change.js';

/**
 * HTTP and HTML headers
 */
require_once './libraries/header.inc.php';

/**
 * Displays the query submitted and its result
 *
 * @todo where does $disp_message and $disp_query come from???
 */
if (! empty($disp_message)) {
    if (! isset($disp_query)) {
        $disp_query     = null;
    }
    PMA_showMessage($disp_message, $disp_query);
}

/**
 * Displays top menu links
 */
require_once './libraries/tbl_links.inc.php';


/**
 * Get the analysis of SHOW CREATE TABLE for this table
 * @todo should be handled by class Table
 */
$show_create_table = PMA_DBI_fetch_value(
        'SHOW CREATE TABLE ' . PMA_backquote($db) . '.' . PMA_backquote($table),
        0, 1);
$analyzed_sql = PMA_SQP_analyze(PMA_SQP_parse($show_create_table));
unset($show_create_table);

/**
 * Get the list of the fields of the current table
 */
PMA_DBI_select_db($db);
$table_fields = PMA_DBI_fetch_result('SHOW FIELDS FROM ' . PMA_backquote($table) . ';',
    null, null, null, PMA_DBI_QUERY_STORE);
$rows               = array();
if (isset($primary_key)) {
    // when in edit mode load all selected rows from table
    $insert_mode = false;
    if (is_array($primary_key)) {
        $primary_key_array = $primary_key;
    } else {
        $primary_key_array = array(0 => $primary_key);
    }

    $result             = array();
    $found_unique_key   = false;
    foreach ($primary_key_array as $key_id => $primary_key) {
        $local_query           = 'SELECT * FROM ' . PMA_backquote($db) . '.' . PMA_backquote($table) . ' WHERE ' . $primary_key . ';';
        $result[$key_id]       = PMA_DBI_query($local_query, null, PMA_DBI_QUERY_STORE);
        $rows[$key_id]         = PMA_DBI_fetch_assoc($result[$key_id]);
        $primary_keys[$key_id] = str_replace('\\', '\\\\', $primary_key);

        // No row returned
        if (! $rows[$key_id]) {
            unset($rows[$key_id], $primary_key_array[$key_id]);
            PMA_showMessage($strEmptyResultSet, $local_query);
            echo "\n";
            require_once './libraries/footer.inc.php';
        } else { // end if (no record returned)
            $meta = PMA_DBI_get_fields_meta($result[$key_id]);
            if ($tmp = PMA_getUniqueCondition($result[$key_id], count($meta), $meta, $rows[$key_id], true)) {
                $found_unique_key = true;
            }
            unset($tmp);
        }
    }
} else {
    // no primary key given, just load first row - but what happens if tbale is empty?
    $insert_mode = true;
    $result = PMA_DBI_query('SELECT * FROM ' . PMA_backquote($db) . '.' . PMA_backquote($table) . ' LIMIT 1;', null, PMA_DBI_QUERY_STORE);
    $rows = array_fill(0, $cfg['InsertRows'], false);
}

// <markus@noga.de>
// retrieve keys into foreign fields, if any
$cfgRelation = PMA_getRelationsParam();
$foreigners  = ($cfgRelation['relwork'] ? PMA_getForeigners($db, $table) : FALSE);


/**
 * Displays the form
 */
// loic1: autocomplete feature of IE kills the "onchange" event handler and it
//        must be replaced by the "onpropertychange" one in this case
$chg_evt_handler = (PMA_USR_BROWSER_AGENT == 'IE' && PMA_USR_BROWSER_VER >= 5)
                 ? 'onpropertychange'
                 : 'onchange';
// Had to put the URI because when hosted on an https server,
// some browsers send wrongly this form to the http server.

if ($cfg['CtrlArrowsMoving']) {
    ?>
<!-- Set on key handler for moving using by Ctrl+arrows -->
<script src="./js/keyhandler.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
var switch_movement = 0;
document.onkeydown = onKeyDownArrowsHandler;
//]]>
</script>
    <?php
}

$_form_params = array(
    'db'        => $db,
    'table'     => $table,
    'goto'      => $GLOBALS['goto'],
    'err_url'   => $err_url,
    'sql_query' => $sql_query,
);
if (isset($primary_keys)) {
    foreach ($primary_key_array as $key_id => $primary_key) {
        $_form_params['primary_key[' . $key_id . ']'] = trim($primary_key);
    }
}

?>
<!-- Insert/Edit form -->
<form method="post" action="tbl_replace.php" name="insertForm" <?php if ($is_upload) { echo ' enctype="multipart/form-data"'; } ?>>
<?php
echo PMA_generate_common_hidden_inputs($_form_params);

$titles['Browse'] = PMA_getIcon('b_browse.png', $strBrowseForeignValues);

// Set if we passed the first timestamp field
$timestamp_seen = 0;
$fields_cnt     = count($table_fields);

$tabindex = 0;
$tabindex_for_function = +1000;
$tabindex_for_null     = +2000;
$tabindex_for_value    = 0;
$o_rows   = 0;
$biggest_max_file_size = 0;

// user can toggle the display of Function column
// (currently does not work for multi-edits)
$url_params['db'] = $db;
$url_params['table'] = $table;
if (isset($primary_key)) {
    $url_params['primary_key'] = trim($primary_key);
}
if (! empty($sql_query)) {
    $url_params['sql_query'] = $sql_query;
}

if (! $cfg['ShowFunctionFields']) {
    $this_url_params = array_merge($url_params,
        array('ShowFunctionFields' => 1));
    echo $strShow . ' : <a href="tbl_change.php' . PMA_generate_common_url($this_url_params) . '">' . $strFunction . '</a>' . "\n";
}

foreach ($rows as $row_id => $vrow) {
    if ($vrow === false) {
        unset($vrow);
    }

    $jsvkey = $row_id;
    $browse_foreigners_uri = '&amp;pk=' . $row_id;
    $vkey = '[multi_edit][' . $jsvkey . ']';

    $vresult = (isset($result) && is_array($result) && isset($result[$row_id]) ? $result[$row_id] : $result);
    if ($insert_mode && $row_id > 0) {
        echo '<input type="checkbox" checked="checked" name="insert_ignore_' . $row_id . '" id="insert_ignore_check_' . $row_id . '" />';
        echo '<label for="insert_ignore_check_' . $row_id . '">' . $strIgnore . '</label><br />' . "\n";
    }
?>
    <table>
        <tr>
            <th><?php echo $strField; ?></th>
            <th><?php echo $strType; ?></th>
<?php
    if ($cfg['ShowFunctionFields']) {
        $this_url_params = array_merge($url_params,
            array('ShowFunctionFields' => 0));
        echo '          <th><a href="tbl_change.php' . PMA_generate_common_url($this_url_params) . '" title="' . $strHide . '">' . $strFunction . '</a></th>' . "\n";
    }
?>
            <th><?php echo $strNull; ?></th>
            <th><?php echo $strValue; ?></th>
        </tr>
<?php

    // garvin: For looping on multiple rows, we need to reset any variable used inside the loop to indicate sth.
    $timestamp_seen = 0;
    unset($first_timestamp);

    // Sets a multiplier used for input-field counts (as zero cannot be used, advance the counter plus one)
    $m_rows = $o_rows + 1;

    $odd_row = true;
    for ($i = 0; $i < $fields_cnt; $i++) {
        $table_field   = $table_fields[$i];
        $table_field['True_Type'] = preg_replace('@\(.*@s', '', $table_field['Type']);

        $field      = $table_field['Field'];
        $field_html = htmlspecialchars($field);
        $field_md5  = md5($field);

        $unnullify_trigger = $chg_evt_handler . "=\"return unNullify('" . PMA_escapeJsString($field_html) . "', '" . PMA_escapeJsString($jsvkey) . "')\"";
        $field_name_appendix =  $vkey . '[' . $field_html . ']';
        $field_name_appendix_md5 = $field_md5 . $vkey . '[]';


        // removed previous PHP3-workaround that caused a problem with
        // field names like '000'
        //$rowfield = $field;

        // d a t e t i m e
        //
        // loic1: current date should not be set as default if the field is NULL
        //        for the current row
        // lem9:  but do not put here the current datetime if there is a default
        //        value (the real default value will be set in the
        //        Default value logic below)

        // Note: (tested in MySQL 4.0.16): when lang is some UTF-8,
        // $table_field['Default'] is not set if it contains NULL:
        // Array ([Field] => d [Type] => datetime [Null] => YES [Key] => [Extra] => [True_Type] => datetime)
        // but, look what we get if we switch to iso: (Default is NULL)
        // Array ([Field] => d [Type] => datetime [Null] => YES [Key] => [Default] => [Extra] => [True_Type] => datetime)
        // so I force a NULL into it (I don't think it's possible
        // to have an empty default value for DATETIME)
        // then, the "if" after this one will work
        if ($table_field['Type'] == 'datetime'
         && ! isset($table_field['Default'])
         && isset($table_field['Null'])
         && $table_field['Null'] == 'YES') {
            $table_field['Default'] = null;
        }

        if ($table_field['Type'] == 'datetime'
         && ! isset($table_field['Default'])
         && ! is_null($table_field['Default'])) {
            // INSERT case
            if ($insert_mode) {
                $vrow[$field] = date('Y-m-d H:i:s', time());
            }
            // UPDATE case with an empty and not NULL value under PHP4
            elseif (empty($vrow[$field]) && is_null($vrow[$field])) {
                $vrow[$field] = date('Y-m-d H:i:s', time());
            } // end if... elseif...
        }
        $len             = (preg_match('@float|double@', $table_field['Type']))
                         ? 100
                         : PMA_DBI_field_len($vresult, $i);
        $first_timestamp = 0;

        $field_name = $field_html;
        if (isset($comments_map[$field])) {
            $field_name = '<span style="border-bottom: 1px dashed black;" title="'
                . htmlspecialchars($comments_map[$field]) . '">' . $field_name . '</span>';
        }

        ?>
        <tr class="<?php echo $odd_row ? 'odd' : 'even'; ?>">
            <td <?php echo ($cfg['LongtextDoubleTextarea'] && strstr($table_field['True_Type'], 'longtext') ? 'rowspan="2"' : ''); ?> align="center"><?php echo $field_name; ?></td>

        <?php
        // The type column
        $is_binary            = stristr($table_field['Type'], 'binary');
        $is_blob              = stristr($table_field['Type'], 'blob');
        $is_char              = stristr($table_field['Type'], 'char');
        switch ($table_field['True_Type']) {
            case 'set':
                $type         = 'set';
                $type_nowrap  = '';
                break;
            case 'enum':
                $type         = 'enum';
                $type_nowrap  = '';
                break;
            case 'timestamp':
                if (!$timestamp_seen) {   // can only occur once per table
                    $timestamp_seen  = 1;
                    $first_timestamp = 1;
                }
                $type         = $table_field['Type'];
                $type_nowrap  = ' nowrap="nowrap"';
                break;

            default:
                $type         = $table_field['Type'];
                $type_nowrap  = ' nowrap="nowrap"';
                break;
        }
        ?>
            <td align="center"<?php echo $type_nowrap; ?>>
                <?php echo $type; ?>
            </td>

        <?php

        // Prepares the field value
        $real_null_value = FALSE;
        if (isset($vrow)) {
            if (! isset($vrow[$field])
             || is_null($vrow[$field])) {
                $real_null_value = TRUE;
                $vrow[$field]    = '';
                $special_chars   = '';
                $data            = $vrow[$field];
            } elseif ($table_field['True_Type'] == 'bit') {
                $special_chars   = '';
                for ($j = 0; $j < ceil($len / 8); $j++) {
                    $special_chars .= sprintf('%08d', decbin(ord(substr($vrow[$field], $j, 1))));
                }
                $special_chars   = substr($special_chars, -$len);
            } else {
                // loic1: special binary "characters"
                if ($is_binary || $is_blob) {
                    $vrow[$field] = str_replace("\x00", '\0', $vrow[$field]);
                    $vrow[$field] = str_replace("\x08", '\b', $vrow[$field]);
                    $vrow[$field] = str_replace("\x0a", '\n', $vrow[$field]);
                    $vrow[$field] = str_replace("\x0d", '\r', $vrow[$field]);
                    $vrow[$field] = str_replace("\x1a", '\Z', $vrow[$field]);
                } // end if
                $special_chars   = htmlspecialchars($vrow[$field]);
                $data            = $vrow[$field];
            } // end if... else...
            // loic1: if a timestamp field value is not included in an update
            //        statement MySQL auto-update it to the current timestamp
            // lem9:  however, things have changed since MySQL 4.1, so
            //        it's better to set a fields_prev in this situation
            $backup_field  = '<input type="hidden" name="fields_prev'
                . $field_name_appendix . '" value="'
                . htmlspecialchars($vrow[$field]) . '" />';
        } else {
            // loic1: display default values
            if (!isset($table_field['Default'])) {
                $table_field['Default'] = '';
                $real_null_value          = TRUE;
                $data                     = '';
            } else {
                $data                     = $table_field['Default'];
            }
            $special_chars = htmlspecialchars($table_field['Default']);
            $backup_field  = '';
        }

        $idindex  = ($o_rows * $fields_cnt) + $i + 1;
        $tabindex = (($idindex - 1) * 3) + 1;

        // The function column
        // -------------------
        // Change by Bernard M. Piller <bernard@bmpsystems.com>
        // We don't want binary data to be destroyed
        // Note: from the MySQL manual: "BINARY doesn't affect how the column is
        //       stored or retrieved" so it does not mean that the contents is
        //       binary
        if ($cfg['ShowFunctionFields']) {
            if (($cfg['ProtectBinary'] && $is_blob && !$is_upload)
                || ($cfg['ProtectBinary'] == 'all' && $is_binary)) {
                echo '        <td align="center">' . $strBinary . '</td>' . "\n";
            } elseif (strstr($table_field['True_Type'], 'enum') || strstr($table_field['True_Type'], 'set')) {
                echo '        <td align="center">--</td>' . "\n";
            } else {
                ?>
            <td>
                <select name="funcs<?php echo $field_name_appendix; ?>" <?php echo $unnullify_trigger; ?> tabindex="<?php echo ($tabindex + $tabindex_for_function); ?>" id="field_<?php echo $idindex; ?>_1">
                    <option></option>
                <?php
                $selected     = '';

                // garvin: Find the current type in the RestrictColumnTypes. Will result in 'FUNC_CHAR'
                // or something similar. Then directly look up the entry in the RestrictFunctions array,
                // which will then reveal the available dropdown options
                if (isset($cfg['RestrictFunctions'])
                 && isset($cfg['RestrictColumnTypes'])
                 && isset($cfg['RestrictColumnTypes'][strtoupper($table_field['True_Type'])])
                 && isset($cfg['RestrictFunctions'][$cfg['RestrictColumnTypes'][strtoupper($table_field['True_Type'])]])) {
                    $current_func_type  = $cfg['RestrictColumnTypes'][strtoupper($table_field['True_Type'])];
                    $dropdown           = $cfg['RestrictFunctions'][$current_func_type];
                    $default_function   = $cfg['DefaultFunctions'][$current_func_type];
                } else {
                    $dropdown = array();
                    $default_function   = '';
                }

                $dropdown_built = array();
                $op_spacing_needed = FALSE;
                // garvin: loop on the dropdown array and print all available options for that field.
                $cnt_dropdown = count($dropdown);
                for ($j = 0; $j < $cnt_dropdown; $j++) {
                    // Is current function defined as default?
                    // For MySQL < 4.1.2, for the first timestamp we set as
                    // default function the one defined in config (which
                    // should be NOW()).
                    // For MySQL >= 4.1.2, we don't set the default function
                    // if there is a default value for the timestamp
                    // (not including CURRENT_TIMESTAMP)
                    // and the column does not have the
                    // ON UPDATE DEFAULT TIMESTAMP attribute.

                    if (!($table_field['True_Type'] == 'timestamp'
                      && !empty($table_field['Default'])
                      && !isset($analyzed_sql[0]['create_table_fields'][$field]['on_update_current_timestamp']))) {
                    $selected = ($first_timestamp && $dropdown[$j] == $cfg['DefaultFunctions']['first_timestamp'])
                                || (!$first_timestamp && $dropdown[$j] == $default_function)
                              ? ' selected="selected"'
                              : '';
                }
                    echo '                ';
                    echo '<option' . $selected . '>' . $dropdown[$j] . '</option>' . "\n";
                    $dropdown_built[$dropdown[$j]] = 'TRUE';
                    $op_spacing_needed = TRUE;
                }

                // garvin: For compatibility's sake, do not let out all other functions. Instead
                // print a separator (blank) and then show ALL functions which weren't shown
                // yet.
                $cnt_functions = count($cfg['Functions']);
                for ($j = 0; $j < $cnt_functions; $j++) {
                    if (!isset($dropdown_built[$cfg['Functions'][$j]]) || $dropdown_built[$cfg['Functions'][$j]] != 'TRUE') {
                        // Is current function defined as default?
                        $selected = ($first_timestamp && $cfg['Functions'][$j] == $cfg['DefaultFunctions']['first_timestamp'])
                                    || (!$first_timestamp && $cfg['Functions'][$j] == $default_function)
                                  ? ' selected="selected"'
                                  : '';
                        if ($op_spacing_needed == TRUE) {
                            echo '                ';
                            echo '<option value="">--------</option>' . "\n";
                            $op_spacing_needed = FALSE;
                        }

                        echo '                ';
                        echo '<option' . $selected . '>' . $cfg['Functions'][$j] . '</option>' . "\n";
                    }
                } // end for
                unset($selected);
                ?>
                </select>
            </td>
                <?php
            }
        } // end if ($cfg['ShowFunctionFields'])


        // The null column
        // ---------------
        echo '        <td>' . "\n";
        if ($table_field['Null'] == 'YES') {
            echo '            <input type="hidden" name="fields_null_prev' . $field_name_appendix . '"';
            if ($real_null_value && !$first_timestamp) {
                echo ' value="on"';
            }
            echo ' />' . "\n";

            if (!(($cfg['ProtectBinary'] && $is_blob) || ($cfg['ProtectBinary'] == 'all' && $is_binary))) {

                echo '            <input type="checkbox" tabindex="' . ($tabindex + $tabindex_for_null) . '"'
                     . ' name="fields_null' . $field_name_appendix . '"';
                if ($real_null_value && !$first_timestamp) {
                    echo ' checked="checked"';
                }
                echo ' id="field_' . ($idindex) . '_2"';
                $onclick         = ' onclick="if (this.checked) {nullify(';
                if (strstr($table_field['True_Type'], 'enum')) {
                    if (strlen($table_field['Type']) > 20) {
                        $onclick .= '1, ';
                    } else {
                        $onclick .= '2, ';
                    }
                } elseif (strstr($table_field['True_Type'], 'set')) {
                    $onclick     .= '3, ';
                } elseif ($foreigners && isset($foreigners[$field])) {
                    $onclick     .= '4, ';
                } else {
                    $onclick     .= '5, ';
                }
                $onclick         .= '\'' . PMA_escapeJsString($field_html) . '\', \'' . $field_md5 . '\', \'' . PMA_escapeJsString($vkey) . '\'); this.checked = true}; return true" />' . "\n";
                echo $onclick;
            } else {
                echo '            <input type="hidden" name="fields_null' . $field_name_appendix . '"';
                if ($real_null_value && !$first_timestamp) {
                    echo ' value="on"';
                }
                echo ' />' . "\n";
            }
        }
        echo '        </td>' . "\n";

        // The value column (depends on type)
        // ----------------

        require './libraries/get_foreign.lib.php';

        if (isset($foreign_link) && $foreign_link == true) {
            ?>
            <td>
            <?php echo $backup_field . "\n"; ?>
            <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>"
                value="foreign" />
            <input type="hidden" name="fields<?php echo $field_name_appendix; ?>"
                value="" id="field_<?php echo ($idindex); ?>_3A" />
            <input type="text" name="field_<?php echo $field_name_appendix_md5; ?>"
                class="textfield" <?php echo $unnullify_trigger; ?>
                tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                id="field_<?php echo ($idindex); ?>_3"
                value="<?php echo htmlspecialchars($data); ?>" />
            <script type="text/javascript">
            //<![CDATA[
                document.writeln('<a target="_blank" onclick="window.open(this.href, \'foreigners\', \'width=640,height=240,scrollbars=yes,resizable=yes\'); return false"');
                document.write(' href="browse_foreigners.php?');
                document.write('<?php echo PMA_generate_common_url($db, $table); ?>');
                document.writeln('&amp;field=<?php echo PMA_escapeJsString(urlencode($field) . $browse_foreigners_uri); ?>">');
                document.writeln('<?php echo str_replace("'", "\'", $titles['Browse']); ?></a>');
            //]]>
            </script>
            </td>
            <?php
        } elseif (isset($disp_row) && is_array($disp_row)) {
            ?>
            <td>
            <?php echo $backup_field . "\n"; ?>
            <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>"
                value="foreign" />
            <input type="hidden" name="fields<?php echo $field_name_appendix; ?>"
                value="" id="field_<?php echo $idindex; ?>_3A" />
            <select name="field_<?php echo $field_name_appendix_md5; ?>"
                <?php echo $unnullify_trigger; ?>
                tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                id="field_<?php echo ($idindex); ?>_3">
                <?php echo PMA_foreignDropdown($disp_row, $foreign_field, $foreign_display, $data, $cfg['ForeignKeyMaxLimit']); ?>
            </select>
            </td>
            <?php
            unset($disp_row);
        } elseif ($cfg['LongtextDoubleTextarea'] && strstr($type, 'longtext')) {
            ?>
            <td>&nbsp;</td>
        </tr>
        <tr class="<?php echo $odd_row ? 'odd' : 'even'; ?>">
            <td colspan="5" align="right">
                <?php echo $backup_field . "\n"; ?>
                <textarea name="fields<?php echo $field_name_appendix; ?>"
                    rows="<?php echo ($cfg['TextareaRows']*2); ?>"
                    cols="<?php echo ($cfg['TextareaCols']*2); ?>"
                    dir="<?php echo $text_dir; ?>"
                    id="field_<?php echo ($idindex); ?>_3"
                    <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    ><?php echo $special_chars; ?></textarea>
            </td>
          <?php
        } elseif (strstr($type, 'text')) {
            ?>
            <td>
                <?php echo $backup_field . "\n"; ?>
                <textarea name="fields<?php echo $field_name_appendix; ?>"
                    rows="<?php echo $cfg['TextareaRows']; ?>"
                    cols="<?php echo $cfg['TextareaCols']; ?>"
                    dir="<?php echo $text_dir; ?>"
                    id="field_<?php echo ($idindex); ?>_3"
                    <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    ><?php echo $special_chars; ?></textarea>
            </td>
            <?php
            echo "\n";
            if (strlen($special_chars) > 32000) {
                echo '        <td>' . $strTextAreaLength . '</td>' . "\n";
            }
        } elseif ($type == 'enum') {
            $enum        = PMA_getEnumSetOptions($table_field['Type']);
            $enum_cnt    = count($enum);
            ?>
            <td>
                <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>" value="enum" />
                <input type="hidden" name="fields<?php echo $field_name_appendix; ?>" value="" />
            <?php
            echo "\n" . '            ' . $backup_field;

            // show dropdown or radio depend on length
            if (strlen($table_field['Type']) > 20) {
                echo "\n";
                ?>
                <select name="field_<?php echo $field_name_appendix_md5; ?>"
                    <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    id="field_<?php echo ($idindex); ?>_3">
                    <option value="">&nbsp;</option>
                <?php
                echo "\n";

                for ($j = 0; $j < $enum_cnt; $j++) {
                    // Removes automatic MySQL escape format
                    $enum_atom = str_replace('\'\'', '\'', str_replace('\\\\', '\\', $enum[$j]));
                    echo '                ';
                    //echo '<option value="' . htmlspecialchars($enum_atom) . '"';
                    echo '<option value="' . htmlspecialchars($enum_atom) . '"';
                    if ($data == $enum_atom
                        || ($data == '' && (!isset($primary_key) || $table_field['Null'] != 'YES')
                            && isset($table_field['Default']) && $enum_atom == $table_field['Default'])) {
                        echo ' selected="selected"';
                    }
                    echo '>' . htmlspecialchars($enum_atom) . '</option>' . "\n";
                } // end for

                ?>
                </select>
                <?php
            } else {
                echo "\n";
                for ($j = 0; $j < $enum_cnt; $j++) {
                    // Removes automatic MySQL escape format
                    $enum_atom = str_replace('\'\'', '\'', str_replace('\\\\', '\\', $enum[$j]));
                    echo '            ';
                    echo '<input type="radio" name="field_' . $field_name_appendix_md5 . '"';
                    echo ' value="' . htmlspecialchars($enum_atom) . '"';
                    echo ' id="field_' . ($idindex) . '_3_'  . $j . '"';
                    echo ' onclick="';
                    echo "if (typeof(document.forms['insertForm'].elements['fields_null"
                        . $field_name_appendix . "']) != 'undefined') {document.forms['insertForm'].elements['fields_null"
                        . $field_name_appendix . "'].checked = false}";
                    echo '"';
                    if ($data == $enum_atom
                        || ($data == '' && (!isset($primary_key) || $table_field['Null'] != 'YES')
                            && isset($table_field['Default']) && $enum_atom == $table_field['Default'])) {
                        echo ' checked="checked"';
                    }
                    echo 'tabindex="' . ($tabindex + $tabindex_for_value) . '" />';
                    echo '<label for="field_' . $idindex . '_3_' . $j . '">'
                        . htmlspecialchars($enum_atom) . '</label>' . "\n";
                } // end for

            } // end else
            echo "\n";
            ?>
            </td>
            <?php
            echo "\n";
        } elseif ($type == 'set') {
            $set = PMA_getEnumSetOptions($table_field['Type']);

            if (isset($vset)) {
                unset($vset);
            }
            for ($vals = explode(',', $data); list($t, $k) = each($vals);) {
                $vset[$k] = 1;
            }
            $countset = count($set);
            $size = min(4, $countset);
            ?>
            <td>
                <?php echo $backup_field . "\n"; ?>
                <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>" value="set" />
                <input type="hidden" name="fields<?php echo $field_name_appendix; ?>" value="" />
                <select name="field_<?php echo $field_name_appendix_md5; ?>"
                    size="<?php echo $size; ?>"
                    multiple="multiple" <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    id="field_<?php echo ($idindex); ?>_3">
            <?php
            echo "\n";
            for ($j = 0; $j < $countset; $j++) {
                echo '                ';
                //echo '<option value="'. htmlspecialchars($set[$j]) . '"';
                echo '<option value="'. htmlspecialchars($set[$j]) . '"';
                if (isset($vset[$set[$j]]) && $vset[$set[$j]]) {
                    echo ' selected="selected"';
                }
                echo '>' . htmlspecialchars($set[$j]) . '</option>' . "\n";
            } // end for
            ?>
                </select>
            </td>
            <?php
        }
        // Change by Bernard M. Piller <bernard@bmpsystems.com>
        // We don't want binary data destroyed
        elseif ($is_binary || $is_blob) {
            if (($cfg['ProtectBinary'] && $is_blob)
                || ($cfg['ProtectBinary'] == 'all' && $is_binary)) {
                echo "\n";
                ?>
            <td>
                <?php
                    echo $strBinaryDoNotEdit;
                    if (isset($data)) {
                        $data_size = PMA_formatByteDown(strlen(stripslashes($data)), 3, 1);
                        echo ' ('. $data_size [0] . ' ' . $data_size[1] . ')';
                        unset($data_size);
                    }
                    echo "\n";
                ?>
                <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>" value="protected" />
                <input type="hidden" name="fields<?php echo $field_name_appendix; ?>" value="" />
                <?php
            } elseif ($is_blob) {
                echo "\n";
                ?>
            <td>
                <?php echo $backup_field . "\n"; ?>
                <textarea name="fields<?php echo $field_name_appendix; ?>"
                    rows="<?php echo $cfg['TextareaRows']; ?>"
                    cols="<?php echo $cfg['TextareaCols']; ?>"
                    dir="<?php echo $text_dir; ?>"
                    id="field_<?php echo ($idindex); ?>_3"
                    <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    ><?php echo $special_chars; ?></textarea>
                <?php

            } else {
                // field size should be at least 4 and max 40
                $fieldsize = min(max($len, 4), 40);
                echo "\n";
                ?>
            <td>
                <?php echo $backup_field . "\n"; ?>
                <input type="text" name="fields<?php echo $field_name_appendix; ?>"
                    value="<?php echo $special_chars; ?>" size="<?php echo $fieldsize; ?>"
                    class="textfield" <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    id="field_<?php echo ($idindex); ?>_3" />
                <?php
            } // end if...elseif...else

            // Upload choice (only for BLOBs because the binary
            // attribute does not imply binary contents)
            // (displayed whatever value the ProtectBinary has)

            if ($is_upload && $is_blob) {
                echo '<br />';
                echo '<input type="file" name="fields_upload_' . $field_html . $vkey . '" class="textfield" id="field_' . $idindex . '_3" size="10" />&nbsp;';

                // find maximum upload size, based on field type
                /**
                 * @todo with functions this is not so easy, as you can basically
                 * process any data with function like MD5
                 */
                $max_field_sizes = array(
                    'tinyblob'   =>        '256',
                    'blob'       =>      '65536',
                    'mediumblob' =>   '16777216',
                    'longblob'   => '4294967296'); // yeah, really

                $this_field_max_size = $max_upload_size; // from PHP max
                if ($this_field_max_size > $max_field_sizes[$type]) {
                   $this_field_max_size = $max_field_sizes[$type];
                }
                echo PMA_displayMaximumUploadSize($this_field_max_size) . "\n";
                // do not generate here the MAX_FILE_SIZE, because we should
                // put only one in the form to accommodate the biggest field
                if ($this_field_max_size > $biggest_max_file_size) {
                    $biggest_max_file_size = $this_field_max_size;
                }
            }

            if (!empty($cfg['UploadDir'])) {
                $files = PMA_getFileSelectOptions(PMA_userDir($cfg['UploadDir']));
                if ($files === FALSE) {
                    echo '        <font color="red">' . $strError . '</font><br />' . "\n";
                    echo '        ' . $strWebServerUploadDirectoryError . "\n";
                } elseif (!empty($files)) {
                    echo "<br />\n";
                    echo '    <i>' . $strOr . '</i>' . ' ' . $strWebServerUploadDirectory . ':<br />' . "\n";
                    echo '        <select size="1" name="fields_uploadlocal_' . $field_html . $vkey . '">' . "\n";
                    echo '            <option value="" selected="selected"></option>' . "\n";
                    echo $files;
                    echo '        </select>' . "\n";
                }
            } // end if (web-server upload directory)

            echo '</td>';

        } // end elseif (binary or blob)
        else {
            // field size should be at least 4 and max 40
            $fieldsize = min(max($len, 4), 40);
            ?>
            <td>
            <?php
            echo $backup_field . "\n";
            if ($is_char && ($cfg['CharEditing'] == 'textarea' || strpos($data, "\n") !== FALSE)) {
                echo "\n";
                ?>
                <textarea name="fields<?php echo $field_name_appendix; ?>"
                    rows="<?php echo $cfg['CharTextareaRows']; ?>"
                    cols="<?php echo $cfg['CharTextareaCols']; ?>"
                    dir="<?php echo $text_dir; ?>"
                    id="field_<?php echo ($idindex); ?>_3"
                    <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    ><?php echo $special_chars; ?></textarea>
                <?php
            } else {
                ?>
                <input type="text" name="fields<?php echo $field_name_appendix; ?>"
                    value="<?php echo $special_chars; ?>" size="<?php echo $fieldsize; ?>"
                    class="textfield" <?php echo $unnullify_trigger; ?>
                    tabindex="<?php echo ($tabindex + $tabindex_for_value); ?>"
                    id="field_<?php echo ($idindex); ?>_3" />
                <?php
                if ($table_field['Extra'] == 'auto_increment') {
                    ?>
                    <input type="hidden" name="auto_increment<?php echo $field_name_appendix; ?>" value="1" />
                    <?php
                } // end if
                if (substr($type, 0, 9) == 'timestamp') {
                    ?>
                    <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>" value="timestamp" />
                    <?php
                }
                if ($table_field['True_Type'] == 'bit') {
                    ?>
                    <input type="hidden" name="fields_type<?php echo $field_name_appendix; ?>" value="bit" />
                    <?php
                }
                if ($type == 'date' || $type == 'datetime' || substr($type, 0, 9) == 'timestamp') {
                    ?>
                    <script type="text/javascript">
                    //<![CDATA[
                    document.write('<a title="<?php echo $strCalendar;?>"');
                    document.write(' href="javascript:openCalendar(\'<?php echo PMA_generate_common_url();?>\', \'insertForm\', \'field_<?php echo ($idindex); ?>_3\', \'<?php echo (substr($type, 0, 9) == 'timestamp') ? 'datetime' : substr($type, 0, 9); ?>\')">');
                    document.write('<img class="calendar"');
                    document.write(' src="<?php echo $pmaThemeImage; ?>b_calendar.png"');
                    document.write(' alt="<?php echo $strCalendar; ?>"/></a>');
                    //]]>
                    </script>
                    <?php
                }
            }
            ?>
            </td>
            <?php
        }
        ?>
        </tr>
        <?php
        $odd_row = !$odd_row;
    } // end for
    $o_rows++;
?>
        <tr>
            <th colspan="5" align="right" class="tblFooters">
                <input type="submit" value="<?php echo $strGo; ?>" />&nbsp;
            </th>
        </tr>
        <?php
    echo '  </table><br />';
} // end foreach on multi-edit
?>
    <br />

    <fieldset>
    <table border="0" cellpadding="5" cellspacing="0">
    <tr>
        <td valign="middle" nowrap="nowrap">
            <select name="submit_type" tabindex="<?php echo ($tabindex + $tabindex_for_value + 1); ?>">
<?php
if (isset($primary_key)) {
    ?>
                <option value="<?php echo $strSave; ?>"><?php echo $strSave; ?></option>
    <?php
}
    ?>
                <option value="<?php echo $strInsertAsNewRow; ?>"><?php echo $strInsertAsNewRow; ?></option>
            </select>
    <?php
echo "\n";

if (!isset($after_insert)) {
    $after_insert = 'back';
}
?>
        </td>
        <td valign="middle">
            &nbsp;&nbsp;&nbsp;<b><?php echo $strAndThen; ?></b>&nbsp;&nbsp;&nbsp;
        </td>
        <td valign="middle" nowrap="nowrap">
            <select name="after_insert">
                <option value="back" <?php echo ($after_insert == 'back' ? 'selected="selected"' : ''); ?>><?php echo $strAfterInsertBack; ?></option>
                <option value="new_insert" <?php echo ($after_insert == 'new_insert' ? 'selected="selected"' : ''); ?>><?php echo $strAfterInsertNewInsert; ?></option>
<?php
if (isset($primary_key)) {
    ?>
                <option value="same_insert" <?php echo ($after_insert == 'same_insert' ? 'selected="selected"' : ''); ?>><?php echo $strAfterInsertSame; ?></option>
    <?php
    // If we have just numeric primary key, we can also edit next
    // in 2.8.2, we were looking for `field_name` = numeric_value
    //if (preg_match('@^[\s]*`[^`]*` = [0-9]+@', $primary_key)) {
    // in 2.9.0, we are looking for `table_name`.`field_name` = numeric_value
    if ($found_unique_key && preg_match('@^[\s]*`[^`]*`[\.]`[^`]*` = [0-9]+@', $primary_key)) {
        ?>
    <option value="edit_next" <?php echo ($after_insert == 'edit_next' ? 'selected="selected"' : ''); ?>><?php echo $strAfterInsertNext; ?></option>
        <?php
    }
}
?>
            </select>
        </td>
    </tr>

    <tr>
        <td>
<?php echo PMA_showHint($strUseTabKey); ?>
        </td>
        <td colspan="3" align="right" valign="middle">
            <input type="submit" value="<?php echo $strGo; ?>" tabindex="<?php echo ($tabindex + $tabindex_for_value + 6); ?>" id="buttonYes" />
            <input type="reset" value="<?php echo $strReset; ?>" tabindex="<?php echo ($tabindex + $tabindex_for_value + 7); ?>" />
        </td>
    </tr>
    </table>
    </fieldset>
    <?php if ($biggest_max_file_size > 0) {
            echo '        ' . PMA_generateHiddenMaxFileSize($biggest_max_file_size) . "\n";
          } ?>
</form>
<?php
if ($insert_mode) {
?>
<!-- Restart insertion form -->
<form method="post" action="tbl_replace.php" name="restartForm" >
    <?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
    <input type="hidden" name="goto" value="<?php echo htmlspecialchars($GLOBALS['goto']); ?>" />
    <input type="hidden" name="err_url" value="<?php echo htmlspecialchars($err_url); ?>" />
    <input type="hidden" name="sql_query" value="<?php echo htmlspecialchars($sql_query); ?>" />
<?php
    if (isset($primary_keys)) {
        foreach ($primary_key_array as $key_id => $primary_key) {
            echo '<input type="hidden" name="primary_key[' . $key_id . ']" value="' . htmlspecialchars(trim($primary_key)) . '" />'. "\n";
        }
    }
    $tmp = '<select name="insert_rows" id="insert_rows" onchange="this.form.submit();" >' . "\n";
    $option_values = array(1,2,5,10,15,20,30,40);
    foreach ($option_values as $value) {
        $tmp .= '<option value="' . $value . '"';
        if ($value == $cfg['InsertRows']) {
            $tmp .= ' selected="selected"';
        }
        $tmp .= '>' . $value . '</option>' . "\n";
    }
    $tmp .= '</select>' . "\n";
    echo "\n" . sprintf($strRestartInsertion, $tmp);
    unset($tmp);
    echo '<noscript><input type="submit" value="' . $strGo . '" /></noscript>' . "\n";
    echo '</form>' . "\n";
}

/**
 * Displays the footer
 */
require_once './libraries/footer.inc.php';
?>
