<?php
/* $Id$ */


/**
 * Get the values of the variables posted or sent to this script and display
 * the headers
 */
require('./libraries/grab_globals.lib.php3');
require('./libraries/common.lib.php3');
require('./libraries/relation.lib.php3');


/**
 * Gets the relation settings
 */
$cfgRelation = PMA_getRelationsParam();


/**
 * A query has been submitted -> execute it, else display the headers
 */
if (isset($submit_sql) && eregi('^SELECT', $encoded_sql_query)) {
    $goto      = 'db_details.php3';
    $zero_rows = htmlspecialchars($strSuccess);
    $sql_query = urldecode($encoded_sql_query);
    if (get_magic_quotes_gpc()) {
        $sql_query = addslashes($sql_query);
    }
    include('./sql.php3');
    exit();
} else {
    $sub_part  = '_qbe';
    include('./db_details_common.php3');
    $url_query .= '&amp;goto=db_details_qbe.php3';
    include('./db_details_db_info.php3');
}

if (isset($submit_sql) && !eregi('^SELECT', $encoded_sql_query)) {
    echo '<p class="warning">' . $strHaveToShow . '</p>';
}


/**
 * Initialize some variables
 */
if (empty($Columns)) {
    $Columns  = 3;  // Initial number of columns
}
if (!isset($Add_Col)) {
    $Add_Col  = '';
}
if (!isset($Add_Row)) {
    $Add_Row  = '';
}
if (!isset($Rows)) {
    $Rows     = '';
}
if (!isset($InsCol)) {
    $InsCol   = '';
}
if (!isset($DelCol)) {
    $DelCol   = '';
}
if (!isset($prev_Criteria)) {
    $prev_Criteria = '';
}
// workaround for a PHP3 problem
if (!isset($Criteria)) {
    //$Criteria = '';
    $Criteria = array();
    for ($i = 0; $i < $Columns; $i++) {
        $Criteria[$i] = '';
    }
}
if (!isset($InsRow)) {
//    $InsRow   = '';
    $InsRow = array();
    for ($i = 0; $i < $Columns; $i++) {
        $InsRow[$i] = '';
    }
}
if (!isset($DelRow)) {
//    $DelRow   = '';
    $DelRow = array();
    for ($i = 0; $i < $Columns; $i++) {
        $DelRow[$i] = '';
    }
}
if (!isset($AndOrRow)) {
//    $AndOrRow = '';
    $AndOrRow = array();
    for ($i = 0; $i < $Columns; $i++) {
        $AndOrRow[$i] = '';
    }
}
if (!isset($AndOrCol)) {
//    $AndOrCol = '';
    $AndOrCol = array();
    for ($i = 0; $i < $Columns; $i++) {
        $AndOrCol[$i] = '';
    }
}
// minimum width
$wid          = 12;
$col          = $Columns + $Add_Col;
if ($col < 0) {
    $col      = 0;
}
$row          = $Rows + $Add_Row;
if ($row < 0) {
    $row      = 0;
}


/**
 * Prepares the form
 */
$tbl_result     = PMA_mysql_list_tables($db);
$tbl_result_cnt = mysql_num_rows($tbl_result);
$i              = 0;
$k              = 0;

// The tables list sent by a previously submitted form
if (!empty($TableList)) {
    for ($x = 0; $x < count($TableList); $x++) {
        $tbl_names[urldecode($TableList[$x])] = ' selected="selected"';
    }
} // end if

// The tables list gets from MySQL
while ($i < $tbl_result_cnt) {
    $tbl             = PMA_mysql_tablename($tbl_result, $i);
    $fld_results     = @PMA_mysql_list_fields($db, $tbl) or PMA_mysqlDie(PMA_mysql_error(), 'PMA_mysql_list_fields(' . $db . ', ' . $tbl . ')', FALSE, $err_url);
    $fld_results_cnt = ($fld_results) ? mysql_num_fields($fld_results) : 0;
    $j               = 0;

    if (empty($tbl_names[$tbl]) && !empty($TableList)) {
        $tbl_names[$tbl] = '';
    } else {
        $tbl_names[$tbl] = ' selected="selected"';
    } //  end if

    // The fields list per selected tables
    if ($tbl_names[$tbl] == ' selected="selected"') {
        $fld[$k++]   =  PMA_backquote($tbl) . '.*';
        while ($j < $fld_results_cnt) {
            $fld[$k] = PMA_mysql_field_name($fld_results, $j);
            $fld[$k] = PMA_backquote($tbl) . '.' . PMA_backquote($fld[$k]);

            // increase the width if necessary
            if (strlen($fld[$k]) > $wid) {
                $wid = strlen($fld[$k]);
            } //end if

            $k++;
            $j++;
        } // end while
    } // end if
    if ($fld_results) {
        mysql_free_result($fld_results);
    }

    $i++;
} // end if
mysql_free_result($tbl_result);

