<?php

# Namespaces.
use PayPal\Api\CreditCard;

$CC_ID	= 'CARD-WFTG1KTDW4S146J52OK0RI';
if( ! empty( $CC_ID ) AND ! empty( $apiContext ) )
{
	# Retrieve card.
	# (See bootstrap.php for more on `ApiContext`)
	try {
		$card = CreditCard::get( $CC_ID, $apiContext ) ;
	} catch ( \PPConnectionException $ex ) {
		echo 0;
		exit(1);
	}
}


