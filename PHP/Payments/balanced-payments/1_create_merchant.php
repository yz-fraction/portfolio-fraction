<?php


#
# Get from DB.
#
$merchant					= new stdClass() ;
$merchant->id				= '13TG1KTD34S146J521R0RI' ;


$merchant_bank_account		= new stdClass() ;
$merchant_bank_account->id	= 'K3TG1KSDW4S146J52160RI' ;

$verification				= new stdClass() ;
$verification->id			= 'F3TG1KTDW4S146J52160RI' ;


$merchant_CC_ID				= '13TG1KTDW4S146J52160RI' ;


#
# Create Merchant.
#
$merchant				= Balanced\Customer::get( '/customers/'.$merchant->id.'' ) ;
if( isset( $merchant->id ) AND $merchant->id == '' ) :
$marketplace			= Balanced\Marketplace::mine();
$merchant				= $marketplace->customers->create( array(
	'address'	=> array(
	   'postal_code'	=> '12345' ,
	) ,
	'dob_month'	=> '1' ,
	'dob_year'	=> '1900' ,
	'name'		=> 'John Merchant' ,
	) ) ;
endif ;



#
# Create a Bank Account.
#
$merchant_bank_account	= Balanced\BankAccount::get( '/bank_accounts/'.$merchant_bank_account->id.'') ;
if( isset( $merchant_bank_account->id ) AND $merchant_bank_account->id == '' ) :
$marketplace			= \Balanced\Marketplace::mine() ;
$merchant_bank_account	= $marketplace->bank_accounts->create( array(
    'account_number'	=> '6600000401' ,
    'account_type'		=> 'checking' ,
    'name'				=> 'John Merchant' ,
    'routing_number'	=> '754000358' ,
) ) ;
$merchant_bank_account	= $merchant_bank_account->save();
endif ;



#
# Associate a Bank Account to a Customer.
#
if(
		! empty( $merchant->id )
	AND ! empty( $merchant_bank_account->id )
	) :
$bank_account			= Balanced\BankAccount::get( '/bank_accounts/'.$merchant_bank_account->id.'' ) ;
$associateToCustomer	= $bank_account->associateToCustomer( '/customers/'.$merchant->id.'' ) ;
endif ;



#
# Bank Account Verification.
#
if(
		! empty( $merchant->id )
	AND ! empty( $merchant_bank_account->id )
	AND empty( $verification->id )
	) :
$bank_account				= Balanced\BankAccount::get( '/bank_accounts/'.$merchant_bank_account->id.'' ) ;
$verification				= $bank_account->verify() ;
if( $verification )
{
	$verification_id		= $verification->id ;
	$verification_status	= $verification->verification_status ;
}
endif ;

if( ! empty( $verification->id ) ) :
$verification	= Balanced\BankAccountVerification::get( '/verifications/'.$verification->id.'' ) ;
endif ;


#
# Create CC.
#
if( empty( $merchant_CC_ID ) ) :
$merchant_CC_create	= Balanced\Marketplace::mine()->cards->create(array(
    'cvv'				=> '123' ,
    'expiration_month'	=> '1' ,
    'expiration_year'	=> '2020' ,
    'number'			=> '8308308308308300' ,
));
endif ;

#
# Deleting a Card.
#
if( empty( $merchant_CC_ID ) AND 1 == 2 ) :
$card	= Balanced\Card::get( '/cards/'.$merchant_CC_ID.'' ) ;
$card->unstore();
endif ;

#
# Associate card to Customer.
#
$merchant_CC_get		= Balanced\Card::get( '/cards/'.$merchant_CC_ID.'' ) ;
$merchant_CC_associate	= '' ;
try
{
	$merchant_CC_associate	= $merchant_CC_get->associateToCustomer( '/customers/'.$merchant->id.'' ) ;
	echo 'Card Associated Now.<br>' ;
}
catch ( Balanced\Errors\CardAlreadyAssociated $e )
{
	echo 'Card Already Associated<br>' ;
}