// largest width found
$realwidth = $wid . 'ex';


/**
 * Displays the form
 */
?>

<!-- Query by example form -->
<form action="db_details_qbe.php3" method="post">
    <table border="<?php echo $cfg['Border']; ?>">

    <!-- Fields row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strField; ?>&nbsp;:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && $InsCol[$x] == 'on') {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Field[<?php echo $z; ?>]" size="1">
                <option value=""></option>
        <?php
        echo "\n";
        for ($y = 0; $y < sizeof($fld); $y++) {
            if ($fld[$y] == '') {
                $sel = ' selected="selected"';
            } else {
                $sel = '';
            }
            echo '                ';
            echo '<option value="' . urlencode($fld[$y]) . '"' . $sel . '>' . htmlspecialchars($fld[$y]) . '</option>' . "\n";
        } // end for
        ?>
            </select>
        </td>
        <?php
        $z++;
    } // end if
    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && $DelCol[$x] == 'on') {
        continue;
    }
    ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Field[<?php echo $z; ?>]" size="1">
                <option value=""></option>
    <?php
    echo "\n";
    for ($y = 0; $y < sizeof($fld); $y++) {
        if (isset($Field[$x]) && $fld[$y] == urldecode($Field[$x])) {
            $curField[$z] = urldecode($Field[$x]);
            $sel          = ' selected="selected"';
        } else {
            $sel          = '';
        } // end if
        echo '                ';
        echo '<option value="' . urlencode($fld[$y]) . '"' . $sel . '>' . htmlspecialchars($fld[$y]) . '</option>' . "\n";
    } // end for
    ?>
            </select>
        </td>
    <?php
    $z++;
    echo "\n";
} // end for
?>
    </tr>

    <!-- Sort row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strSort; ?>&nbsp;:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && $InsCol[$x] == 'on') {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Sort[<?php echo $z; ?>]" size="1">
                <option value=""></option>
                <option value="ASC"><?php echo $strAscending; ?></option>
                <option value="DESC"><?php echo $strDescending; ?></option>
            </select>
        </td>
        <?php
        $z++;
    } // end if
    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && $DelCol[$x] == 'on') {
        continue;
    }
    ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Sort[<?php echo $z; ?>]" size="1">
                <option value=""></option>
    <?php
    echo "\n";

    // If they have chosen all fields using the * selector,
    // then sorting is not available
    // Robbat2 - Fix for Bug #570698
    if (isset($Sort[$x]) && isset($Field[$x]) && (substr(urldecode($Field[$x]),-2) == '.*')) {
        $Sort[$x] = '';
    } //end if

    if (isset($Sort[$x]) && $Sort[$x] == 'ASC') {
        $curSort[$z] = $Sort[$x];
        $sel         = ' selected="selected"';
    } else {
        $sel         = '';
    } // end if
    echo '                ';
    echo '<option value="ASC"' . $sel . '>' . $strAscending . '</option>' . "\n";
    if (isset($Sort[$x]) && $Sort[$x] == 'DESC') {
        $curSort[$z] = $Sort[$x];
        $sel         = ' selected="selected"';
    } else {
        $sel         = '';
    } // end if
    echo '                ';
    echo '<option value="DESC"' . $sel . '>' . $strDescending . '</option>' . "\n";
    ?>
            </select>
        </td>
    <?php
    $z++;
    echo "\n";
} // end for
?>
    </tr>

    <!-- Show row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strShow; ?>&nbsp;:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && $InsCol[$x] == 'on') {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <input type="checkbox" name="Show[<?php echo $z; ?>]" />
        </td>
        <?php
        $z++;
    } // end if
    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && $DelCol[$x] == 'on') {
        continue;
    }
    if (isset($Show[$x])) {
        $checked     = ' checked="checked"';
        $curShow[$z] = $Show[$x];
    } else {
        $checked     =  '';
    }
    ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <input type="checkbox" name="Show[<?php echo $z; ?>]"<?php echo $checked; ?> />
        </td>
    <?php
    $z++;
    echo "\n";
} // end for
?>
    </tr>

    <!-- Criteria row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strCriteria; ?>&nbsp;:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && $InsCol[$x] == 'on') {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <input type="text" name="Criteria[<?php echo $z; ?>]" value="" class="textfield" style="width: <?php echo $realwidth; ?>" size="20" />
        </td>
        <?php
        $z++;
    } // end if
    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && $DelCol[$x] == 'on') {
        continue;
    }
    if (isset($Criteria[$x])) {
        if (get_magic_quotes_gpc()) {
            $stripped_Criteria = stripslashes($Criteria[$x]);
        } else {
            $stripped_Criteria = $Criteria[$x];
        }
    }
    if ((empty($prev_Criteria) || !isset($prev_Criteria[$x]))
        || urldecode($prev_Criteria[$x]) != htmlspecialchars($stripped_Criteria)) {
        $curCriteria[$z]   = $stripped_Criteria;
        $encoded_Criteria  = urlencode($stripped_Criteria);
    } else {
        $curCriteria[$z]   = urldecode($prev_Criteria[$x]);
        $encoded_Criteria  = $prev_Criteria[$x];
    }
    ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <input type="hidden" name="prev_Criteria[<?php echo $z; ?>]" value="<?php echo $encoded_Criteria; ?>" />
            <input type="text" name="Criteria[<?php echo $z; ?>]" value="<?php echo htmlspecialchars($stripped_Criteria); ?>" class="textfield" style="width: <?php echo $realwidth; ?>" size="20" />
        </td>
    <?php
    $z++;
    echo "\n";
} // end for
?>
    </tr>

    <!-- And/Or columns and rows -->
