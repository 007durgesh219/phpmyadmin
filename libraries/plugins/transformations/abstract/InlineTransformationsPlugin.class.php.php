<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Abstract class for the inline transformations plugins
 *
 * @package    PhpMyAdmin-Transformations
 * @subpackage Inline
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/* Get the transformations interface */
require_once "libraries/plugins/TransformationsPlugin.class.php";

/**
 * Provides common methods for all of the inline transformations plugins.
 *
 * @package PhpMyAdmin
 */
abstract class InlineTransformationsPlugin extends PluginObserver
{
    /**
     * Does the actual work of each specific transformations plugin.
     *
     * @param string $buffer  text to be transformed
     * @param array  $options transformation options
     * @param string $meta    meta information
     *
     * @todo implement
     * @return void
     */
    public function applyTransformation($buffer, $options, $meta)
    {
        ;
    }

    /**
     * This method is called when any PluginManager to which the observer
     * is attached calls PluginManager::notify()
     *
     * @param SplSubject $subject The PluginManager notifying the observer
     *                            of an update.
     *
     * @todo implement
     * @return void
     */
    public function update (SplSubject $subject)
    {
        ;
    }


    /* ~~~~~~~~~~~~~~~~~~~~ Getters and Setters ~~~~~~~~~~~~~~~~~~~~ */


    /**
     * Gets the transformation name of the specific plugin
     *
     * @return string
     */
    public function getName()
    {
        return "Inline";
    }
}
?>