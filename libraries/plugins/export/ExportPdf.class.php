<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Produce a PDF report (export) from a query
 *
 * @package    PhpMyAdmin-Export
 * @subpackage PDF
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/* Get the export interface */
require_once "libraries/plugins/ExportPlugin.class.php";
/* Get the PMA_ExportPdf class */
require_once 'libraries/plugins/export/PMA_ExportPdf.class.php';

/**
 * Handles the export for the PDF class
 *
 * @todo add descriptions for all vars/methods
 * @package PhpMyAdmin-Export
 */
class ExportPdf extends ExportPlugin
{
    private $_pdf;
    private $_pdfReportTitle;

    /**
     * Constructor
     */
    public function __construct()
    {
        // initialize the specific export PDF variables
        $this->initLocalVariables();

        $this->setProperties();
    }

    /**
     * Initialize the local variables that are used for export PDF
     *
     * @return void
     */
    private function initLocalVariables()
    {
        global $pdf_report_title;
        $this->setPdfReportTitle($pdf_report_title);
        $this->setPdf(new PMA_ExportPdf('L', 'pt', 'A3'));
    }

    /**
     * Sets the export PDF properties
     *
     * @return void
     */
    protected function setProperties()
    {
        $this->properties = array(
            'text' => __('PDF'),
            'extension' => 'pdf',
            'mime_type' => 'application/pdf',
            'force_file' => true,
            'options' => array(),
            'options_text' => __('Options')
        );

        $this->properties['options'] = array(
            array(
                'type' => 'begin_group',
                'name' => 'general_opts'
            ),
            array(
                'type' => 'message_only',
                'name' => 'explanation',
                'text' => __(
                    '(Generates a report containing the data of a single table)'
                )
            ),
            array(
                'type' => 'text',
                'name' => 'report_title',
                'text' => __('Report title:')
            ),
            array(
                'type' => 'hidden',
                'name' => 'structure_or_data'
            ),
            array(
                'type' => 'end_group'
            )
        );
    }

    /**
     * This method is called when any PluginManager to which the observer
     * is attached calls PluginManager::notify()
     *
     * @param SplSubject $subject The PluginManager notifying the observer
     *                            of an update.
     *
     * @return void
     */
    public function update (SplSubject $subject)
    {
    }

    /**
     * Outputs export header
     *
     * @return bool Whether it succeeded
     */
    public function exportHeader ()
    {
        $pdf_report_title = $this->getPdfReportTitle();
        $pdf = $this->getPdf();
        $pdf->Open();

        $attr = array('titleFontSize' => 18, 'titleText' => $pdf_report_title);
        $pdf->setAttributes($attr);
        $pdf->setTopMargin(30);

        return true;
    }

    /**
     * Outputs export footer
     *
     * @return bool Whether it succeeded
     */
    public function exportFooter ()
    {
        $pdf = $this->getPdf();

        // instead of $pdf->Output():
        if (! PMA_exportOutputHandler($pdf->getPDFData())) {
            return false;
        }

        return true;
    }

    /**
     * Outputs database header
     *
     * @param string $db Database name
     *
     * @return bool Whether it succeeded
     */
    public function exportDBHeader ($db)
    {
        return true;
    }

    /**
     * Outputs database footer
     *
     * @param string $db Database name
     *
     * @return bool Whether it succeeded
     */
    public function exportDBFooter ($db)
    {
        return true;
    }

    /**
     * Outputs CREATE DATABASE statement
     *
     * @param string $db Database name
     *
     * @return bool Whether it succeeded
     */
    public function exportDBCreate($db)
    {
        return true;
    }
    /**
     * Outputs the content of a table in NHibernate format
     *
     * @param string $db        database name
     * @param string $table     table name
     * @param string $crlf      the end of line sequence
     * @param string $error_url the url to go back in case of error
     * @param string $sql_query SQL query for obtaining data
     *
     * @return bool Whether it succeeded
     */
    public function exportData($db, $table, $crlf, $error_url, $sql_query)
    {
        $pdf = $this->getPdf();

        $attr = array('currentDb' => $db, 'currentTable' => $table);
        $pdf->setAttributes($attr);
        $pdf->mysqlReport($sql_query);

        return true;
    } // end of the 'PMA_exportData()' function


    /* ~~~~~~~~~~~~~~~~~~~~ Getters and Setters ~~~~~~~~~~~~~~~~~~~~ */


    public function getPdf()
    {
        return $this->_pdf;
    }

    public function setPdf($pdf)
    {
        $this->_pdf = $pdf;
    }

    public function getPdfReportTitle()
    {
        return $this->_pdfReportTitle;
    }

    public function setPdfReportTitle($pdf_report_title)
    {
        $this->_pdfReportTitle = $pdf_report_title;
    }
}
?>