<?php
$w = 0;
for ($y = 0; $y <= $row; $y++) {
    $bgcolor = ($y % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];
    if (isset($InsRow[$y]) && $InsRow[$y] == 'on') {
        $chk['or']  = ' checked="checked"';
        $chk['and'] = '';
        ?>
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
            <!-- Row controls -->
            <table bgcolor="<?php echo $bgcolor; ?>">
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEIns; ?>&nbsp;:</small>
                    <input type="checkbox" name="InsRow[<?php echo $w; ?>]" />
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strAnd; ?>&nbsp;:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="and"<?php echo $chk['and']; ?> />
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEDel; ?>&nbsp;:</small>
                    <input type="checkbox" name="DelRow[<?php echo $w; ?>]" />
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strOr; ?>&nbsp;:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="or"<?php echo $chk['or']; ?> />
                    &nbsp;
                </td>
            </tr>
            </table>
        </td>
        <?php
        $z = 0;
        for ($x = 0; $x < $col; $x++) {
            if ($InsCol[$x] == 'on') {
                echo "\n";
                $or = 'Or' . $w . '[' . $z . ']';
                ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="<?php echo $or; ?>" dir="<?php echo $text_dir; ?>"></textarea>
        </td>
                <?php
                $z++;
            } // end if
            if ($DelCol[$x] == 'on') {
                continue;
            }

            echo "\n";
            $or = 'Or' . $w . '[' . $z . ']';
            ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="<?php echo $or; ?>" dir="<?php echo $text_dir; ?>"></textarea>
        </td>
            <?php
            $z++;
        } // end for
        $w++;
        echo "\n";
        ?>
    </tr>
        <?php
    } // end if

    if (isset($DelRow[$y]) && $DelRow[$y] == 'on') {
        continue;
    }

    if (isset($AndOrRow[$y])) {
        $curAndOrRow[$w] = $AndOrRow[$y];
    }
    if (isset($AndOrRow[$y]) && $AndOrRow[$y] == 'and') {
        $chk['and'] =  ' checked="checked"';
        $chk['or']  =  '';
    } else {
        $chk['or']  =  ' checked="checked"';
        $chk['and'] =  '';
    }
    echo "\n";
    ?>
    <tr>
        <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
            <!-- Row controls -->
            <table bgcolor="<?php echo $bgcolor; ?>">
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEIns; ?>&nbsp;:</small>
                    <input type="checkbox" name="InsRow[<?php echo $w; ?>]" />
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strAnd; ?>&nbsp;:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="and"<?php echo $chk['and']; ?> />
                </td>
            </tr>
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEDel; ?>&nbsp;:</small>
                    <input type="checkbox" name="DelRow[<?php echo $w; ?>]" />
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strOr; ?>&nbsp;:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="or"<?php echo $chk['or']; ?> />
                </td>
            </tr>
            </table>
        </td>
    <?php
    $z = 0;
    for ($x = 0; $x < $col; $x++) {
        if (!empty($InsCol) && isset($InsCol[$x]) && $InsCol[$x] == 'on') {
            echo "\n";
            $or = 'Or' . $w . '[' . $z . ']';
            ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="<?php echo $or; ?>" dir="<?php echo $text_dir; ?>"></textarea>
        </td>
            <?php
            $z++;
        } // end if
        if (!empty($DelCol) && isset($DelCol[$x]) && $DelCol[$x] == 'on') {
            continue;
        }

        echo "\n";
        $or = 'Or' . $y;
        if (!isset(${$or})) {
            ${$or} = '';
        }
        if (!empty(${$or}) && isset(${$or}[$x])) {
            if (get_magic_quotes_gpc()) {
                $stripped_or = stripslashes(${$or}[$x]);
            } else {
                $stripped_or = ${$or}[$x];
            }
        } else {
            $stripped_or     = '';
        }
        ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="Or<?php echo $w . '[' . $z . ']'; ?>" dir="<?php echo $text_dir; ?>"><?php echo htmlspecialchars($stripped_or); ?></textarea>
        </td>
        <?php
        if (!empty(${$or}) && isset(${$or}[$x])) {
            ${'cur' . $or}[$z] = ${$or}[$x];
        }
        $z++;
    } // end for
    $w++;
    echo "\n";
    ?>
    </tr>
    <?php
    echo "\n";
} // end for
?>

    <!-- Modify columns -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strModify; ?>&nbsp;:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && $InsCol[$x] == 'on') {
        $curAndOrCol[$z] = $AndOrCol[$y];
        if ($AndOrCol[$z] == 'or') {
            $chk['or']  = ' checked="checked"';
            $chk['and'] = '';
        } else {
            $chk['and'] = ' checked="checked"';
            $chk['or']  = '';
        }
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <b><?php echo $strOr; ?>&nbsp;:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="or"<?php echo $chk['or']; ?> />
            &nbsp;&nbsp;<b><?php echo $strAnd; ?>&nbsp;:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="and"<?php echo $chk['and']; ?> />
            <br />
            <?php echo $strQBEIns . "\n"; ?>
            <input type="checkbox" name="InsCol[<?php echo $z; ?>]" />
            &nbsp;&nbsp;<?php echo $strQBEDel . "\n"; ?>
            <input type="checkbox" name="DelCol[<?php echo $z; ?>]" />
        </td>
        <?php
        $z++;
    } // end if
    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && $DelCol[$x] == 'on') {
        continue;
    }

    if (isset($AndOrCol[$y])) {
        $curAndOrCol[$z] = $AndOrCol[$y];
    }
    if (isset($AndOrCol[$z]) && $AndOrCol[$z] == 'or') {
        $chk['or']  = ' checked="checked"';
        $chk['and'] = '';
    } else {
        $chk['and'] = ' checked="checked"';
        $chk['or']  = '';
    }
    ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <b><?php echo $strOr; ?>&nbsp;:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="or"<?php echo $chk['or']; ?> />
            &nbsp;&nbsp;<b><?php echo $strAnd; ?>&nbsp;:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="and"<?php echo $chk['and']; ?> />
            <br />
            <?php echo $strQBEIns . "\n"; ?>
            <input type="checkbox" name="InsCol[<?php echo $z; ?>]" />
            &nbsp;&nbsp;<?php echo $strQBEDel . "\n"; ?>
            <input type="checkbox" name="DelCol[<?php echo $z; ?>]" />
        </td>
    <?php
    $z++;
    echo "\n";
} // end for
?>
    </tr>
    </table>


    <!-- Other controls -->
    <table border="0">
    <tr>
        <td valign="top">
            <table border="0" align="<?php echo $cell_align_left; ?>">
            <tr>
                <td rowspan="4" valign="top">
                    <?php echo $strUseTables; ?>&nbsp;:
                    <br />
                    <select name="TableList[]" size="7" multiple="multiple">
