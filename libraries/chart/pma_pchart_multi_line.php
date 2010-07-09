<?php

require_once 'pma_pchart_multi.php';

class PMA_pChart_multi_line extends PMA_pChart_multi
{
    public function __construct($data, $options = null)
    {
        parent::__construct($data, $options);

        $this->settings['scale'] = SCALE_NORMAL;
    }

    protected function drawChart()
    {
        parent::drawChart();

        // Draw the bar chart
        $this->chart->drawLineGraph($this->dataSet->GetData(),$this->dataSet->GetDataDescription());
        $this->chart->drawPlotGraph($this->dataSet->GetData(),$this->dataSet->GetDataDescription(),3,1,-1,-1,-1,TRUE);
    }
}

?>
