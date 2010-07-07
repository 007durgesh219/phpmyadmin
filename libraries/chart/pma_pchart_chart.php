<?php

require_once 'pma_chart.php';

include "pChart/pData.class";
include "pChart/pChart.class";

/*
 * Base class for every chart implemented using pChart.
 */
abstract class PMA_pChart_Chart extends PMA_Chart
{
    protected $titleText;
    protected $data;

    protected $dataSet;
    protected $chart;

    protected $imageEncoded;

    public function __construct($titleText, $data, $options = null)
    {
        parent::__construct($options);

        $this->titleText = $titleText;
        $this->data = $data;

        $this->settings['fontPath'] = './libraries/chart/pChart/fonts/';
    }

    abstract protected function prepareDataSet();
    abstract protected function prepareChart();

    protected function render()
    {
        ob_start();
        imagepng($this->chart->Picture);
        $output = ob_get_contents();
        ob_end_clean();

        $this->imageEncoded = base64_encode($output);
    }

    public function toString()
    {
        if (function_exists('gd_info')) {
            $this->prepareDataSet();
            $this->prepareChart();
            $this->render();

            return '<img id="pChartPicture1" src="data:image/png;base64,'.$this->imageEncoded.'" />';
        }
        else {
            return 'Missing GD library.';
        }
    }

    protected function getFontPath()
    {
        return $this->settings['fontPath'];
    }
}

?>
