<?php
/**
 * @author VaL <vd@nxc.no>
 * @copyright Copyright (C) 2013 NXC AS
 * @license GNU GPL v2
 * @package nxc_serenata
 */

/**
 * Transport object to send emails to @mail service of Serenata
 */
class nxcSerenata
{
    /**
     * @var (string)
     */
    protected $Host = false;

    /**
     * @var (string)
     */
    protected $User = false;

    /**
     * @var (string)
     */
    protected $Password = false;

    /**
     * @var (string)
     */
    protected $FromEmail = false;

    /**
     * @reimp
     */
    public function __construct( $host, $user, $password, $from )
    {
        $this->Host = $host;
        $this->User = $user;
        $this->Password = $password;
        $this->FromEmail = $from;
    }

    /**
     * @return (__CLASS__)
     */
    public static function get()
    {
        $ini = eZINI::instance( 'serenata.ini' );
        $host = $ini->variable( 'MailSettings', 'Host' );
        $user = $ini->variable( 'MailSettings', 'User' );
        $password = $ini->variable( 'MailSettings', 'Password' );
        $from = $ini->variable( 'MailSettings', 'FromEmail' );

        return new self( $host, $user, $password, $from );
    }

    /**
     * Sends email to @mail service
     *
     * @param (string) Email
     * @param (string) Template config
     *
     * @return (void)
     * @note Exception unsafe
     */
    public function send( $to, $content, $log = true )
    {
        $mail = $this->getMail( $to, __METHOD__ );
        $mail->body = new ezcMailText( $content );

        if ( $log )
        {
            eZLog::write( "\n" . $content, 'serenata.log' );
        }

        $this->getTransport()->send( $mail );
    }

    /**
     * Sends an attachment to @mail service
     *
     * @param (string) Email
     * @param (string) Path to config file
     *
     * @return (void)
     * @note Exception unsafe
     */
    public function sendFile( $to, $filename )
    {
        $mail = $this->getMail( $to, __METHOD__ );
        // Create a file attachment to be added to the mail
        $mail->body = new ezcMailMultipartMixed( new ezcMailFile( $filename ) );

        $this->getTransport()->send( $mail );
    }

    /**
     * @return (ezcMailSmtpTransport)
     */
    protected function getTransport()
    {
        $transport = new ezcMailSmtpTransport( $this->Host, $this->User, $this->Password );

        // The option can also be specified via the option property:
        $transport->options->preferredAuthMethod = ezcMailSmtpTransport::AUTH_LOGIN;

        return $transport;
    }

    /**
     * @return (ezcMail)
     */
    protected function getMail( $to, $subject = false )
    {
        $mail = new ezcMail();

        // Specify the subject of the mail
        // Will be hidden in result email
        $mail->subject = $subject ? $subject : '[NXC Serenata] Mail service';

        // Specify the "from" mail address
        $mail->from = new ezcMailAddress( $this->FromEmail );

        // Add one "to" mail address (multiple can be added)
        $mail->addTo( new ezcMailAddress( $to ) );

        return $mail;
    }

}
?>