<?php
while (list($key, $val) = each($tbl_names)) {
    echo '                        ';
    echo '<option value="' . urlencode($key) . '"' . $val . '>' . htmlspecialchars($key) . '</option>' . "\n";
}
?>
                    </select>
                </td>
                <td align="<?php echo $cell_align_right; ?>" valign="bottom">
                    <input type="hidden" value="<?php echo $db; ?>" name="db" />
                    <input type="hidden" value="<?php echo $z; ?>" name="Columns" />
<?php
$w--;
?>
                    <input type="hidden" value="<?php echo $w; ?>" name="Rows" />
                    <?php echo $strAddDeleteRow; ?>&nbsp;:
                    <select size="1" name="Add_Row">
                        <option value="-3">-3</option>
                        <option value="-2">-2</option>
                        <option value="-1">-1</option>
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="<?php echo $cell_align_right; ?>" valign="bottom">
                    <?php echo $strAddDeleteColumn; ?>&nbsp;:
                    <select size="1" name="Add_Col">
                        <option value="-3">-3</option>
                        <option value="-2">-2</option>
                        <option value="-1">-1</option>
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
            </tr>
            <!-- Generates a query -->
            <tr align="center" valign="top">
                <td>
                    <input type="submit" name="modify" value="<?php echo $strUpdateQuery; ?>" />
                    <input type="hidden" name="server" value="<?php echo $server; ?>" />
                    <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
                    <input type="hidden" name="convcharset" value="<?php echo $convcharset; ?>" />
                </td>
            </tr>
            <!-- Executes a query -->
            <tr align="center" valign="top">
                <td>
                    <input type="submit" name="submit_sql" value="<?php echo $strRunQuery; ?>" />
                </td>
            </tr>
            </table>
        </td>
        <td>
            <!-- Displays the current query -->
            <?php echo sprintf($strQueryOnDb, htmlspecialchars($db)); ?><br />
