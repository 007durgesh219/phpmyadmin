<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Tests for PMA\libraries\navigation\nodes\NodeColumn class
 *
 * @package PhpMyAdmin-test
 */

use PMA\libraries\navigation\NodeFactory;
use PMA\libraries\Theme;

require_once 'libraries/navigation/NodeFactory.php';


require_once 'libraries/php-gettext/gettext.inc';

/**
 * Tests for PMA\libraries\navigation\nodes\NodeColumn class
 *
 * @package PhpMyAdmin-test
 */
class Node_Column_Test extends PHPUnit_Framework_TestCase
{
    /**
     * SetUp for test cases
     *
     * @return void
     */
    public function setup()
    {
        $GLOBALS['server'] = 0;
        $_SESSION['PMA_Theme'] = Theme::load('./themes/pmahomme');
    }

    /**
     * Test for PMA\libraries\navigation\NodeFactory::getInstance
     *
     * @return void
     */
    public function testConstructor()
    {
        $parent = NodeFactory::getInstance('NodeColumn');
        $this->assertArrayHasKey(
            'text',
            $parent->links
        );
        $this->assertContains(
            'tbl_structure.php',
            $parent->links['text']
        );
    }
}
