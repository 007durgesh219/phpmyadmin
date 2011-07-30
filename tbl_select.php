<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Handles table search tab
 *
 * display table search form, create SQL query from form data
 * and include sql.php to execute it
 *
 * @todo display search form again if no results from previous search
 * @package phpMyAdmin
 */

/**
 * Gets some core libraries
 */
require_once './libraries/common.inc.php';
require_once './libraries/mysql_charsets.lib.php';

$GLOBALS['js_include'][] = 'makegrid.js';
$GLOBALS['js_include'][] = 'sql.js';
$GLOBALS['js_include'][] = 'tbl_select.js';
$GLOBALS['js_include'][] = 'tbl_change.js';
$GLOBALS['js_include'][] = 'jquery/jquery-ui-1.8.custom.js';
$GLOBALS['js_include'][] = 'jquery/timepicker.js';
if ($GLOBALS['cfg']['PropertiesIconic'] == true) {
    $titles['Browse'] =
        '<img class="icon" width="16" height="16" src="' . $pmaThemeImage
        .'b_browse.png" alt="' . __('Browse foreign values') . '" title="'
        . __('Browse foreign values') . '" />';

    if ($GLOBALS['cfg']['PropertiesIconic'] === 'both') {
        $titles['Browse'] .= __('Browse foreign values');
    }
} else {
    $titles['Browse'] = __('Browse foreign values');
}

$geom_types = PMA_getGISDatatypes();
/**
 * Not selection yet required -> displays the selection form
 */
