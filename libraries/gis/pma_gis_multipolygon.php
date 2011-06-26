<?php
/**
 * Handles the visualization of GIS MULTIPOLYGON objects.
 *
 * @package phpMyAdmin
 */
class PMA_GIS_Multipolygon extends PMA_GIS_Geometry
{
    // Hold the singleton instance of the class
    private static $_instance;

    /**
     * A private constructor; prevents direct creation of object.
     */
    private function __construct()
    {
    }

    /**
     * Returns the singleton.
     *
     * @return the singleton
     */
    public static function singleton()
    {
        if (!isset(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }

        return self::$_instance;
    }

    /**
     * Scales each row.
     *
     * @param string $spatial spatial data of a row
     *
     * @return array containing the min, max values for x and y cordinates
     */
    public function scaleRow($spatial)
    {
        $min_max = array();

        // Trim to remove leading 'MULTIPOLYGON(((' and trailing ')))'
        $multipolygon = substr($spatial, 15, (strlen($spatial) - 18));
        // Seperate each polygon
        $polygons = explode(")),((", $multipolygon);

        foreach ($polygons as $polygon) {
            // If the polygon doesnt have an inner polygon
            if (strpos($polygon, "),(") === false) {
                $min_max = $this->setMinMax($polygon, $min_max);
            } else {
                // Seperate outer and inner polygons
                $parts = explode("),(", $polygon);
                $outer = $parts[0];
                $inner = array_slice($parts, 1);

                $min_max = $this->setMinMax($outer, $min_max);

                foreach ($inner as $inner_poly) {
                    $min_max = $this->setMinMax($inner_poly, $min_max);
                }
            }
        }

        return $min_max;
    }

    /**
     * Adds to the PNG image object, the data related to a row in the GIS dataset.
     *
     * @param string $spatial    GIS MULTIPOLYGON object
     * @param string $label      Label for the GIS MULTIPOLYGON object
     * @param string $fill_color Color for the GIS MULTIPOLYGON object
     * @param array  $scale_data Array containing data related to scaling
     * @param image  $image      Image object
     *
     * @return the modified image object
     */
    public function prepareRowAsPng($spatial, $label, $fill_color, $scale_data, $image)
    {
        // allocate colors
        $r = hexdec(substr($fill_color, 1, 2));
        $g = hexdec(substr($fill_color, 3, 2));
        $b = hexdec(substr($fill_color, 4, 2));
        $color = imagecolorallocate($image, $r, $g, $b);

        // Trim to remove leading 'MULTIPOLYGON(((' and trailing ')))'
        $multipolygon = substr($spatial, 15, (strlen($spatial) - 18));
        // Seperate each polygon
        $polygons = explode(")),((", $multipolygon);

        foreach ($polygons as $polygon) {
            // If the polygon doesnt have an inner polygon
            if (strpos($polygon, "),(") === false) {
                $points_arr = $this->extractPoints($polygon, $scale_data, true);
            } else {
                // Seperate outer and inner polygons
                $parts = explode("),(", $polygon);
                $outer = $parts[0];
                $inner = array_slice($parts, 1);

                $points_arr = $this->extractPoints($outer, $scale_data, true);

                foreach ($inner as $inner_poly) {
                    $points_arr = array_merge(
                        $points_arr, $this->extractPoints($inner_poly, $scale_data, true)
                    );
                }
            }
            // draw polygon
            imagefilledpolygon($image, $points_arr, sizeof($points_arr) / 2, $color);
        }
        return $image;
    }

    /**
     * Adds to the TCPDF instance, the data related to a row in the GIS dataset.
     *
     * @param string $spatial    GIS MULTIPOLYGON object
     * @param string $label      Label for the GIS MULTIPOLYGON object
     * @param string $fill_color Color for the GIS MULTIPOLYGON object
     * @param array  $scale_data Array containing data related to scaling
     * @param image  $pdf        TCPDF instance
     *
     * @return the modified TCPDF instance
     */
    public function prepareRowAsPdf($spatial, $label, $fill_color, $scale_data, $pdf)
    {
        // allocate colors
        $r = hexdec(substr($fill_color, 1, 2));
        $g = hexdec(substr($fill_color, 3, 2));
        $b = hexdec(substr($fill_color, 4, 2));
        $color = array($r, $g, $b);

        // Trim to remove leading 'MULTIPOLYGON(((' and trailing ')))'
        $multipolygon = substr($spatial, 15, (strlen($spatial) - 18));
        // Seperate each polygon
        $polygons = explode(")),((", $multipolygon);

        foreach ($polygons as $polygon) {
            // If the polygon doesnt have an inner polygon
            if (strpos($polygon, "),(") === false) {
                $points_arr = $this->extractPoints($polygon, $scale_data, true);
            } else {
                // Seperate outer and inner polygons
                $parts = explode("),(", $polygon);
                $outer = $parts[0];
                $inner = array_slice($parts, 1);

                $points_arr = $this->extractPoints($outer, $scale_data, true);

                foreach ($inner as $inner_poly) {
                    $points_arr = array_merge(
                        $points_arr, $this->extractPoints($inner_poly, $scale_data, true)
                    );
                }
            }
            // draw polygon
            $pdf->Polygon($points_arr, 'F*', array(), $color, true);
        }
        return $pdf;
    }

    /**
     * Prepares and returns the code related to a row in the GIS dataset as SVG.
     *
     * @param string $spatial    GIS MULTIPOLYGON object
     * @param string $label      Label for the GIS MULTIPOLYGON object
     * @param string $fill_color Color for the GIS MULTIPOLYGON object
     * @param array  $scale_data Array containing data related to scaling
     *
     * @return the code related to a row in the GIS dataset
     */
    public function prepareRowAsSvg($spatial, $label, $fill_color, $scale_data)
    {
        $polygon_options = array(
            'name'        => $label,
            'class'       => 'multipolygon vector',
            'stroke'      => 'black',
            'stroke-width'=> 0.5,
            'fill'        => $fill_color,
            'fill-rule'   => 'evenodd',
            'fill-opacity'=> 0.8,
        );

        $row = '';

        // Trim to remove leading 'MULTIPOLYGON(((' and trailing ')))'
        $multipolygon = substr($spatial, 15, (strlen($spatial) - 18));
        // Seperate each polygon
        $polygons = explode(")),((", $multipolygon);

        foreach ($polygons as $polygon) {
            $row .= '<path d="';

            // If the polygon doesnt have an inner polygon
            if (strpos($polygon, "),(") === false) {
                $row .= $this->_drawPath($polygon, $scale_data);
            } else {
                // Seperate outer and inner polygons
                $parts = explode("),(", $polygon);
                $outer = $parts[0];
                $inner = array_slice($parts, 1);

                $row .= $this->_drawPath($outer, $scale_data);

                foreach ($inner as $inner_poly) {
                    $row .= $this->_drawPath($inner_poly, $scale_data);
                }
            }
            $polygon_options['id'] = $label . rand();
            $row .= '"';
            foreach ($polygon_options as $option => $val) {
                $row .= ' ' . $option . '="' . trim($val) . '"';
            }
            $row .= '/>';
        }

        return $row;
    }

    /**
     * Prepares JavaScript related to a row in the GIS dataset to visualize it with OpenLayers.
     *
     * @param string $spatial    GIS MULTIPOLYGON object
     * @param int    $srid       Spatial reference ID
     * @param string $label      Label for the GIS MULTIPOLYGON object
     * @param string $fill_color Color for the GIS MULTIPOLYGON object
     * @param array  $scale_data Array containing data related to scaling
     *
     * @return JavaScript related to a row in the GIS dataset
     */
    public function prepareRowAsOl($spatial, $srid, $label, $fill_color, $scale_data)
    {
        $style_options = array(
            'strokeColor' => '#000000',
            'strokeWidth' => 0.5,
            'fillColor'   => $fill_color,
            'fillOpacity' => 0.8,
            'label'       => $label,
            'fontSize'    => 10,
        );
        if ($srid == 0) {
            $srid = 4326;
        }
        $row = $this->getBoundsForOl($srid, $scale_data);

        // Trim to remove leading 'MULTIPOLYGON(((' and trailing ')))'
        $multipolygon = substr($spatial, 15, (strlen($spatial) - 18));
        // Seperate each polygon
        $polygons = explode(")),((", $multipolygon);

        $row .= 'vectorLayer.addFeatures(new OpenLayers.Feature.Vector('
            . 'new OpenLayers.Geometry.MultiPolygon(new Array(';

        foreach ($polygons as $polygon) {
            $row .= 'new OpenLayers.Geometry.Polygon(new Array(';
            // If the polygon doesnt have an inner polygon
            if (strpos($polygon, "),(") === false) {
                $points_arr = $this->extractPoints($polygon, null);
                $row .= 'new OpenLayers.Geometry.LinearRing(new Array(';
                foreach ($points_arr as $point) {
                    $row .= '(new OpenLayers.Geometry.Point(' . $point[0] . ', ' . $point[1] . '))'
                        . '.transform(new OpenLayers.Projection("EPSG:' . $srid . '"), map.getProjectionObject()), ';
                }
                $row = substr($row, 0, strlen($row) - 2);
                $row .= '))';
            } else {
                // Seperate outer and inner polygons
                $parts = explode("),(", $polygon);
                foreach ($parts as $ring) {
                    $points_arr = $this->extractPoints($ring, null);
                    $row .= 'new OpenLayers.Geometry.LinearRing(new Array(';
                    foreach ($points_arr as $point) {
                        $row .= '(new OpenLayers.Geometry.Point(' . $point[0] . ', ' . $point[1] . '))'
                            . '.transform(new OpenLayers.Projection("EPSG:' . $srid . '"), map.getProjectionObject()), ';
                    }
                    $row = substr($row, 0, strlen($row) - 2);
                    $row .= ')), ';
                }
                $row = substr($row, 0, strlen($row) - 2);
            }
            $row .= ')), ';
        }
        $row = substr($row, 0, strlen($row) - 2);
        $row .= ')), null, ' . json_encode($style_options) . '));';
        return $row;
    }

    /**
     * Draws a ring of the polygon using SVG path element.
     *
     * @param string $polygon    The ring
     * @param array  $scale_data Array containing data related to scaling
     *
     * @return the code to draw the ring
     */
    private function _drawPath($polygon, $scale_data)
    {
        $points_arr = $this->extractPoints($polygon, $scale_data);

        $row = ' M ' . $points_arr[0][0] . ', ' . $points_arr[0][1];
        $other_points = array_slice($points_arr, 1, count($points_arr) - 2);
        foreach ($other_points as $point) {
            $row .= ' L ' . $point[0] . ', ' . $point[1];
        }
        $row .= ' Z ';

        return $row;
    }

    /**
     * Generate the WKT with the set of parameters passed by the GIS editor.
     *
     * @param array $gis_data GIS data
     * @param int   $index    Index into the parameter object
     *
     * @return WKT with the set of parameters passed by the GIS editor
     */
    public function generateWkt($gis_data, $index)
    {
        $no_of_polygons = isset($gis_data[$index]['MULTIPOLYGON']['no_of_polygons'])
            ? $gis_data[$index]['MULTIPOLYGON']['no_of_polygons'] : 1;
        if ($no_of_polygons < 1) {
            $no_of_polygons = 1;
        }
        $wkt = 'MULTIPOLYGON(';
        for ($k = 0; $k < $no_of_polygons; $k++) {
            $no_of_lines = isset($gis_data[$index]['MULTIPOLYGON'][$k]['no_of_lines'])
                ? $gis_data[$index]['MULTIPOLYGON'][$k]['no_of_lines'] : 1;
            if ($no_of_lines < 1) {
                $no_of_lines = 1;
            }
            $wkt .= '(';
            for ($i = 0; $i < $no_of_lines; $i++) {
                $no_of_points = isset($gis_data[$index]['MULTIPOLYGON'][$k][$i]['no_of_points'])
                    ? $gis_data[$index]['MULTIPOLYGON'][$k][$i]['no_of_points'] : 3;
                if ($no_of_points < 3) {
                    $no_of_points = 3;
                }
                $wkt .= '(';
                for ($j = 0; $j < $no_of_points; $j++) {
                    $wkt .= (isset($gis_data[$index]['MULTIPOLYGON'][$k][$i][$j]['x'])
                        ? $gis_data[$index]['MULTIPOLYGON'][$k][$i][$j]['x'] : '')
                        . ' ' . (isset($gis_data[$index]['MULTIPOLYGON'][$k][$i][$j]['y'])
                        ? $gis_data[$index]['MULTIPOLYGON'][$k][$i][$j]['y'] : '') .',';
                }
                $wkt = substr($wkt, 0, strlen($wkt) - 1);
                $wkt .= '),';
            }
            $wkt = substr($wkt, 0, strlen($wkt) - 1);
            $wkt .= '),';
        }
        $wkt = substr($wkt, 0, strlen($wkt) - 1);
        $wkt .= ')';
        return $wkt;
    }

    /** Generate parameters for the GIS data editor from the value of the GIS column.
     *
     * @param string $value of the GIS column
     * @param index  $index of the geometry
     *
     * @return  parameters for the GIS data editor from the value of the GIS column
     */
    public function generateParams($value, $index = -1)
    {
        if ($index == -1) {
            $index = 0;
            $params = array();
            $last_comma = strripos($value, ",");
            $params['srid'] = trim(substr($value, $last_comma + 1));
            $wkt = trim(substr($value, 1, $last_comma - 2));
        } else {
            $params[$index]['gis_type'] = 'MULTIPOLYGON';
            $wkt = $value;
        }

        // Trim to remove leading 'MULTIPOLYGON(((' and trailing ')))'
        $multipolygon = substr($wkt, 15, (strlen($wkt) - 18));
        // Seperate each polygon
        $polygons = explode(")),((", $multipolygon);
        $params[$index]['MULTIPOLYGON']['no_of_polygons'] = count($polygons);

        $k = 0;
        foreach ($polygons as $polygon) {
            // If the polygon doesnt have an inner polygon
            if (strpos($polygon, "),(") === false) {
                $params[$index]['MULTIPOLYGON'][$k]['no_of_lines'] = 1;
                $points_arr = $this->extractPoints($polygon, null);
                $no_of_points = count($points_arr);
                $params[$index]['MULTIPOLYGON'][$k][0]['no_of_points'] = $no_of_points;
                for ($i = 0; $i < $no_of_points; $i++) {
                    $params[$index]['MULTIPOLYGON'][$k][0][$i]['x'] = $points_arr[$i][0];
                    $params[$index]['MULTIPOLYGON'][$k][0][$i]['y'] = $points_arr[$i][1];
                }
            } else {
                // Seperate outer and inner polygons
                $parts = explode("),(", $polygon);
                $params[$index]['MULTIPOLYGON'][$k]['no_of_lines'] = count($parts);
                $j = 0;
                foreach ($parts as $ring) {
                    $points_arr = $this->extractPoints($ring, null);
                    $no_of_points = count($points_arr);
                    $params[$index]['MULTIPOLYGON'][$k][$j]['no_of_points'] = $no_of_points;
                    for ($i = 0; $i < $no_of_points; $i++) {
                        $params[$index]['MULTIPOLYGON'][$k][$j][$i]['x'] = $points_arr[$i][0];
                        $params[$index]['MULTIPOLYGON'][$k][$j][$i]['y'] = $points_arr[$i][1];
                    }
                    $j++;
                }
            }
            $k++;
        }
        return $params;
    }
}
?>
