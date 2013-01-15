/* vim: set expandtab sw=4 ts=4 sts=4: */

var chart_xaxis_idx = -1;
var chart_series;
var chart_data = null;
var temp_chart_title;
var y_values_text;
var currentChart = null;
var nonJqplotSettings = null;
var currentSettings = null;

/**
 * Unbind all event handlers before tearing down a page
 */
AJAX.registerTeardown('tbl_chart.js', function() {
    $('input[name="chartType"]').unbind('click');
    $('input[name="barStacked"]').unbind('click');
    $('input[name="chartTitle"]').unbind('focus').unbind('keyup').unbind('blur');
    $('select[name="chartXAxis"]').unbind('change');
    $('select[name="chartSeries"]').unbind('change');
    $('input[name="xaxis_label"]').unbind('keyup');
    $('input[name="yaxis_label"]').unbind('keyup');
});

AJAX.registerOnload('tbl_chart.js', function() {
    chart_series = $('select[name="chartSeries"]').val();
    // If no series is selected null is returned.
    // In such case initialize chart_series to empty array.
    if (chart_series == null) {
        chart_series = new Array();
    }
    chart_xaxis_idx = $('select[name="chartXAxis"]').val();
    y_values_text = $('input[name="yaxis_label"]').val();

    // from jQuery UI
    $('#resizer').resizable({
        minHeight:240,
        minWidth:300
    });

    $('#resizer').bind('resizestop', function(event,ui) {
        // make room so that the handle will still appear
        $('#querychart').height($('#resizer').height() * 0.96);
        $('#querychart').width($('#resizer').width() * 0.96);
        currentChart.replot( {resetAxes: true})
    });

    nonJqplotSettings = {
        chart: {
            type: 'line',
            width: $('#resizer').width() - 20,
            height: $('#resizer').height() - 20
        }
    }

    currentSettings = {
        grid: {
            drawBorder: false,
            shadow: false,
            background: 'rgba(0,0,0,0)'
        },
        axes: {
            xaxis: {
                label: $('input[name="xaxis_label"]').val(),
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
            },
            yaxis: {
                label: $('input[name="yaxis_label"]').val(),
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
            }
        },
        title: {
            text: $('input[name="chartTitle"]').attr('value'),
            escapeHtml: true
            //margin:20
        },
        legend: {
            show: true,
            placement: 'outsideGrid',
            location: 'se'
        }
    };


    $('input[name="chartType"]').click(function() {
        nonJqplotSettings.chart.type = $(this).val();

        drawChart();

        if ($(this).val() == 'bar' || $(this).val() == 'column') {
            $('span.barStacked').show();
        } else {
            $('span.barStacked').hide();
        }
    });

    $('input[name="barStacked"]').click(function() {
        if (this.checked) {
            $.extend(true,currentSettings,{ stackSeries: true });
        } else {
            $.extend(true,currentSettings,{ stackSeries: false });
        }
        drawChart();
    });

    $('input[name="chartTitle"]').focus(function() {
        temp_chart_title = $(this).val();
    });
    $('input[name="chartTitle"]').keyup(function() {
        var title = $(this).val();
        if (title.length == 0) {
            title = ' ';
        }
        currentSettings.title = $('input[name="chartTitle"]').val();
        drawChart();
    });
    $('input[name="chartTitle"]').blur(function() {
        if ($(this).val() != temp_chart_title) {
            drawChart();
        }
    });

    $('select[name="chartXAxis"]').change(function() {
        chart_xaxis_idx = $(this).val();
        var xaxis_title = $(this).children('option:selected').text();
        $('input[name="xaxis_label"]').val(xaxis_title);
        currentSettings.axes.xaxis.label = xaxis_title;
        drawChart();
    });
    $('select[name="chartSeries"]').change(function() {
        chart_series = $(this).val();

        if (chart_series.length == 1) {
            $('span.span_pie').show();
            var yaxis_title = $(this).children('option:selected').text();
        } else {
            $('span.span_pie').hide();
            if (nonJqplotSettings.chart.type == 'pie') {
                $('input#radio_line').prop('checked', true);
                nonJqplotSettings.chart.type = 'line';
            }
            var yaxis_title = y_values_text;
        }
        $('input[name="yaxis_label"]').val(yaxis_title);
        currentSettings.axes.yaxis.label = yaxis_title;

        drawChart();
    });

    /* Sucks, we cannot just set axis labels, we have to redraw the chart completely */
    $('input[name="xaxis_label"]').keyup(function() {
        currentSettings.axes.xaxis.label = $(this).val();
        drawChart();
    });
    $('input[name="yaxis_label"]').keyup(function() {
        currentSettings.axes.yaxis.label = $(this).val();
        drawChart();
    });
});


/**
 * Ajax Event handler for 'Go' button click
 *
 */