if (! isset($param) || $param[0] == '') {
    // Gets some core libraries
    require_once './libraries/tbl_common.php';
    //$err_url   = 'tbl_select.php' . $err_url;
    $url_query .= '&amp;goto=tbl_select.php&amp;back=tbl_select.php';

    /**
     * Gets tables informations
     */
    require_once './libraries/tbl_info.inc.php';

    /**
     * Displays top menu links
     */
    require_once './libraries/tbl_links.inc.php';

    if (! isset($goto)) {
        $goto = $GLOBALS['cfg']['DefaultTabTable'];
    }
    // Defines the url to return to in case of error in the next sql statement
    $err_url   = $goto . '?' . PMA_generate_common_url($db, $table);

    // Gets the list and number of fields
    $result     = PMA_DBI_query('SHOW FULL FIELDS FROM ' . PMA_backquote($table) . ' FROM ' . PMA_backquote($db) . ';', null, PMA_DBI_QUERY_STORE);
    $fields_cnt = PMA_DBI_num_rows($result);
    $fields_list = $fields_null = $fields_type = $fields_collation = array();
    $geom_column_present = false;
    while ($row = PMA_DBI_fetch_assoc($result)) {
        $fields_list[] = $row['Field'];
        $type          = $row['Type'];
        // check whether table contains geometric columns
        if (in_array($type, $geom_types)) {
            $geom_column_present = true;
        }
        // reformat mysql query output
        if (strncasecmp($type, 'set', 3) == 0
            || strncasecmp($type, 'enum', 4) == 0) {
            $type = str_replace(',', ', ', $type);
        } else {

            // strip the "BINARY" attribute, except if we find "BINARY(" because
            // this would be a BINARY or VARBINARY field type
            if (!preg_match('@BINARY[\(]@i', $type)) {
                $type = preg_replace('@BINARY@i', '', $type);
            }
            $type = preg_replace('@ZEROFILL@i', '', $type);
            $type = preg_replace('@UNSIGNED@i', '', $type);

            $type = strtolower($type);
        }
        if (empty($type)) {
            $type = '&nbsp;';
        }
        $fields_null[] = $row['Null'];
        $fields_type[] = $type;
        $fields_collation[] = !empty($row['Collation']) && $row['Collation'] != 'NULL'
                          ? $row['Collation']
                          : '';
    } // end while
    PMA_DBI_free_result($result);
    unset($result, $type);

    // retrieve keys into foreign fields, if any
    // check also foreigners even if relwork is FALSE (to get
    // foreign keys from innodb)
    $foreigners = PMA_getForeigners($db, $table);
    ?>
        <form method="post" action="tbl_select.php" name="insertForm" id="tbl_search_form" <?php echo ($GLOBALS['cfg']['AjaxEnable'] ? ' class="ajax"' : ''); ?>>
<?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
<input type="hidden" name="goto" value="<?php echo $goto; ?>" />
<input type="hidden" name="back" value="tbl_select.php" />

<fieldset id="fieldset_table_search">

<fieldset id="fieldset_table_qbe">
    <legend><?php echo __('Do a "query by example" (wildcard: "%")') ?></legend>
    <table class="data">
    <thead>
    <tr><?php
        // Display the Function column only if there is alteast one geomety colum
        if ($geom_column_present) {
            echo('<th>'); echo __('Function');  echo('</th>');
        }
        ?>
        <th><?php echo __('Column'); ?></th>
        <th><?php echo __('Type'); ?></th>
        <th><?php echo __('Collation'); ?></th>
        <th><?php echo __('Operator'); ?></th>
        <th><?php echo __('Value'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $odd_row = true;

    for ($i = 0; $i < $fields_cnt; $i++) {
        ?>
        <tr class="noclick <?php echo $odd_row ? 'odd' : 'even'; $odd_row = ! $odd_row; ?>">
            <?php
            // if 'Function' column is present
            if ($geom_column_present) {
                echo('<td>');
                // if a geometry column
                if (in_array($fields_type[$i], $geom_types)) {
                    echo('<select name="geom_func['. $i .']">');
                        // get the relevant list of functions
                        $funcs = PMA_getGISFunctions($fields_type[$i], false, true);
                        foreach ($funcs as $func) {
                            $name = $func['name'];
                            echo('<option value="' . htmlspecialchars($name) . '">'
                                . htmlspecialchars($name) . '</option>');
                        }
                    echo('</select>');
                } else {
                    echo('&nbsp;');
                }
                echo('</td>');
            }
            ?>
            <th><?php echo htmlspecialchars($fields_list[$i]); ?></th>
            <td><?php echo $fields_type[$i]; ?></td>
            <td><?php echo $fields_collation[$i]; ?></td>
            <td><select name="func[]">
        <?php
        // determine valid operators
        if (strncasecmp($fields_type[$i], 'enum', 4) == 0) {
            // enum operators
            $operators = array(
                '=',
                '!=',
            );
        } elseif (preg_match('@char|blob|text|set@i', $fields_type[$i])) {
            // text operators
            $operators = array(
               'LIKE',
               'LIKE %...%',
               'NOT LIKE',
               '=',
               '!=',
               'REGEXP',
               'REGEXP ^...$',
               'NOT REGEXP',
               "= ''",
               "!= ''",
               'IN (...)',
               'NOT IN (...)',
               'BETWEEN',
               'NOT BETWEEN',
            );
        } else {
            // numeric operators
            $operators = array(
               '=',
               '>',
               '>=',
               '<',
               '<=',
               '!=',
               'LIKE',
               'NOT LIKE',
               'IN (...)',
               'NOT IN (...)',
               'BETWEEN',
               'NOT BETWEEN',
            );
        } // end if... else...

        // if field can be NULL, add IS NULL and IS NOT NULL
        if ($fields_null[$i]) {
            $operators[] = 'IS NULL';
            $operators[] = 'IS NOT NULL';
        }
        foreach ($operators as $op) {
            echo "\n" . '                        '
               . '<option value="' .  htmlspecialchars($op) . '">' . htmlspecialchars($op) . '</option>';
        }
        ?>

                </select>
            </td>
            <td>
        <?php
        $field = $fields_list[$i];

        $foreignData = PMA_getForeignData($foreigners, $field, false, '', '');

        if ($foreigners && isset($foreigners[$field]) && is_array($foreignData['disp_row'])) {
            // f o r e i g n    k e y s
            echo '            <select name="fields[' . $i . ']">' . "\n";
            // go back to first row

            // here, the 4th parameter is empty because there is no current
            // value of data for the dropdown (the search page initial values
            // are displayed empty)
            echo PMA_foreignDropdown($foreignData['disp_row'],
                $foreignData['foreign_field'],
                $foreignData['foreign_display'],
                '', $GLOBALS['cfg']['ForeignKeyMaxLimit']);
            echo '            </select>' . "\n";
        } elseif ($foreignData['foreign_link'] == true) {
            ?>
            <input type="text" name="fields[<?php echo $i; ?>]"
                id="field_<?php echo md5($field); ?>[<?php echo $i; ?>]"
                class="textfield" />
            <script type="text/javascript">
            // <![CDATA[
                document.writeln('<a target="_blank" onclick="window.open(this.href, \'foreigners\', \'width=640,height=240,scrollbars=yes\'); return false" href="browse_foreigners.php?<?php echo PMA_generate_common_url($db, $table); ?>&amp;field=<?php echo urlencode($field); ?>&amp;fieldkey=<?php echo $i; ?>"><?php echo str_replace("'", "\'", $titles['Browse']); ?></a>');
            // ]]>
            </script>
            <?php
        } elseif (strncasecmp($fields_type[$i], 'enum', 4) == 0) {
            // e n u m s
            $enum_value=explode(', ', str_replace("'", '', substr($fields_type[$i], 5, -1)));
            $cnt_enum_value = count($enum_value);
            echo '            <select name="fields[' . $i . '][]"'
                .' multiple="multiple" size="' . min(3, $cnt_enum_value) . '">' . "\n";
            for ($j = 0; $j < $cnt_enum_value; $j++) {
                echo '                <option value="' . $enum_value[$j] . '">'
                    . $enum_value[$j] . '</option>';
            } // end for
            echo '            </select>' . "\n";
        } else {
            // o t h e r   c a s e s
            $the_class = 'textfield';
            $type = $fields_type[$i];
            if ($type == 'date') {
                $the_class .= ' datefield';
            } elseif ($type == 'datetime' || substr($type, 0, 9) == 'timestamp') {
                $the_class .= ' datetimefield';
            }
            echo '            <input type="text" name="fields[' . $i . ']"'
                .' size="40" class="' . $the_class . '" id="field_' . $i . '" />' .  "\n";
        };
        ?>
            <input type="hidden" name="names[<?php echo $i; ?>]"
                value="<?php echo htmlspecialchars($fields_list[$i]); ?>" />
            <input type="hidden" name="types[<?php echo $i; ?>]"
                value="<?php echo $fields_type[$i]; ?>" />
            <input type="hidden" name="collations[<?php echo $i; ?>]"
                value="<?php echo $fields_collation[$i]; ?>" />
        </td>
    </tr>
        <?php
    } // end for
    ?>
    </tbody>
    </table>
</fieldset>
<?php
    PMA_generate_slider_effect('searchoptions', __('Options'));
?>
<fieldset id="fieldset_select_fields">
    <legend><?php echo __('Select columns (at least one):'); ?></legend>
    <select name="param[]" size="<?php echo min($fields_cnt, 10); ?>"
        multiple="multiple">
    <?php
    // Displays the list of the fields
    foreach ($fields_list as $each_field) {
        echo '        '
            .'<option value="' . htmlspecialchars($each_field) . '"'
            .' selected="selected">' . htmlspecialchars($each_field)
            .'</option>' . "\n";
    }
    ?>
    </select>
    <input type="checkbox" name="distinct" value="DISTINCT" id="oDistinct" />
    <label for="oDistinct">DISTINCT</label>
</fieldset>

<fieldset id="fieldset_search_conditions">
    <legend><?php echo '<em>' . __('Or') . '</em> ' . __('Add search conditions (body of the "where" clause):'); ?></legend>
<?php echo PMA_showMySQLDocu('SQL-Syntax', 'Functions'); ?>

<input type="text" name="where" class="textfield" size="64" />
</fieldset>

<fieldset id="fieldset_limit_rows">
    <legend><?php echo __('Number of rows per page'); ?></legend>
    <input type="text" size="4" name="session_max_rows"
        value="<?php echo $GLOBALS['cfg']['MaxRows']; ?>" class="textfield" />
</fieldset>

<fieldset id="fieldset_display_order">
    <legend><?php echo __('Display order:'); ?></legend>
    <select name="orderField">
        <option value="--nil--"></option>
    <?php
    foreach ($fields_list as $each_field) {
        echo '        '
            .'<option value="' . htmlspecialchars($each_field) . '">'
            .htmlspecialchars($each_field) . '</option>' . "\n";
    } // end for
    ?>
    </select>
<?php
    $choices = array(
        'ASC'  => __('Ascending'),
        'DESC' => __('Descending')
    );
    PMA_display_html_radio('order', $choices, 'ASC', false, true, "formelement");
    unset($choices);
?>
</fieldset>
<br style="clear: both;"/>
</div>
</fieldset>
<fieldset class="tblFooters">
    <input type="hidden" name="max_number_of_fields"
        value="<?php echo $fields_cnt; ?>" />
    <input type="submit" name="submit" value="<?php echo __('Go'); ?>" />
</fieldset>
</form>
<div id="sqlqueryresults"></div>
    <?php
    require './libraries/footer.inc.php';
}


/**
 * Selection criteria have been submitted -> do the work
 */
else {
    // Builds the query

    $sql_query = 'SELECT ' . (isset($distinct) ? 'DISTINCT ' : '');

    // if all fields were selected to display, we do a SELECT *
    // (more efficient and this helps prevent a problem in IE
    // if one of the rows is edited and we come back to the Select results)

    if (count($param) == $max_number_of_fields) {
        $sql_query .= '* ';
    } else {
        $param = PMA_backquote($param);
        $sql_query .= implode(', ', $param);
    } // end if

    // avoid a loop, for example when $cfg['DefaultTabTable'] is set
    // to 'tbl_select.php'
    unset($param);

    $sql_query .= ' FROM ' . PMA_backquote($table);

    // The where clause
    if (trim($where) != '') {
        $sql_query .= ' WHERE ' . $where;
    } else {
        $w = $charsets = array();
        $unary_operators = array(
           'IS NULL' => 1,
           'IS NOT NULL' => 1,
           "= ''" => 1,
           "!= ''" => 1
        );
        $geom_unary_operators = array(
            'IsEmpty' => 1,
            'IsSimple' => 1,
            'IsRing' => 1,
            'IsClosed' => 1,
        );
        $cnt_func = count($func);
        reset($func);
        while (list($i, $func_type) = each($func)) {
            // If geometry funciton is set apply it to the field name
            if (isset($geom_func[$i]) && trim($geom_func[$i]) != '') {
                $backquoted_name = $geom_func[$i] . '(' . PMA_backquote($names[$i]) . ')';
                // If the intended where clause is something like 'IsEmpty(`spatial_col_name`)'
                if (isset($geom_unary_operators[$geom_func[$i]]) && trim($fields[$i]) == '') {
                    $w[] = $backquoted_name;
                    continue;
                }
            } else {
                $backquoted_name = PMA_backquote($names[$i]);
            }

            list($charsets[$i]) = explode('_', $collations[$i]);
            if (isset($unary_operators[$func_type])) {
                $fields[$i] = '';
                $w[] = $backquoted_name . ' ' . $func_type;

            } elseif (strncasecmp($types[$i], 'enum', 4) == 0) {
                if (!empty($fields[$i])) {
                    if (! is_array($fields[$i])) {
                        $fields[$i] = explode(',', $fields[$i]);
                    }
                    $enum_selected_count = count($fields[$i]);
                    if ($func_type == '=' && $enum_selected_count > 1) {
                        $func_type    = $func[$i] = 'IN';
                        $parens_open  = '(';
                        $parens_close = ')';

                    } elseif ($func_type == '!=' && $enum_selected_count > 1) {
                        $func_type    = $func[$i] = 'NOT IN';
                        $parens_open  = '(';
                        $parens_close = ')';

                    } else {
                        $parens_open  = '';
                        $parens_close = '';
                    }
                    $enum_where = '\'' . PMA_sqlAddSlashes($fields[$i][0]) . '\'';
                    for ($e = 1; $e < $enum_selected_count; $e++) {
                        $enum_where .= ', \'' . PMA_sqlAddSlashes($fields[$i][$e]) . '\'';
                    }

                    $w[] = $backquoted_name . ' ' . $func_type . ' ' . $parens_open . $enum_where . $parens_close;
                }

            } elseif ($fields[$i] != '') {
                // For these types we quote the value. Even if it's another type (like INT),
                // for a LIKE we always quote the value. MySQL converts strings to numbers
                // and numbers to strings as necessary during the comparison
                if (preg_match('@char|binary|blob|text|set|date|time|year@i', $types[$i]) || strpos(' ' . $func_type, 'LIKE')) {
                    $quot = '\'';
                } else {
                    $quot = '';
                }

                // LIKE %...%
                if ($func_type == 'LIKE %...%') {
                    $func_type = 'LIKE';
                    $fields[$i] = '%' . $fields[$i] . '%';
                }
                if ($func_type == 'REGEXP ^...$') {
                    $func_type = 'REGEXP';
                    $fields[$i] = '^' . $fields[$i] . '$';
                }

                if ($func_type == 'IN (...)' || $func_type == 'NOT IN (...)' || $func_type == 'BETWEEN' || $func_type == 'NOT BETWEEN') {
                    $func_type = str_replace(' (...)', '', $func_type);

                    // quote values one by one
                    $values = explode(',', $fields[$i]);
                    foreach ($values as &$value)
                        $value = $quot . PMA_sqlAddSlashes(trim($value)) . $quot;

                    if ($func_type == 'BETWEEN' || $func_type == 'NOT BETWEEN')
                        $w[] = $backquoted_name . ' ' . $func_type . ' ' . (isset($values[0]) ? $values[0] : '')  . ' AND ' . (isset($values[1]) ? $values[1] : '');
                    else
                        $w[] = $backquoted_name . ' ' . $func_type . ' (' . implode(',', $values) . ')';
                }
                else {
                    $w[] = $backquoted_name . ' ' . $func_type . ' ' . $quot . PMA_sqlAddSlashes($fields[$i]) . $quot;;
                }

            } // end if
        } // end for

        if ($w) {
            $sql_query .= ' WHERE ' . implode(' AND ', $w);
        }
    } // end if

    if ($orderField != '--nil--') {
        $sql_query .= ' ORDER BY ' . PMA_backquote($orderField) . ' ' . $order;
    } // end if

    require './sql.php';
}

?>
