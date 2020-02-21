<?php

# Define. Buyer.
$buyer_order_ID	= '23TG1KT484S146J52160RT' ;


#
# Create an Order.
#
if( empty( $buyer_order_ID ) ) :
$merchant	= Balanced\Customer::get( '/customers/'.$buyer->id.'' ) ;
$order		= $merchant->orders->create() ;
endif ;

#
# Fetch an Order.
#
if( ! empty( $buyer_order_ID ) ) :
$order		= Balanced\Order::get( '/orders/'.$buyer_order_ID.'' ) ;
endif ;

#
# Update an Order.
#
if( ! empty( $buyer_order_ID ) ) :
$order		= Balanced\Order::get( '/orders/'.$buyer_order_ID.'' ) ;
$order->description	= 'Description: @' . date( 'H:i:s, d.m.Y' ) ;
$order->meta		= array(
    'anykey'		=> 'valuegoeshere' ,
    'product.id'	=> '1234567890' ,
) ;
$order->save();
endif ;

#
# Debit a buyer.
#
$card		= Balanced\Card::get( '/cards/'.$buyer_CC_ID.'' ) ;
$order		= Balanced\Order::get( '/orders/'.$buyer_order_ID.'' ) ;
$order->debitFrom(
    $card ,
    1
);
