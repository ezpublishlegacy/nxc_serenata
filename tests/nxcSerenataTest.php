<?php
/**
 * @author vd
 * @copyright Copyright (C) 2013 NXC AS.
 * @license GNU GPL v2
 * @package nxc_serenata
 */

class nxcSerenataTest extends PHPUnit_Framework_TestCase
{
    public function testSendBody()
    {
        $s = nxcSerenata::get();
        $c = file_get_contents( $_SERVER['PWD'] . '/extension/nxc_serenata/tests/files/body.eml' );
        $s->send( 'vd@nxc.no', $c );
    }

    public function testSendAttachment()
    {
        $s = nxcSerenata::get();
        $s->sendFile( 'vd@nxc.no', $_SERVER['PWD'] . '/extension/nxc_serenata/tests/files/attachment.eml' );
    }

}

?>
