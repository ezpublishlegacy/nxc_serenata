<?php
/**
 * @author vd
 * @copyright Copyright (C) 2013 NXC AS.
 * @license GNU GPL v2
 * @package nxc_serenata
 */

class nxcSerenataTemplateTest extends PHPUnit_Framework_TestCase
{
    public function testEML()
    {
        $t = new nxcSerenataTemplate( 'CONFIRMATION_DE' );
        $t->setHeader( 'user', 'SUPER' );
        $t->set( 'Activity_YN', 'Y' );
        $t->set( 'TOTAL_COST_OF_STAY', '888' );

        $c = $t->getEML();
        $e = file_get_contents( $_SERVER['PWD'] . '/extension/nxc_serenata/tests/files/s.eml' );
        $this->assertEquals( $e, $c );
    }
}

?>