<textarea cols="30" rows="7" name="sql_query" dir="<?php echo $text_dir; ?>">
<?php
// 1. SELECT
$last_select = 0;
$encoded_qry = '';
if (!isset($qry_select)) {
    $qry_select         = '';
}
for ($x = 0; $x < $col; $x++) {
    if (!empty($curField[$x]) && isset($curShow[$x]) && $curShow[$x] == 'on') {
        if ($last_select) {
            $qry_select .=  ', ';
        }
        $qry_select     .= $curField[$x];
        $last_select    = 1;
    }
} // end for
if (!empty($qry_select)) {
    $encoded_qry .= urlencode('SELECT ' . $qry_select . "\n");
    echo  'SELECT ' . htmlspecialchars($qry_select) . "\n";
}

// 2. FROM

// Create LEFT JOINS out of Relations
// Code originally by Mike Beck <mike.beck@ibmiller.de>
//    If we can use Relations we could make some left joins
//    First find out if relations are available in this database

// First we need the really needed Tables - those in TableList might
// still be all Tables.
if (isset($Field) && count($Field) > 0) {

    // Initialize some variables
    $alltabs   = array();
    $where     = array();
    $wheretabs = array();
    $reltabs   = array();
    $rel       = array();
    $rest      = array();
    $found     = array();

    //  we only start this if we have fields, otherwise it would be dumb
    while (list(, $value) = each($Field)) {
        $parts            = explode('.', $value);
        if (urldecode($parts[0]) != '') {
            $alltabs[]    = substr(urldecode($parts[0]), 1, strlen(urldecode($parts[0])) - 2);
        }
    } // end while

    if ($cfgRelation['relwork'] && count($alltabs) > 0) {

        // now we need all tables that we have in the whereclause
        for ($x = 0; $x < count($Criteria); $x++) {
            $wtable = explode('.', urldecode($Field[$x]));
            $ctable = str_replace('`', '', $wtable[0]);
            if (!empty($Field[$x]) && !empty($Criteria[$x])) {
                if (empty($where[$ctable]) || $where[$ctable] != '=') {
                    $where[$ctable] = substr($Criteria[$x], 0, 1);
                }
            }
        } // end for

        if (count($where) > 1) {
            //  if we have enough whereclauses then we want those that have
            //  a '=' (not for example 'like')
            while (list($key, $value) = each($where)) {
                if ($value == '=') {
                    $wheretabs[$key] = '=';
                }
            }
        } // end if


        // if there was nothing starting with '=' we have to use all we got in
        // the first place (we can't use an "&=" assignment because of PHP3
        // compliance)
        if (count($wheretabs) == 0) {
             $wheretabs = $where;
        }

        // When we want the fastest SELECT Statement, it would be great
        // to have one Table as $master (that is the one that will be in
        // FROM ... contrary to the rest which will just show in the LEFT JOIN
        // lines) that has a good whereclause and is FOREIGN table to as many
        // tables as possible

        // We will need this a few times:
        $incrit    = '(\'' . implode('\', \'', $alltabs) . '\')';


        $rel_query     = 'SELECT foreign_table AS wer, COUNT(master_table) AS hits'
                       . ' FROM ' . PMA_backquote($cfgRelation['relation'])
                       . ' WHERE master_db   = \'' . PMA_sqlAddslashes($db) . '\''
                       . ' AND foreign_db    = \'' . PMA_sqlAddslashes($db) . '\''
                       . ' AND master_table  IN ' . $incrit
                       . ' AND foreign_table IN ' . $incrit;
        if (!empty($column)) {
            $rel_query .= ' AND foreign_field = \'' . PMA_sqlAddslashes($column) . '\'';
        }
        $rel_query     .= ' GROUP BY foreign_table ORDER BY hits DESC';
        $relations =  PMA_query_as_cu($rel_query);

        $bpm = FALSE;
        while ($row = PMA_mysql_fetch_array($relations)) {
            // in case we will not find any foreign table that is also in the
            // where clause AND we do not find a master table later, then we
            // just use the most popular foreign table (allthough chances are
            // remote)
            if (!isset($master)) {
                $master = $row['wer'];
            }
            if ($bpm == FALSE) {
                while (list($key, $value) = each($wheretabs)) {
                    if ($row['wer'] == $key) {
                        $master = $row['wer'];
                        $bpm    = TRUE; // best possible master found ;-)
                        break;
                    }
                } // end while
                reset($wheretabs);
            }
        } // end while

        // if we didn't find any best possible master at this point, then we
        // will settle for the most popular master_table in the where clause
        // (sbpm = second best possible master ;-) or if that fails as well,
        // then rather the most popular master table than the most popular
        // foreign_table
        if ($bpm == FALSE) {
            $sbpm = FALSE;
            // Easier to just save any bad master we had and use it if we do
            // not find anything better
            if (isset($master)) {
                $badmaster = $master;
                unset($master);
            }
            $rel_query     = 'SELECT master_table AS wer, COUNT(foreign_table) AS hits'
                           . ' FROM ' . PMA_backquote($cfgRelation['relation'])
                           . ' WHERE master_db   = \'' . PMA_sqlAddslashes($db) . '\''
                           . ' AND foreign_db    = \'' . PMA_sqlAddslashes($db) . '\''
                           . ' AND master_table  IN ' . $incrit
                           . ' AND foreign_table IN ' . $incrit;
            if (!empty($column)) {
                $rel_query .= ' AND master_field = \'' . PMA_sqlAddslashes($column) . '\'';
            }
            $rel_query     .= ' GROUP BY master_table ORDER BY hits DESC';

            $relations = PMA_query_as_cu($rel_query);
            while ($row = PMA_mysql_fetch_array($relations)) {
                // we want the first one (highest number of hits) or the first one
                // that is in the WHERE clause
                if (!isset($master)) {
                    $master         = $row['wer'];
                }
                if ($sbpm == FALSE) {
                    while (list($key, $value) = each($wheretabs)) {
                        if ($row['wer'] == $key) {
                            $master = $row['wer'];
                            $sbpm   = TRUE;
                            break;
                        }
                    } // end while
                    reset($wheretabs);
                }
            } // end while
            if (!isset($master) && isset($badmaster)) {
                $master             = $badmaster;
                unset($badmaster);
            }
        }   // end if bpm == FALSE

        //  if we still don't have a master at this point we might as well
        //  give up ;-)

        if (isset($master) && $master != '') {
            $qry_from = PMA_backquote($master);

            // now we want one Array that has all tablenames but master
            while (list(, $value) = each($alltabs)) {
                if ($value != $master) {
                    $reltabs[]           = $value;
                    $rel[$value]['mcon'] = 0;
                }
            } // end while

            // everything but the first table
            $incrit_s          = '(\'' . implode('\', \'', $reltabs) . '\')';
            $rel_query         = 'SELECT *'
                               . ' FROM ' . PMA_backquote($cfgRelation['relation'])
                               . ' WHERE master_db = \'' . PMA_sqlAddslashes($db) . '\''
                               . ' AND foreign_db  = \'' . PMA_sqlAddslashes($db) . '\'';
            if ($bpm == TRUE) { // means that my $master is a foreign table
                $rel_query     .= ' AND master_table  IN ' . $incrit_s
                               .  ' AND foreign_table IN ' . $incrit;
                if (!empty($column)) {
                    $rel_query .= ' AND foreign_field = \'' . PMA_sqlAddslashes($column) . '\'';
                }
            } else {
                $rel_query     .= ' AND foreign_table IN ' . $incrit_s
                               .  ' AND master_table  IN ' . $incrit;
                if (!empty($column)) {
                    $rel_query .= ' AND master_field = \'' . $column . '\'';
                }
            }

            if (isset($dbh)) {
                PMA_mysql_select_db($cfgRelation['db'], $dbh);
                $relations = @PMA_mysql_query($rel_query, $dbh) or PMA_mysqlDie(PMA_mysql_error($dbh), $rel_query, '', $err_url_0);
                PMA_mysql_select_db($db, $dbh);
            } else {
                PMA_mysql_select_db($cfgRelation['db']);
                $relations = @PMA_mysql_query($rel_query) or PMA_mysqlDie('', $rel_query, '', $err_url_0);
                PMA_mysql_select_db($db);
            }

            if ($bpm == TRUE) { // means that my $master is a foreign table
                while ($row = PMA_mysql_fetch_array($relations)) {
                    $master_table = $row['master_table'];
                    if ($rel[$master_table]['mcon'] == 0) {
                        // if we already found a link to the master table we don't
                        // want another otherwise we take whatever we get
                        $rel[$master_table]['link']  = ' LEFT JOIN ' . PMA_backquote($master_table)
                                                      . ' ON ' . PMA_backquote($row['foreign_table']) . '.' . PMA_backquote($row['foreign_field'])
                                                      . ' = ' . PMA_backquote($row['master_table']) . '.' . PMA_backquote($row['master_field']);
                        if ($row['foreign_table'] == $master) {
                            $rel[$master_table]['mcon']  = 1;
                        }
                    }
                } // end while
            } else {
                while ($row = PMA_mysql_fetch_array($relations)) {
                    $foreign_table = $row['foreign_table'];
                    if ($rel[$foreign_table]['mcon'] == 0) {
                        // if we already found a link to the master table we don't
                        // want another otherwise we take whatever we get
                        $rel[$foreign_table]['link']  = ' LEFT JOIN ' . PMA_backquote($foreign_table)
                                                      . ' ON ' . PMA_backquote($row['foreign_table']) . '.' . PMA_backquote($row['foreign_field'])
                                                      . ' = ' . PMA_backquote($row['master_table']) . '.' . PMA_backquote($row['master_field']);
                        if ($row['master_table'] == $master) {
                            $rel[$foreign_table]['mcon']  = 1;
                        }
                    }
                } // end while
            }
            // possibly we still don't have all - there might be some that are
            // only found in relation to one of those that we already have
            if ($master != '') {
                $found[]  = $master;
                $qry_from = PMA_backquote($master);
            } // end if

            while (list($key, $varr) = each($rel)) {
                if (!isset($varr['link']) || $varr['link'] == '') {
                    $rest[]  = $key;
                } else {
                    $found[] = $key;
                }
            } // end while
            if (count($rest) > 0) {
                $incrit_d       = '(\'' . implode('\', \'', $found) . '\')';
                $incrit_s       = '(\'' . implode('\', \'', $rest) . '\')';
                if ($bpm == TRUE) {
                    $from_table = 'foreign_table';
                    $from_field = 'foreign_field';
                    $to_table   = 'master_table';
                } else {
                    $from_table = 'master_table';
                    $from_field = 'master_field';
                    $to_table   = 'foreign_table';
                }
                $rel_query      = 'SELECT *'
                                . ' FROM ' . PMA_backquote($cfgRelation['relation'])
                                . ' WHERE master_db   = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND foreign_db    = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND ' . $from_table . '  IN ' . $incrit_s
                                . ' AND ' . $to_table . ' IN ' . $incrit_d;
                if (!empty($column)) {
                    $rel_query  .= ' AND ' . $from_field . ' = \'' . PMA_sqlAddslashes($column) . '\'';
                }

                if (isset($dbh)) {
                    PMA_mysql_select_db($cfgRelation['db'], $dbh);
                    $relations = @PMA_mysql_query($rel_query, $dbh) or PMA_mysqlDie(PMA_mysql_error($dbh), $rel_query, '', $err_url_0);
                    PMA_mysql_select_db($db, $dbh);
                } else {
                    PMA_mysql_select_db($cfgRelation['db']);
                    $relations = @PMA_mysql_query($rel_query) or PMA_mysqlDie('', $rel_query, '', $err_url_0);
                    PMA_mysql_select_db($db);
                }

                while ($row = PMA_mysql_fetch_array($relations)) {
                    if ($bpm == TRUE) {
                        $found_table = $row['foreign_table'];
                        $other_table = $row['master_table'];
                    } else {
                        $found_table = $row['master_table'];
                        $other_table = $row['foreign_table'];
                    }
                    if ($rel[$found_table]['mcon'] == 0) {
                        // if we allready found a link to the mastertable we
                        // don't want another otherwise we take whatever we get
                        $rel[$found_table]['link'] = ' LEFT JOIN ' . $found_table
                                                   . ' ON ' . PMA_backquote($row['master_table']) . '.' . PMA_backquote($row['master_field'])
                                                   . ' = ' . PMA_backquote($row['foreign_table']) . '.' . PMA_backquote($row['foreign_field']);

                        // in extreme cases we hadn't found a master yet, so
                        // let's use the one we found now
                        if ($master == '') {
                            $master                    = $found_table;
                        }
                        if ($other_table == $master) {
                            $rel[$found_table]['mcon'] = 1;
                        }
                    }
                } // end while
            } // end if

            // now let's see what we found - every table that doesn't have a
            // link gets added directly to the FROM the links go to a second
            // variable $lj which is added afterwards
            $lj  = '';
            $ljm = '';
            reset($rel);
            while (list($key, $varr) = each($rel)) {
                if ($varr['link'] == '') {
                    if ($qry_from != '') {
                        $qry_from .= ', ';
                    }
                    $qry_from     .= PMA_backquote($key);
                    // debug echo "add ". $key . ": " . PMA_backquote($key) . "\n";
                } else if ($varr['mcon'] == 0) {
                    // those that have no link with the mastertable we will
                    // show at the end
                    $lj           .= $varr['link'];
                } else {
                    $ljm          .= $varr['link'];
                }
            } // end while

            // on one occasion i had qry_from at this point end with a , as I
            // can't find why this happened i check this now:
            $qry_from = ereg_replace(', $', '', $qry_from);
            $qry_from .= $ljm . $lj;
        } // end if ($master != '')
    } // end rel work and $alltabs > 0

    if (empty($qry_from) && count($alltabs)) {
        // there might be more than one mentioning of the table in here
        // as array_unique is only PHP4 we have to do this by hand
        $temp = array();
        while (list($k, $v) = each($alltabs)) {
            $temp[$v] = 1;
        }
        unset($alltabs);
        $alltabs = array();
        while (list($k, $v) = each($temp)) {
            $alltabs[] = $k;
        }
        $qry_from = implode(', ', PMA_backquote($alltabs));
    }

} // end count($Field) > 0

