/**
 * @fileoverview    functions used for visualizing GIS data
 *
 * @requires    jquery
 * @requires    jquery/jquery.svg.js
 * @requires    jquery/jquery.mousewheel.js
 * @requires    jquery/jquery.event.drag-2.0.min.js
 */

var x = 0;
var y = 0;
var scale = 1;
var svg;

/**
 * Zooms and pans the visualization.
 */
function zoomAndPan() {
    var g = svg.getElementById('groupPanel');

    g.setAttribute('transform', 'translate(' + x + ', ' + y + ') scale(' + scale + ')');
    var id;
    var circle;
    $('circle').each(function() {
        id = $(this).attr('id');
        circle = svg.getElementById(id);
        svg.change(circle, {
            r : (3 / scale),
            "stroke-width" : (2 / scale)
        });
    });

    var line;
    $('polyline').each(function() {
        id = $(this).attr('id');
        line = svg.getElementById(id);
        svg.change(line, {
            "stroke-width" : (2 / scale)
        });
    });

    var polygon;
    $('path').each(function() {
        id = $(this).attr('id');
        polygon = svg.getElementById(id);
        svg.change(polygon, {
            "stroke-width" : (0.5 / scale)
        });
    });
}

/**
 * Ajax handlers for GIS visualization page
 *
 * Actions Ajaxified here:
 *
 * Zooming in and zooming out on mousewheel movement.
 * Panning the visualization on dragging.
 * Zooming in on double clicking.
 * Zooming out on clicking the zoom out button.
 * Panning on clicking the arrow buttons.
 * Displaying tooltips for GIS objects.
 */
$(document).ready(function() {
    var $placeholder = $('#placeholder');
    var $openlayersmap = $('#openlayersmap');

   if ($('#choice').prop('checked') != true) {
        $openlayersmap.hide();
    } else {
        $placeholder.hide();
    }

    var cssObj = {
        'border' : '1px solid #aaa',
        'width' : $placeholder.width(),
        'height' : $placeholder.height(),
        'float' : 'right'
    };
    $openlayersmap.css(cssObj);
    drawOpenLayers();

    $('.choice').show();
    $('#choice').bind('click', function() {
        if ($(this).prop('checked') == false) {
            $placeholder.show();
            $openlayersmap.hide();
        } else {
            $placeholder.hide();
            $openlayersmap.show();
        }
    });

    $('#placeholder').svg({
        onLoad: function(svg_ref) {
            svg = svg_ref;
        }
    });

    // Removes the second SVG element unnecessarily added due to the above command.
    $('#placeholder').find('svg:nth-child(2)').remove();

    $('#placeholder').live('mousewheel', function(event, delta) {
        if (delta > 0) {
            //zoom in
            scale *= 1.5;
            // zooming in keeping the position under mouse pointer unmoved.
            x = event.layerX - (event.layerX - x) * 1.5;
            y = event.layerY - (event.layerY - y) * 1.5;
            zoomAndPan();
        } else {
            //zoom out
            scale /= 1.5;
            // zooming out keeping the position under mouse pointer unmoved.
            x = event.layerX - (event.layerX - x) / 1.5;
            y = event.layerY - (event.layerY - y) / 1.5;
            zoomAndPan();
        }
        return true;
    });

    var dragX = 0; var dragY = 0;
    $('svg').live('dragstart', function(event, dd) {
        dragX = Math.round(dd.offsetX);
        dragY = Math.round(dd.offsetY);
    });

    $('svg').live('drag', function(event, dd) {
        newX = Math.round(dd.offsetX);
        x +=  newX - dragX;
        dragX = newX;
        newY = Math.round(dd.offsetY);
        y +=  newY - dragY;
        dragY = newY;
        zoomAndPan();
    });

    $('#placeholder').live('dblclick', function(event) {
        scale *= 1.5;
        // zooming in keeping the position under mouse pointer unmoved.
        x = event.layerX - (event.layerX - x) * 1.5;
        y = event.layerY - (event.layerY - y) * 1.5;
        zoomAndPan();
    });

    $('#zoom_out').live('click', function(e) {
        e.preventDefault();
        //zoom out
        scale /= 1.5;

        width = $('#placeholder svg').attr('width');
        height = $('#placeholder svg').attr('height');
        // zooming out keeping the center unmoved.
        x = width / 2 - (width / 2 - x) / 1.5;
        y = height / 2 - (height / 2 - y) / 1.5;
        zoomAndPan();
    });

    $('#left_arrow').live('click', function(e) {
        e.preventDefault();
        x += 100;
        zoomAndPan();
    });

    $('#right_arrow').live('click', function(e) {
        e.preventDefault();
        x -= 100;
        zoomAndPan();
    });

    $('#up_arrow').live('click', function(e) {
        e.preventDefault();
        y += 100;
        zoomAndPan();
    });

    $('#down_arrow').live('click', function(e) {
        e.preventDefault();
        y -= 100;
        zoomAndPan();
    });

    /**
     * Detect the mousemove event and show tooltips.
     */
    $('.polygon, .multipolygon, .point, .multipoint, .linestring, .multilinestring, '
            + '.geometrycollection').live('mousemove', function(event) {
        contents = $(this).attr('name');
        $("#tooltip").remove();
        if (contents != '') {
            $('<div id="tooltip">' + contents + '</div>').css({
                position : 'absolute',
                display : 'none',
                top : event.pageY + 10,
                left : event.pageX + 10,
                border : '1px solid #fdd',
                padding : '2px',
                'background-color' : '#fee',
                opacity : 0.80
            }).appendTo("body").fadeIn(200);
        }
    });
    
    /**
     * Detect the mouseout event and hide tooltips.
     */
    $('.polygon, .multipolygon, .point, .multipoint, .linestring, .multilinestring, '
            + '.geometrycollection').live('mouseout', function(event) {
        $("#tooltip").remove();
    });
});
