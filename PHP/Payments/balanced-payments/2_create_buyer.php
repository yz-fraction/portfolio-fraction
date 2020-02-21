<?php


#
# Get from DB.
#
$buyer					= new stdClass() ;
$buyer->id				= 'CUp21op9thkDcBZoLgnSZBm' ;


$buyer_bank_account		= new stdClass() ;
$buyer_bank_account->id	= 'BA4rn4BqBUZcWfKBLeXNq7za' ;

$verification			= new stdClass() ;
$verification->id		= '13TG1KTDW4S146J52160RI' ;


$buyer_CC_ID			= '13TG1KTDW4S146J52160RI' ; # Yandex.


#
# Create Merchant.
#
$buyer					= Balanced\Customer::get( '/customers/'.$buyer->id.'' ) ;
if( empty( $buyer->id ) ) :
$marketplace			= Balanced\Marketplace::mine();
$buyer				= $marketplace->customers->create( array(
	'address'	=> array(
	   'postal_code'	=> '67890' ,
	) ,
	'dob_month'	=> '10' ,
	'dob_year'	=> '2000' ,
	'name'		=> 'Jane Buyer' ,
	) ) ;
echo '<hr>' ;
echo '<pre>$buyer->id: ' ; print_r( $buyer->id ) ;
endif ;



#
# Create a Bank Account.
#
$buyer_bank_account	= Balanced\BankAccount::get( '/bank_accounts/'.$buyer_bank_account->id.'') ;
if( empty( $buyer_bank_account->id ) ) :
$marketplace			= \Balanced\Marketplace::mine() ;
$buyer_bank_account	= $marketplace->bank_accounts->create( array(
    'account_number'	=> '0630000002' ,
    'account_type'		=> 'checking' ,
    'name'				=> 'Jane Buyer' ,
    'routing_number'	=> '044000011' ,
) ) ;
$buyer_bank_account	= $buyer_bank_account->save();
endif ;



#
# Associate a Bank Account to a Customer.
#
if(
		! empty( $buyer->id )
	AND ! empty( $buyer_bank_account->id )
	) :
$bank_account			= Balanced\BankAccount::get( '/bank_accounts/'.$buyer_bank_account->id.'' ) ;
$associateToCustomer	= $bank_account->associateToCustomer( '/customers/'.$buyer->id.'' ) ;
endif ;


#
# Bank Account Verification.
#
if(
		! empty( $buyer->id )
	AND ! empty( $buyer_bank_account->id )
	AND empty( $verification->id )
	) :
$bank_account				= Balanced\BankAccount::get( '/bank_accounts/'.$buyer_bank_account->id.'' ) ;
$verification				= $bank_account->verify() ;
if( $verification )
{
	$verification_id		= $verification->id ;
	$verification_status	= $verification->verification_status ;
}
endif ;

if( ! empty( $verification->id ) ) :
	$verification	= Balanced\BankAccountVerification::get( '/verifications/'.$verification->id.'' ) ;

	if( $verification->verification_status == 'pending' ) :
		$verification = Balanced\BankAccountVerification::get( '/verifications/'.$verification->id.'' ) ;
		$verification->amount_1 = 1 ;
		$verification->amount_2 = 1 ;
		$verification->save() ;

		if( $verification->verification_status == 'succeeded' ) :

			echo '<pre>$verification succeeded: ' ;

		endif ;
	endif ;
endif ;


#
# Create CC.
#
if( empty( $buyer_CC_ID ) ) :
$buyer_CC_create	= Balanced\Marketplace::mine()->cards->create(array(
    'number'			=> '2111111111111111' ,
    'expiration_month'	=> '10' ,
    'expiration_year'	=> '2030' ,
    'cvv'				=> '123' ,
));
endif ;

#
# Deleting a Card.
#
if( empty( $buyer_CC_ID ) AND 1 == 2 ) :
$card	= Balanced\Card::get( '/cards/'.$buyer_CC_ID.'' ) ;
$card->unstore();
endif ;

#
# Associate card to Customer.
#
$buyer_CC_get		= Balanced\Card::get( '/cards/'.$buyer_CC_ID.'' ) ;
$buyer_CC_associate	= '' ;
try
{
	$buyer_CC_associate	= $buyer_CC_get->associateToCustomer( '/customers/'.$buyer->id.'' ) ;
	echo 'Card Associated Now.<br>' ;
}
catch ( Balanced\Errors\CardAlreadyAssociated $e )
{
	echo 'Card Already Associated<br>' ;
}

#
# Charge a Card.
#
$amount		= 5;
$amount		= $amount * 100 ;
$card		= Balanced\Card::get( '/cards/'.$buyer_CC_ID.'' ) ;
$card->debits->create( array(
    'amount'					=> $amount ,
    'appears_on_statement_as'	=> ''.$amount.' dollar more.',
    'description'				=> 'Descriptive for the debit @ dashboard (' . date( 'H:i:s, d.m.Y' ) . ')' ,
//    'order' => $order_href
));