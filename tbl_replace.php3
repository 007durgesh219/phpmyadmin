<?php
/* $Id$ */


/**
 * Gets some core libraries
 */
require('./grab_globals.inc.php3');
require('./lib.inc.php3');


/**
 * Initializes some variables
 */
// Defines the url to return in case of success of the query
if (isset($sql_query)) {
    $sql_query = urldecode($sql_query);
}
if ($goto == 'sql.php3') {
    $goto  = 'sql.php3?'
           . 'lang=' . $lang
           . '&server=' . urlencode($server)
           . '&db=' . urlencode($db)
           . '&table=' . urlencode($table)
           . '&pos=' . $pos
           . '&sql_query=' . urlencode($sql_query);
}
// Resets tables defined in the configuration file
reset($fields);
reset($funcs);
// Misc
$is_encoded = FALSE;
if (isset($submit_type)) {
    if (get_magic_quotes_gpc()) {
        $submit_type = stripslashes($submit_type);
    }
    // values have been urlencoded in tbl_change.php3
    if ($submit_type == $strSave || $submit_type == $strInsertAsNewRow) {
        $is_encoded = TRUE;
    }
}


/**
 * Prepare the update of a row
 */
if (isset($primary_key) && ($submit_type != $strInsertAsNewRow)) {
    // Restore the "primary key" to a convenient format
    if (get_magic_quotes_gpc()) {
        $primary_key = stripslashes($primary_key);
    }
    if ($is_encoded) {
        $primary_key = urldecode($primary_key);
    }

    // Defines the SET part of the sql query
    $valuelist = '';
    while (list($key, $val) = each($fields)) {
        if ($is_encoded) {
            $key = urldecode($key);
            $val = urldecode($val);
        }

        switch (strtolower($val)) {
            case 'null':
                break;
            case '$set$':
                // if we have a set, then construct the value
                if ($is_encoded) {
                    $f = 'field_' . md5($key);
                } else {
                    $f = "field_$key";
                }
                if (isset($$f)) {
                    if (get_magic_quotes_gpc()) {
                        $val = "'" . (($$f) ? implode(',', $$f) : '') . "'";
                    } else {
                        $val = "'" . addslashes(($$f) ? implode(',', $$f) : '') . "'";
                    }
                } else {
                    $val = '';
                }
                break;
            default:
                if (get_magic_quotes_gpc()) {
                    $val = "'" . $val . "'";
                } else {
                    $val = "'" . addslashes($val) . "'";
                }
                break;
        } // end switch

        if (empty($funcs[$key])) {
            $valuelist .= backquote($key) . ' = ' . $val . ', ';
        } else {
            $valuelist .= backquote($key) . " = $funcs[$key]($val), ";
        }
    } // end while

    // Builds the sql upate query
    $valuelist = ereg_replace(', $', '', $valuelist);
    $query     = 'UPDATE ' . backquote($table) . " SET $valuelist WHERE $primary_key";
} // end row update


/**
 *  Prepare the insert of a row
 */
else {
    $fieldlist = '';
    $valuelist = '';
    while (list($key, $val) = each($fields)) {
        if ($is_encoded) {
            $key = urldecode($key);
            $val = urldecode($val);
        }
        // the 'query' row is urlencoded in sql.php3
        else if ($key == 'query') {
            $val = urldecode($val);
        }
        $fieldlist .= backquote($key) . ', ';

        switch (strtolower($val)) {
            case 'null':
                break;
            case '$set$':
                // if we have a set, then construct the value
                if ($is_encoded) {
                    $f = 'field_' . md5($key);
                } else {
                    $f = "field_$key";
                }
                if (get_magic_quotes_gpc()) {
                    $val = "'" . (($$f) ? implode(',', $$f) : '') . "'";
                } else {
                    $val = "'" . addslashes(($$f) ? implode(',', $$f) : '') . "'";
                }
                break;
            default:
                if (get_magic_quotes_gpc()) {
                    $val = "'" . $val . "'";
                } else {
                    $val = "'" . addslashes($val) . "'";
                }
                break;
        } // end switch

        if (empty($funcs[$key])) {
            $valuelist .= $val . ', ';
        } else {
            $valuelist .= "$funcs[$key]($val), ";
        }
    } // end while

    // Builds the sql insert query
    $fieldlist = ereg_replace(', $', '', $fieldlist);
    $valuelist = ereg_replace(', $', '', $valuelist);
    $query     = 'INSERT INTO ' . backquote($table) . " ($fieldlist) VALUES ($valuelist)";
} // end row insertion


/**
 * Executes the sql query and get the result, then move back to the calling
 * page
 */
mysql_select_db($db);
$sql_query = $query;
$result    = mysql_query($query);

if (!$result) {
    $error = mysql_error();
    include('./header.inc.php3');
    mysql_die($error);
} else {
    if (file_exists('./' . $goto)) {
        include('./header.inc.php3');
        $message = $strModifications;
        include('./' . ereg_replace('\.\.*', '.', $goto)); //preg_replace('/\.\.*/', '.', $goto));
    } else {
        header('Location: ' . $goto);
    }
    exit();
} // end if
?>
