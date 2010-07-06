<?php

require_once './libraries/chart/pma_ofc_pie.php';

require_once './libraries/chart/pma_pchart_pie.php';
require_once './libraries/chart/pma_pchart_bar.php';
require_once './libraries/chart/pma_pchart_stacked.php';

/**
 * Chart functions used to generate various types
 * of charts.
 *
 * @version $Id$
 * @package phpMyAdmin
 */

/*
 * Formats a chart for status page.
 */
function PMA_chart_status($data)
{
    // format keys which will be shown in the chart
    $chartData = array();
    foreach($data as $dataKey => $dataValue) {
        $key = ucwords(str_replace(array('Com_', '_'), array('', ' '), $dataKey));
        $value = (int)$dataValue;
        $chartData[$key] = $value;
    }
    
    //$chart = new PMA_OFC_Pie(__('Query type'), $chartData, $options);
    $chart = new PMA_pChart_Pie(
            __('Query statistics'),
            $chartData);
    echo $chart->toString();
}

/*
 * Formats a chart for profiling page.
 */
function PMA_chart_profiling($data)
{
    $chartData = array();
    foreach($data as $dataValue) {
        $value = (int)($dataValue['Duration']*1000000);
        $key = ucwords($dataValue['Status']);
        $chartData[$key] = $value;
    }

    $chart = new PMA_pChart_Pie(
            __('Query execution time comparison (in microseconds)'),
            $chartData);
    echo $chart->toString();
}

/*
 * Formats a chart for query results page.
 */
function PMA_chart_results($data, &$chartSettings)
{
    $chartData = array();
    $chart = null;
    if (!empty($chartSettings['title'])) {
        $chartTitle = $chartSettings['title'];
    }
    else {
        $chartTitle = __('Query results');
    }

    if (!isset($data[0])) {
        // empty data
        return;
    }

    if (count($data[0]) == 2) {
        // Two columns in every row.
        // This data is suitable for a simple bar chart.

        // loop through the rows
        foreach ($data as $row) {
            // loop through the columns in the row
            foreach ($row as $key => $value) {
                $chartData[$key][] = $value;
            }
        }

        $chart = new PMA_pChart_bar($chartTitle, $chartData, $chartSettings);
    }
    else if (count($data[0]) == 3) {
        // Three columns (x axis, y axis, series) in every row.
        // This data is suitable for a stacked bar chart.
        $keys = array_keys($data[0]);
        $xAxisKey = $keys[0];
        $yAxisKey = $keys[1];
        $seriesKey = $keys[2];
        
        // get all the series labels
        $seriesLabels = array();
        foreach ($data as $row) {
            $seriesLabels[] = $row[$seriesKey];
        }
        $seriesLabels = array_unique($seriesLabels);

        // loop through the rows
        $currentXLabel = $data[0][$xAxisKey];
        foreach ($data as $row) {

            // save the label
            // use the same value as the key and the value to get rid of duplicate results
            $chartData[$xAxisKey][$row[$xAxisKey]] = $row[$xAxisKey];

            // make sure to set value to every serie
            $currentSeriesLabel = (string)$row[$seriesKey];
            foreach ($seriesLabels as $seriesLabelsValue) {
                if ($currentSeriesLabel == $seriesLabelsValue) {
                    // the value os for this serie
                    $chartData[$yAxisKey][$seriesLabelsValue][$row[$xAxisKey]] = (int)$row[$yAxisKey];
                }
                else if (!isset($chartData[$yAxisKey][$seriesLabelsValue][$row[$xAxisKey]])) {
                    // if the value for this serie is not set, set it to 0
                    $chartData[$yAxisKey][$seriesLabelsValue][$row[$xAxisKey]] = 0;
                }
            }
        }

        $chart = new PMA_pChart_stacked($chartTitle, $chartData, $chartSettings);
    }
    else {
        // unknown data
        return;
    }

    $chartSettings = $chart->getSettings();
    return $chart->toString();
}

?>
