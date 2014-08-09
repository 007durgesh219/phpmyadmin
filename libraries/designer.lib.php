<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Set of functions related to designer
 *
 * @package PhpMyAdmin
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

require_once 'libraries/relation.lib.php';

/**
 * Function to get html for displaying the page edit/delete form
 *
 * @param string $db        databasae name
 * @param string $operation 'edit' or 'delete' depending on the operation
 *
 * @return string html content
 */
function PMA_getHtmlForEditOrDeletePages($db, $operation)
{
    $cfgRelation = PMA_getRelationsParam();
    $html  = '<form action="pmd_general.php" method="post"'
        . ' name="edit_delete_pages" id="edit_delete_pages" class="ajax">';
    $html .= PMA_URL_getHiddenInputs($db);
    $html .= '<fieldset id="page_edit_delete_options">';
    $html .= '<input type="hidden" name="operation" value="' . $operation . '" />';
    $html .= '<label for="selected_page">';
    if ($operation == 'edit') {
        $html .= __("Page to open");
    } else {
        $html .= __("Page to delete");
    }
    $html .= ': </label>';
    $html .= '<select name="selected_page" id="selected_page">';
    $html .= '<option value="0">-- ' . __('Select page').' --</option>';
    if ($cfgRelation['pdfwork']) {
        $pages = PMA_getPageIdsAndNames($db);
        foreach ($pages as $nr => $desc) {
            $html .= '<option value="' . $nr . '">';
            $html .= htmlspecialchars($desc) . '</option>';
        }
    }
    $html .= '</select>';
    $html .= '</fieldset>';
    $html .= '</form>';
    return $html;
}

/**
 * Function to get html for displaying the page save as form
 *
 * @param string $db databasae name
 *
 * @return string html content
 */
function PMA_getHtmlForPageSaveAs($db)
{
    $cfgRelation = PMA_getRelationsParam();
    $choices = array(
        'same' => __('Save to selected page'),
        'new' => __('Create a page and save to it')
    );

    $html  = '<form action="pmd_general.php" method="post"'
        . ' name="save_as_pages" id="save_as_pages" class="ajax">';
    $html .= PMA_URL_getHiddenInputs($db);
    $html .= '<fieldset id="page_save_as_options">';
    $html .= '<table><tbody>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= '<input type="hidden" name="operation" value="save" />';
    $html .= '<select name="selected_page" id="selected_page">';
    $html .= '<option value="0">-- ' . __('Select page') . ' --</option>';

    if ($cfgRelation['pdfwork']) {
        $pages = PMA_getPageIdsAndNames($db);
        foreach ($pages as $nr => $desc) {
            $html .= '<option value="' . $nr . '">';
            $html .= htmlspecialchars($desc) . '</option>';
        }
    }
    $html .= '</select>';
    $html .= '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= PMA_Util::getRadioFields('save_page', $choices, 'same', true);
    $html .= '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= '<label for="selected_value">' . __('New page name') . '</label>';
    $html .= '<input type="text" name="selected_value" id="selected_value" />';
    $html .= '</td>';
    $html .= '</tr>';

    $html .= '</tbody></table>';
    $html .= '</fieldset>';
    $html .= '</form>';

    return $html;
}

/**
 * Retrieve IDs and names of schema pages
 *
 * @param string $db database name
 *
 * @return array array of schema page id and names
 */
function PMA_getPageIdsAndNames($db)
{
    $cfgRelation = PMA_getRelationsParam();
    $page_query = "SELECT `page_nr`, `page_descr` FROM "
        . PMA_Util::backquote($cfgRelation['db']) . "."
        . PMA_Util::backquote($cfgRelation['pdf_pages'])
        . " WHERE db_name = '" . PMA_Util::sqlAddSlashes($db) . "'"
        . " ORDER BY `page_nr`";
    $page_rs = PMA_queryAsControlUser(
        $page_query, false, PMA_DatabaseInterface::QUERY_STORE
    );

    $result = array();
    while ($curr_page = $GLOBALS['dbi']->fetchAssoc($page_rs)) {
        $result[$curr_page['page_nr']] = $curr_page['page_descr'];
    }
    return $result;
}

/**
 * Function to get html for displaying the schema export
 *
 * @param string $db   database name
 * @param int    $page the page to be exported
 *
 * @return string
 */
function PMA_getHtmlForSchemaExport($db, $page)
{
    /* Scan for schema plugins */
    $export_list = PMA_getPlugins(
        "schema",
        'libraries/plugins/schema/'
    );

    /* Fail if we didn't find any schema plugin */
    if (empty($export_list)) {
        return PMA_Message::error(
            __('Could not load schema plugins, please check your installation!')
        )->getDisplay();
    }


    $htmlString  = '<form method="post" action="schema_export.php"'
        . ' class="disableAjax" id="id_export_pages">';
    $htmlString .= '<fieldset>';
    $htmlString .= PMA_URL_getHiddenInputs($db);
    $htmlString .= '<label>' . __('Select Export Relational Type')
        . '</label><br />';
    $htmlString .= PMA_pluginGetChoice(
        'Schema', 'export_type', $export_list, 'schema_export_format'
    );
    $htmlString .= '<input type="hidden" name="chpage"'
        . ' value="' . htmlspecialchars($page) . '" />';
    $htmlString .= PMA_pluginGetOptions('Schema', $export_list);
    $htmlString .= '</fieldset>';
    $htmlString .= '</form>';

    return $htmlString;
}
?>