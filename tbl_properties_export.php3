<?php
/* $Id$ */


/**
 * Gets tables informations and displays top links
 */
require('./tbl_properties_common.php3');
require('./tbl_properties_table_info.php3');
?>
    <!-- Dump of a database -->
        <form method="post" action="tbl_dump.php3" name="tbl_dump">
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="db" value="<?php echo $db; ?>" />
            <input type="hidden" name="table" value="<?php echo $table; ?>" />
            <?php echo $strViewDump; ?><br />
            <table cellpadding="5" border="2">
            <tr>
                <td nowrap="nowrap">
                    <input type="radio" name="what" value="structure" id="radio_dump_structure" checked="checked" />
                    <label for="radio_dump_structure"><?php echo $strStrucOnly; ?></label>&nbsp;&nbsp;<br />
                    <input type="radio" name="what" value="data" id="radio_dump_data" />
                    <label for="radio_dump_data"><?php echo $strStrucData; ?></label>&nbsp;&nbsp;<br />
                    <input type="radio" name="what" value="dataonly" id="radio_dump_dataonly" />
                    <label for="radio_dump_dataonly"><?php echo $strDataOnly; ?></label>&nbsp;&nbsp;<br />
                    <input type="radio" name="what" value="excel" id="radio_dump_excel" />
                    <label for="radio_dump_excel"><?php echo $strStrucExcelCSV; ?></label>&nbsp;&nbsp;<br />
                    <input type="radio" name="what" value="csv" id="radio_dump_csv" />
                    <label for="radio_dump_csv"><?php echo $strStrucCSV;?></label>&nbsp;:<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strFieldsTerminatedBy; ?>&nbsp;
                    <input type="text" name="separator" size="2" value=";" class="textfield" />&nbsp;&nbsp;<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strFieldsEnclosedBy; ?>&nbsp;
                    <input type="text" name="enclosed" size="1" value="&quot;" class="textfield" />&nbsp;&nbsp;<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strFieldsEscapedBy; ?>&nbsp;
                    <input type="text" name="escaped" size="2" value="\" class="textfield" />&nbsp;&nbsp;<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strLinesTerminatedBy; ?>&nbsp;
                    <input type="text" name="add_character" size="2" value="<?php echo ((PMA_whichCrlf() == "\n") ? '\n' : '\r\n'); ?>" class="textfield" />&nbsp;&nbsp;<br/>
                    <input type="radio" name="what" value="xml" id="radio_dump_xml" />
                    <label for="radio_dump_xml"><?php echo $strExportToXML; ?></label>&nbsp;&nbsp;
                </td>
                <td valign="middle">
                    <input type="checkbox" name="drop" value="1" id="checkbox_dump_drop" />
                    <label for="checkbox_dump_drop"><?php echo $strStrucDrop; ?></label><br />
                    <input type="checkbox" name="showcolumns" value="yes" id="checkbox_dump_showcolumns" />
                    <label for="checkbox_dump_showcolumns"><?php echo $strCompleteInserts; ?></label><br />
                    <input type="checkbox" name="extended_ins" value="yes" id="checkbox_dump_extended_ins" />
                    <label for="checkbox_dump_extended_ins"><?php echo $strExtendedInserts; ?></label><br />
<?php
// Add backquotes checkbox
if (PMA_MYSQL_INT_VERSION >= 32306) {
    ?>
                    <input type="checkbox" name="use_backquotes" value="1" id="checkbox_dump_use_backquotes" />
                    <label for="checkbox_dump_use_backquotes"><?php echo $strUseBackquotes; ?></label><br />
    <?php
} // end backquotes feature
echo "\n";
?>
                    <br />
                    <input type="checkbox" name="asfile" value="sendit" id="checkbox_dump_asfile" onclick="return checkTransmitDump(this.form, 'transmit')" />
                    <label for="checkbox_dump_asfile"><?php echo $strSend; ?></label>
<?php
// zip, gzip and bzip2 encode features
if (PMA_PHP_INT_VERSION >= 40004) {
    $is_zip  = (isset($cfg['ZipDump']) && $cfg['ZipDump'] && @function_exists('gzcompress'));
    $is_gzip = (isset($cfg['GZipDump']) && $cfg['GZipDump'] && @function_exists('gzencode'));
    $is_bzip = (isset($cfg['BZipDump']) && $cfg['BZipDump'] && @function_exists('bzcompress'));
    if ($is_zip || $is_gzip || $is_bzip) {
        echo "\n" . '                    (' . "\n";
        if ($is_zip) {
            ?>
                    <input type="checkbox" name="zip" value="zip" id="checkbox_dump_zip" onclick="return checkTransmitDump(this.form, 'zip')" />
                    <?php echo '<label for="checkbox_dump_zip">' . $strZip . '</label>' . (($is_gzip || $is_bzip) ? '&nbsp;' : '') . "\n"; ?>
            <?php
        }
        if ($is_gzip) {
            echo "\n"
            ?>
                    <input type="checkbox" name="gzip" value="gzip" id="checkbox_dump_gzip" onclick="return checkTransmitDump(this.form, 'gzip')" />
                    <?php echo '<label for="checkbox_dump_gzip">' . $strGzip . '</label>' . (($is_bzip) ? '&nbsp;' : '') . "\n"; ?>
            <?php
        }
        if ($is_bzip) {
            echo "\n"
            ?>
                    <input type="checkbox" name="bzip" value="bzip" id="checkbox_dump_bzip" onclick="return checkTransmitDump(this.form, 'bzip')" />
                    <?php echo '<label for="checkbox_dump_bzip">' . $strBzip . '</label>' . "\n"; ?>
            <?php
        }
        echo "\n" . '                    )';
    }
}
echo "\n";

// Encoding setting form appended by Y.Kawada
if (function_exists('PMA_set_enc_form')) {
    echo '<br />' . "\n"
         . PMA_set_enc_form('                    ');
}
?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    &nbsp;<?php echo sprintf($strDumpXRows , '<input type="text" name="limit_to" size="5" value="' . PMA_countRecords($db, $table, TRUE) . '" class="textfield" style="vertical-align: middle" onfocus="this.select()" />' , '<input type="text" name="limit_from" value="0" size="5" class="textfield" style="vertical-align: middle" onfocus="this.select()" />'); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="<?php echo $strGo; ?>" />
                </td>
            </tr>
            </table>
        </form>

<?php
/**
 * Displays the footer
 */
echo "\n";
require('./footer.inc.php3');
?>
