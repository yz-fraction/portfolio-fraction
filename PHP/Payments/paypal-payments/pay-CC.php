<?php

# Namespaces.
use PayPal\Api\CreditCard;
use PayPal\Api\CreditCardToken;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;


$creditCardToken = new CreditCardToken();
$creditCardToken->setCredit_card_id( $CC_ID );

$fundingInstrument = new FundingInstrument();
$fundingInstrument->setCredit_card_token($creditCardToken);

$payer = new Payer();
$payer->setPayment_method("credit_card");
$payer->setFunding_instruments(array($fundingInstrument));

$amount = new Amount();
$amount->setCurrency( $setCurrency );
$amount->setTotal( $setTotal );

$transaction = new Transaction();
$transaction->setAmount($amount);
$transaction->setDescription("creating a payment with saved credit card");

$payment = new Payment();
$payment->setIntent("sale");
$payment->setPayer($payer);
$payment->setTransactions(array($transaction));



# Create Payment.
# Create a payment by posting to the APIService
# using a valid ApiContext (See bootstrap.php for more on `ApiContext`)
# The return object contains the status;
try {
	$payment->create($apiContext);

} catch (\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}


if( ! empty ( $payment ) )
{
	$payment	= $payment->toArray() ;
	$payment_ID	= $payment[ 'id' ] ;
}
else
{

}