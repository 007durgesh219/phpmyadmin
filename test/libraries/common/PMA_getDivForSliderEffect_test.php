<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for PMA_getDivForSliderEffect from common.lib.php
 *
 * @package PhpMyAdmin-test
 * @group common.lib-tests
 */

/*
 * Include to test.
 */
require_once 'libraries/common.lib.php';

class PMA_GetDivForSliderEffectTest extends PHPUnit_Framework_TestCase
{
    function testGetDivForSliderEffectTest()
    {
        global $cfg;
        $cfg['InitialSlidersState'] = 'undefined';

        $id = "test_id";
        $message = "test_message";

        $this->expectOutputString('<div id="' . $id . '"  class="pma_auto_slider" title="' . htmlspecialchars($message) . '">' . "\n" . '    ');
        PMA_getDivForSliderEffect($id, $message);
    }

    function testGetDivForSliderEffectTestClosed()
    {
        global $cfg;
        $cfg['InitialSlidersState'] = 'closed';

        $id = "test_id";
        $message = "test_message";

        $this->expectOutputString('<div id="' . $id . '"  style="display: none; overflow:auto;" class="pma_auto_slider" title="' . htmlspecialchars($message) . '">' . "\n" . '    ');
        PMA_getDivForSliderEffect($id, $message);
    }

    function testGetDivForSliderEffectTestDisabled()
    {
        global $cfg;
        $cfg['InitialSlidersState'] = 'disabled';

        $id = "test_id";
        $message = "test_message";

        $this->expectOutputString('<div id="' . $id . '">');
        PMA_getDivForSliderEffect($id, $message);
    }
}