if (!empty($qry_from)) {
    $encoded_qry .= urlencode('FROM ' . $qry_from . "\n");
    echo  'FROM ' . htmlspecialchars($qry_from) . "\n";
}

// 3. WHERE
$qry_where          = '';
$criteria_cnt       = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($curField[$x]) && !empty($curCriteria[$x]) && $x && isset($last_where)) {
        $qry_where  .= ' ' . strtoupper($curAndOrCol[$last_where]) . ' ';
    }
    if (!empty($curField[$x]) && !empty($curCriteria[$x])) {
        $qry_where  .= '(' . $curField[$x] . ' ' . $curCriteria[$x] . ')';
        $last_where = $x;
        $criteria_cnt++;
    }
} // end for
if ($criteria_cnt > 1) {
    $qry_where      = '(' . $qry_where . ')';
}

// OR rows ${"cur".$or}[$x]
if (!isset($curAndOrRow)) {
    $curAndOrRow          = array();
}
for ($y = 0; $y <= $row; $y++) {
    $criteria_cnt         = 0;
    $qry_orwhere          = '';
    $last_orwhere         = '';
    for ($x = 0; $x < $col; $x++) {
        if (!empty($curField[$x]) && !empty(${'curOr' . $y}[$x]) && $x) {
            $qry_orwhere  .= ' ' . strtoupper($curAndOrCol[$last_orwhere]) . ' ';
        }
        if (!empty($curField[$x]) && !empty(${'curOr' . $y}[$x])) {
            $qry_orwhere  .= '(' . $curField[$x]
                          .  ' '
                          .  (get_magic_quotes_gpc() ? stripslashes(${'curOr' . $y}[$x]) : ${'curOr' . $y}[$x])
                          .  ')';
            $last_orwhere = $x;
            $criteria_cnt++;
        }
    } // end for
    if ($criteria_cnt > 1) {
        $qry_orwhere      = '(' . $qry_orwhere . ')';
    }
    if (!empty($qry_orwhere)) {
        $qry_where .= "\n"
                   .  strtoupper(isset($curAndOrRow[$y]) ? $curAndOrRow[$y] . ' ' : '')
                   .  $qry_orwhere;
    } // end if
} // end for

