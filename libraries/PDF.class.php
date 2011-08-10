<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * TCPDF wrapper class.
 */

require_once './libraries/tcpdf/tcpdf.php';

/**
 * PDF font to use.
 */
define('PMA_PDF_FONT', 'DejaVuSans');

/**
 * PDF export base class providing basic configuration.
 */
class PMA_PDF extends TCPDF
{
    var $footerset;

    public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false)
    {
        parent::__construct();
        $this->SetAuthor('phpMyAdmin ' . PMA_VERSION);
        $this->AliasNbPages();
        $this->AddFont('DejaVuSans', '', 'dejavusans.php');
        $this->AddFont('DejaVuSans', 'B', 'dejavusansb.php');
        $this->AddFont('DejaVuSerif', '', 'dejavuserif.php');
        $this->AddFont('DejaVuSerif', 'B', 'dejavuserifb.php');
        $this->SetFont(PMA_PDF_FONT, '', 14);
        $this->setFooterFont(array(PMA_PDF_FONT, '', 14));
    }

    /**
     * This function must be named "Footer" to work with the TCPDF library
     */
    function Footer()
    {
        // Check if footer for this page already exists
        if (!isset($this->footerset[$this->page])) {
            $this->SetY(-15);
            $this->SetFont(PMA_PDF_FONT, '', 14);
            $this->Cell(0, 6, __('Page number:') . ' ' . $this->getAliasNumPage() . '/' .  $this->getAliasNbPages(), 'T', 0, 'C');
            $this->Cell(0, 6, PMA_localisedDate(), 0, 1, 'R');
            $this->SetY(20);

            // set footerset
            $this->footerset[$this->page] = 1;
        }
    }
}
