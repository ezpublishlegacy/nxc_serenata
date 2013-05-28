NXC Serenata eZ Publish extension
---------------------------------

http://www.serenata.com/main/products/mail/
With Serenata @mail, hotels can instantly e-mail confirmations, pre-arrival emails and upgrade opportunities from their PMS, CRS, Sales & Catering or SPA system.

This is a simple tool to send configuration files to this @mail web service.

    $t = new nxcSerenataTemplate( 'CONFIRMATION' );
    $t->setHeader( 'user', 'SUPER' );
    $t->set( 'Activity', 'Y' );
    $t->set( 'TOTAL_COST_OF_STAY', '888' );

    $config = $t->getEML();
    nxcSerenata::get()->send( 'user@email.com', $config );
    // or
    $t->send( 'user@mail.com' );