if (!empty($qry_where) && $qry_where != '()') {
    $encoded_qry .= urlencode('WHERE ' . $qry_where . "\n");
    echo 'WHERE ' . htmlspecialchars($qry_where) . "\n";
} // end if

// 4. ORDER BY
$last_orderby = 0;
if (!isset($qry_orderby)) {
    $qry_orderby      = '';
}
for ($x = 0; $x < $col; $x++) {
    if ($last_orderby && $x && !empty($curField[$x]) && !empty($curSort[$x])) {
        $qry_orderby  .=  ', ';
    }
    if (!empty($curField[$x]) && !empty($curSort[$x])) {
        // if they have chosen all fields using the * selector,
        // then sorting is not available
        // Robbat2 - Fix for Bug #570698
        if (substr($curField[$x], -2) != '.*') {
            $qry_orderby  .=  $curField[$x] . ' ' . $curSort[$x];
            $last_orderby = 1;
        }
    }
} // end for
if (!empty($qry_orderby)) {
    $encoded_qry .= urlencode('ORDER BY ' . $qry_orderby);
    echo 'ORDER BY ' . htmlspecialchars($qry_orderby) . "\n";
}
?>
</textarea>
            <input type="hidden" name="encoded_sql_query" value="<?php echo $encoded_qry; ?>" />
        </td>
    </tr>
    </table>

</form>


<?php
/**
 * Displays the footer
 */
require('./footer.inc.php3');
?>