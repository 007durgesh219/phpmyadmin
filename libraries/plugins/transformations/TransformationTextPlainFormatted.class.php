<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Text Plain Formatted Transformations plugin for phpMyAdmin
 *
 * @package    PhpMyAdmin-Transformations
 * @subpackage Formatted
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/* Get the formatted transformations interface */
require_once "libraries/plugins/abstract/FormattedTransformationsPlugin.class.php";

/**
 * Handles the formatted transformation for text plain
 *
 * @package PhpMyAdmin
 */
class TransformationTextPlainFormatted
    extends FormattedTransformationsPlugin
{
    /**
     * Gets the transformation description of the specific plugin
     *
     * @return string
     */
    public function getInfo()
    {
        return __(
            'Displays the contents of the column as-is, without running it'
            . ' through htmlspecialchars(). That is, the column is assumed'
            . ' to contain valid HTML.'
        );
    }

    /**
     * Gets the plugin`s MIME type
     *
     * @return string
     */
    public function getMIMEType()
    {
        return "Text";
    }

    /**
     * Gets the plugin`s MIME subtype
     *
     * @return string
     */
    public function getMIMESubtype()
    {
        return "Plain";
    }
}
?>