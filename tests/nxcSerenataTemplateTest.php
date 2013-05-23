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

    public function testSendConfirmationEML()
    {
        $t = new nxcSerenataTemplate( 'CONFIRMATION_DE' );
        $t->setHeader( 'user', 'SERDEMO' );
        $t->set( 'GUEST_LONG_TITLE', 'Dr. VaL' );
        $t->set( 'GUEST_LAST_NAME', 'VaL' );
        $t->set( 'ARRIVAL_DATE', '01-07-2013' );
        $t->set( 'arrival_date_long_format', '01-07-2013' );
        $t->set( 'DEPARTURE_DATE', '02-07-2013' );
        $t->set( 'departure_date_long_format', '02-07-2013' );
        $t->set( 'NO_OF_ADULTS', '1' );
        $t->set( 'NO_OF_CHILDREN', '0' );
        $t->set( 'ROOM_TYPE_DESCRIPTION', 'Super King Size Double' );
        $t->set( 'ROOM_RATE', '150.00' );
        $t->set( 'ROOM_REVENUE', '150' );
        $t->set( 'RESERVATION_CLERK', 'my Fidelio' );
        $t->set( 'RESV_NAME_ID', '1111' );
        $t->set( 'CONFIRMATION_NO', '2222' );

        $c = $t->send( 'vd@nxc.no' );
    }

}

?>
