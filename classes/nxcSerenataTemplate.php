<?php
/**
 * @author VaL <vd@nxc.no>
 * @copyright Copyright (C) 2013 NXC AS
 * @license GNU GPL v2
 * @package nxc_serenata
 */

/**
 * Template object to produce eml file
 */
class nxcSerenataTemplate
{
    /**
     * @var (eZTemplate)
     */
    protected $TPL = false;

    /**
     * @var (array)
     */
    protected $VariableList = array();

    /**
     * @var (array)
     */
    protected $HeaderList = array();

    /**
     * @reimp
     */
    public function __construct( $name )
    {
        $this->setHeader( 'name', $name );
    }

    /**
     * @return (this)
     */
    public function setHeader( $name, $value )
    {
        $this->HeaderList[$name] = $value;

        return $this;
    }

    /**
     * @return (this)
     */
    public function set( $name, $value )
    {
        $this->VariableList[$name] = $value;

        return $this;
    }

    /**
     * Returns parsed eml file to be sent to @mail service
     *
     * @return (string)
     */
    public function getEML()
    {
        $tpl = eZTemplate::factory();
        foreach ( $this->HeaderList as $k => $h )
        {
            $tpl->setVariable( $k, $h );
        }

        $header = $tpl->fetch( 'design:serenata/eml/header.tpl' );

        $tpl = eZTemplate::factory();
        $tpl->setVariable( 'list', $this->VariableList );

        $body = $tpl->fetch( 'design:serenata/eml/body.tpl' );

        return $header . $body;
    }

    /**
     * Sends email to web service
     *
     * @return (void)
     * @note Exception unsafe
     */
    public function send( $to )
    {
        nxcSerenata::get()->send( $to, $this->getEML() );
    }
}
?>
