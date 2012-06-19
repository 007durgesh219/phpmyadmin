<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Text Plain Append Transformations plugin for phpMyAdmin
 *
 * @package    PhpMyAdmin-Transformations
 * @subpackage Append
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/* Get the append transformations interface */
require_once "libraries/plugins/abstract/AppendTransformationsPlugin.class.php";

/**
 * Handles the append transformation for text plain.
 * Has one option: the text to be appended (default '')
 *
 * @package PhpMyAdmin
 */
class Text_Plain_Append extends AppendTransformationsPlugin
{
    /**
     * Gets the transformation description of the specific plugin
     *
     * @return string
     */
    public function getInfo()
    {
        return __(
            'Appends text to a string. The only option is the text to be appended'
            . ' (enclosed in single quotes, default empty string).'
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