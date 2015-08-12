<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Fake response stub for testing purposes
 *
 * It will concatenate HTML and JSON for given calls to addHTML and addJSON respectively,
 * what make it easy to determine whether the output is correct in test suite. Feel free to
 * modify for any future test needs.
 *
 * @package    PhpMyAdmin
 * @subpackage Stubs
 */
namespace PMA\Test\Stubs;

use PMA_Header;
use PMA_Message;

require_once 'libraries/Response.class.php';
require_once 'libraries/Header.class.php';

class PMA_Response
{
    /**
     * PMA_Header instance
     *
     * @access private
     * @var PMA_Header
     */
    protected $header;

    /**
     * HTML data to be used in the response
     *
     * @access private
     * @var string
     */
    protected $htmlString;

    /**
     * An array of JSON key-value pairs
     * to be sent back for ajax requests
     *
     * @access private
     * @var array
     */
    protected $json;

    /**
     * Creates a new class instance
     */
    public function __construct()
    {
        $this->htmlString = '';
        $this->json = array();
        $this->header = new PMA_Header();
    }

    /**
     * Add HTML code to the response stub
     *
     * @param string $content A string to be appended to
     *                        the current output buffer
     *
     * @return void
     */
    public function addHTML($content)
    {
        if (is_array($content)) {
            foreach ($content as $msg) {
                $this->addHTML($msg);
            }
        } elseif ($content instanceof PMA_Message) {
            $this->htmlString .= $content->getDisplay();
        } else {
            $this->htmlString .= $content;
        }
    }

    /**
     * Add JSON code to the response stub
     *
     * @param mixed $json  Either a key (string) or an
     *                     array or key-value pairs
     * @param mixed $value Null, if passing an array in $json otherwise
     *                     it's a string value to the key
     *
     * @return void
     */
    public function addJSON($json, $value = null)
    {
        if (is_array($json)) {
            foreach ($json as $key => $value) {
                $this->addJSON($key, $value);
            }
        } else {
            if ($value instanceof PMA_Message) {
                $this->json[$json] = $value->getDisplay();
            } else {
                $this->json[$json] = $value;
            }
        }
    }

    /**
     * Return the final concatenated HTML string
     *
     * @return string
     */
    public function getHTMLResult()
    {
        return $this->htmlString;
    }

    /**
     * Return the final JSON array
     *
     * @return array
     */
    public function getJSONResult()
    {
        return $this->json;
    }

    /**
     * Current I choose to return PMA_Header object directly because
     * our test has nothing about the PMA_Scripts and PMA_Header class.
     *
     * @return PMA_Header
     */
    public function getHeader()
    {
        return $this->header;
    }
}
