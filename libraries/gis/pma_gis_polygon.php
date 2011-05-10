<?php
/**
 * Handles the visualization of GIS POLYGON objects.
 * @package phpMyAdmin
 */
class PMA_GIS_polygon extends PMA_GIS_geometry
{
    // Hold the singleton instance of the class
    private static $instance;

    // A private constructor; prevents direct creation of object
    private function __construct() {
    }

    /**
     * Returns the singleton.
     *
     * @return the singleton
     */
    public static function singleton() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    /**
     * Prepares and returns the code related to a row in the GIS dataset.
     *
     * @param string $spatial  GIS POLYGON object
     * @param string $label  Label for the GIS POLYGON object
     * @param string $color  Color for the GIS POLYGON object
     * @return the code related to a row in the GIS dataset
     */
    public function prepareRow($spatial, $label, $fill_color) {

        $polygon_options = array('lineWidth' => 1.0, 'show' => true,
            'fillColor' => $fill_color, 'fill' => true);
        $inner_polygon_options = array('lineWidth' => 1.0, 'show' => true,
            'fillColor' => '#e5e5e5', 'fill' => true);

        // Trim to remove leading 'POLYGON((' and trailing '))'
        $polygon = substr($spatial, 9, (strlen($spatial) - 11));

        // If the polygon doesnt have an inner polygon
        if (strpos($polygon, "),(") === false) {
            $row = array('data' => $this->extractPoints($polygon), 'label' => $label,
                'lines' => $polygon_options, 'color' => 'black', 'hoverable' => true);
        } else {
            // Seperate outer and inner polygons
            $parts = explode("),(", $polygon);
            $outer = $parts[0];
            $inner = array_slice($parts, 1);

            $row = array();
            $row[] = array('data' => $this->extractPoints($outer), 'label' => $label,
                'lines' => $polygon_options, 'color' => 'black', 'hoverable' => true);
            foreach($inner as $inner_poly) {
                $row[] = array('data' => $this->extractPoints($inner_poly), 'label' => $label,
                    'lines' => $inner_polygon_options, 'color' => 'black', 'hoverable' => true);
            }
        }

        return $row;
    }
}
?>
