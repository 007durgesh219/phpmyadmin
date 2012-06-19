<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Text Plain Image Link Transformations plugin for phpMyAdmin
 *
 * @package    PhpMyAdmin-Transformations
 * @subpackage ImageLink
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/* Get the image link transformations interface */
require_once "abstract/ImageLinkTransformationsPlugin.class.php";

/**
 * Handles the image link transformation for text plain
 *
 * @package PhpMyAdmin
 */
class Text_Plain_Imagelink extends ImageLinkTransformationsPlugin
{
    /**
     * Gets the transformation description of the specific plugin
     *
     * @return string
     */
    public static function getInfo()
    {
        return __(
            'Displays an image and a link; the column contains the filename. The'
            . ' first option is a URL prefix like "http://www.example.com/". The'
            . ' second and third options are the width and the height in pixels.'
        );
    }

    /**
     * Gets the plugin`s MIME type
     *
     * @return string
     */
    public static function getMIMEType()
    {
        return "Text";
    }

    /**
     * Gets the plugin`s MIME subtype
     *
     * @return string
     */
    public static function getMIMESubtype()
    {
        return "Plain";
    }
}
?>