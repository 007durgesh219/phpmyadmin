
<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for PMA_checkParameters from common.lib.php
 *
 * @package phpMyAdmin-test
 * @version $Id: PMA_checkParameters_test.php
 * @group common.lib-tests
 */

/*
 * Include to test.
 */
require_once 'libraries/common.lib.php';

/**
 * Test for PMA_extractFieldSpec function.
 */
class PMA_extractFieldSpec_test extends PHPUnit_Extensions_OutputTestCase
{
    /**
     * Test case for parsing SHOW COLUNS output
     *
     * @dataProvider provider
     */
    public function testParsing($in, $out)
    {
        $this->assertEquals($out, PMA_extractFieldSpec($in));
    }

    /**
     * Data provider
     */
    public function provider()
    {
        return array(
            array(
                "SET('a','b')",
                array(
                    'type' => 'set',
                    'print_type' => "set('a', 'b')",
                    'binary' => false,
                    'unsigned' => false,
                    'zerofill' => false,
                    'spec_in_brackets' => "'a','b'",
                    'enum_set_values' => array('a', 'b'),
                    ),
                ),
            array(
                "SET('\'a','b')",
                array(
                    'type' => 'set',
                    'print_type' => "set('\'a', 'b')",
                    'binary' => false,
                    'unsigned' => false,
                    'zerofill' => false,
                    'spec_in_brackets' => "'\'a','b'",
                    'enum_set_values' => array("'a", 'b'),
                    ),
                ),
            array(
                "INT UNSIGNED zerofill",
                array(
                    'type' => 'int unsigned zerofill',
                    'print_type' => 'int',
                    'binary' => false,
                    'unsigned' => true,
                    'zerofill' => true,
                    'spec_in_brackets' => '',
                    'enum_set_values' => array(),
                    ),
                ),
            array(
                "VARCHAR(255)",
                array(
                    'type' => 'varchar',
                    'print_type' => 'varchar(255)',
                    'binary' => false,
                    'unsigned' => false,
                    'zerofill' => false,
                    'spec_in_brackets' => '255',
                    'enum_set_values' => array(),
                    ),
                ),
            array(
                "VARBINARY(255)",
                array(
                    'type' => 'varbinary',
                    'print_type' => 'varbinary(255)',
                    'binary' => false,
                    'unsigned' => false,
                    'zerofill' => false,
                    'spec_in_brackets' => '255',
                    'enum_set_values' => array(),
                    ),
                ),
            );
    }
}