$("#tblchartform").live('submit', function(event) {
    if (!checkFormElementInRange(this, 'session_max_rows', PMA_messages['strNotValidRowNumber'], 1)
        || !checkFormElementInRange(this, 'pos', PMA_messages['strNotValidRowNumber'], 0-1)) {
        return false;
     }

    var $form = $(this);
    if (! checkSqlQuery($form[0])) {
        return false;
    }
    // remove any div containing a previous error message
    $('.error').remove();
    var $msgbox = PMA_ajaxShowMessage();
    PMA_prepareForAjaxRequest($form);

    $.post($form.attr('action'), $form.serialize() , function(data) {
        if (data.success == true) {
            $('.success').fadeOut();
            if (typeof data.chartData != 'undefined') {
                chart_data = jQuery.parseJSON(data.chartData);
                drawChart();
                $('div#querychart').height($('div#resizer').height() * 0.96);
                $('div#querychart').width($('div#resizer').width() * 0.96);
                currentChart.replot( {resetAxes: true});
                $('#querychart').show();
            }
        } else {
            PMA_ajaxRemoveMessage($msgbox);
            PMA_ajaxShowMessage(data.error, false);
            chart_data = null;
            drawChart();
        }
        PMA_ajaxRemoveMessage($msgbox);
    }, "json"); // end $.post()

    return false;
}); // end

function isColumnNumeric(columnName)
{
    var first = true;
    var isNumeric = false;
    $('select[name="chartSeries"] option').each(function() {
        if ($(this).val() == columnName) {
            isNumeric = true;
            return false;
        }
    });
    return isNumeric;
}

function drawChart() {
    nonJqplotSettings.chart.width = $('#resizer').width() - 20;
    nonJqplotSettings.chart.height = $('#resizer').height() - 20;

    // todo: a better way using .replot() ?
    if (currentChart != null) {
        currentChart.destroy();
    }
    currentChart = PMA_queryChart(chart_data, currentSettings, nonJqplotSettings);
}

function PMA_queryChart(data, passedSettings, passedNonJqplotSettings)
{
    if ($('#querychart').length == 0) {
        return;
    }

    var columnNames = [];
    var series = new Array();
    var xaxis = {
        type: 'linear',
        categories: new Array()
    };
    var yaxis = new Object();

    $.each(data[0], function(index, element) {
        columnNames.push(index);
    });

    switch(passedNonJqplotSettings.chart.type) {
        case 'column':
        case 'spline':
        case 'line':
        case 'bar':
            var j = 0;
            for (var i = 0; i < columnNames.length; i++) {
                if (i != chart_xaxis_idx) {
                    series[j] = new Array();
                    if ($.inArray(columnNames[i], chart_series) != -1) {
                        $.each(data,function(key,value) {
                            series[j].push(
                                [
                                value[columnNames[chart_xaxis_idx]],
                                // todo: not always a number?
                                parseFloat(value[columnNames[i]])
                                ]
                            );
                        });
                        j++;
                    }
                }
            }
            if (columnNames.length == 2)
                yaxis.title = { text: columnNames[0] };
            break;

        case 'pie':
            if (chart_series.length == 1) {
                series[0] = new Array();
                $.each(data,function(key,value) {
                    series[0].push(
                        [
                        value[columnNames[chart_xaxis_idx]],
                        parseFloat(value[chart_series])
                        ]
                     );
                });
                break;
            }
    }

    var settings = {
        title: {
            text: '',
            escapeHtml: true
            //margin:20
        }
    };

    if (passedNonJqplotSettings.chart.type == 'line') {
        settings.axes = {
            xaxis: {
            },
            yaxis: {
            }
        }
    }

    if (passedNonJqplotSettings.chart.type == 'bar') {
        settings.seriesDefaults = {
            renderer: $.jqplot.BarRenderer,
            rendererOptions: {
                barDirection: 'vertical',
                highlightMouseOver: true
            }
        };
        settings.axes = {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer
            },
            yaxis: {
            }
        };
    }

    if (passedNonJqplotSettings.chart.type == 'spline') {
        settings.seriesDefaults = {
            rendererOptions: {
                smooth: true
            }
        };
    }

    if (passedNonJqplotSettings.chart.type == 'pie') {
        settings.seriesDefaults = {
            renderer: $.jqplot.PieRenderer,
            rendererOptions: {
                showDataLabels: true,
                highlightMouseOver: true,
                showDataLabels: true,
                dataLabels: 'value'
            }
        };
    }
    // Overwrite/Merge default settings with passedsettings
    $.extend(true, settings, passedSettings);

    settings.series = new Array();
    for (var i = 0; i < columnNames.length; i++) {
        if (parseInt(chart_xaxis_idx) != i) {
            if ($.inArray(columnNames[i], chart_series) != -1) {
                settings.series.push({ label: columnNames[i] });
            }
        }
    }

    return $.jqplot('querychart', series, settings);
}
