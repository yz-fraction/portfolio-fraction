<?php

# Namespaces.
use PayPal\Api\CreditCard;
use PayPal\Api\Address;

# Process.
$creditCard = CreditCard::get( $CC_ID , $apiContext ) ;
try {
	$creditCard->delete( $apiContext ) ;

} catch (\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL ;
	exit( 1 ) ;

}