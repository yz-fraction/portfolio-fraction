<?php

# Namespaces.
use PayPal\Api\CreditCard;
use PayPal\Api\Address;

# Variables.
$CC_ID				= FALSE ;
$CC_number			= FALSE ;

# Billing address.
$addr = new Address();
$addr->setLine1( $setLine1 );
$addr->setLine2( $setLine2 );
$addr->setCity( $setCity );
$addr->setState( $setState );
$addr->setPostalCode( $setPostalCode );

# CC data.
$card = new CreditCard();
$card->setType( $setType );
$card->setNumber( $setNumber );
$card->setNumber( $setNumber );
$card->setExpire_month( $setExpire_month );
$card->setExpire_year( $setExpire_year );
$card->setCvv2( $setCvv2 );
$card->setFirst_name( $setFirst_name );
$card->setLast_name( $setLast_name );

# Save card.
# Creates the credit card as a resource
# in the PayPal vault. The response contains
# an 'id' that you can use to refer to it
# in the future payments.
# (See bootstrap.php for more on `ApiContext`)
try {
	$card->create( $apiContext ) ;
} catch ( \PPConnectionException $ex ) {
	echo "Exception:" . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}

if( ! empty ( $card->id ) )
{
	$CC_ID		= $card->getId() ;
	$CC_number	= $card->number ;
}

?>


<?php
$CC_ID	= $card->id ;
include_once 'get-CC.php';
exit;