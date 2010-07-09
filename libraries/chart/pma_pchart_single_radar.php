<?php

require_once 'pma_pchart_single.php';

class PMA_pChart_single_radar extends PMA_pChart_single
{
    public function __construct($data, $options = null)
    {
        parent::__construct($data, $options);

        $this->normalizeValues();
    }

    /*
     * Get the largest value from the data and normalize all the other values.
     */
    private function normalizeValues()
    {
        $maxValue = 0;
        $keys = array_keys($this->data);
        $valueKey = $keys[1];
        $maxValue = max($this->data[$valueKey]);

        foreach ($this->data[$valueKey] as &$value) {
            $value = $value / $maxValue * 10;
        }
    }

    protected function drawGraphArea()
    {
        $this->chart->drawGraphArea(213,217,221,FALSE);
        $this->chart->drawGraphAreaGradient(163,203,167,50);
    }

    protected function drawChart()
    {
        // when drawing radar graph we can specify the border from the top of
        // graph area. We want border to be dynamic, so that either the top
        // or the side of the radar is some distance away from the top or the
        // side of the graph area.
        $areaWidth = $this->chart->GArea_X2 - $this->chart->GArea_X1;
        $areaHeight = $this->chart->GArea_Y2 - $this->chart->GArea_Y1;

        if ($areaHeight > $areaWidth) {
            $borderOffset = ($areaHeight - $areaWidth) / 2;
        }
        else {
            $borderOffset = 0;
        }

        // the least ammount that radar is away from the graph area side.
        $borderOffset += 40;

        $this->chart->drawRadarAxis($this->dataSet->GetData(),$this->dataSet->GetDataDescription(),TRUE,$borderOffset,120,120,120,230,230,230,-1,2);
        $this->chart->drawFilledRadar($this->dataSet->GetData(),$this->dataSet->GetDataDescription(),50,$borderOffset);
    }
}

?>
