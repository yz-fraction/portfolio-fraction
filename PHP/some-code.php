<?php
/**
 * Silence is golden.
 */


function put_sensitive_data( $sensitive_data ) {
	$e				= new Encryption( MCRYPT_BlOWFISH , MCRYPT_MODE_CBC ) ;
	$encryptedData	= $e->encrypt( $sensitive_data , SENSITIVE_KEY ) ;

	$encryptedData = base64_encode ( $encryptedData );

	return $encryptedData ;
}

function get_sensitive_data( $encryptedData ) {
	$encryptedData = base64_decode ( $encryptedData );

	$e2				= new Encryption( MCRYPT_BlOWFISH , MCRYPT_MODE_CBC ) ;
	$sensitive_data	= $e2->decrypt( $encryptedData , SENSITIVE_KEY ) ;

	return $sensitive_data ;
}


// ------------------------------------------------------------------------


/*
 * Format UK phone numbers correctly.
 *
 * use:		format_telfax2("0208-2733 272") will return 020 8273 3272 (complete with Skype-compatible link).
 * source:	http://james.cridland.net/code/format_uk_phonenumbers.html
 */
function format_phone_en( $number )
{
	return format_telfax2 ( $number , $fax = FALSE ) ;
}


// ------------------------------------------------------------------------


if( $data )
{
	# Include and generate receipt.
	ob_start();
	include 'views/pages/purchased/receipt.php' ;
	$content	= ob_get_contents();
	ob_end_clean();

	require_once 'lib/html2pdf_v4.03/html2pdf.class.php' ;
	$html2pdf	= new HTML2PDF( 'P' , 'A4' , 'en' ) ;
	$html2pdf->WriteHTML( $content ) ;
	$html2pdf->Output( 'receipt.pdf' ) ;
}


// ------------------------------------------------------------------------


function crdmn__jsonRemoveUnicodeSequences($struct) {
   return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));
}


$options	= array(
	'options'	=> array( 
		'default'	=> 5 ,
		'min_range'	=> 0 , 
		'max_range'	=> 9
		)
	) ;
$GET_value		= filter_input( INPUT_GET , $GET_key , FILTER_VALIDATE_INT , $options ) ;


$URI_segments	= explode( '/' , $_SERVER[ 'REQUEST_URI' ] ) ;


echo (new \DateTime())->format('Y-m-d H:i:s');


$file_path	= 'file.php' ;
if( is_file( $file_path ) AND file_exists( $file_path ) AND is_readable( $file_path ) )
{
	ob_start();
	include( $file_path );
	$content	= ob_get_clean();
	ob_end_clean();
}


$delimiter	= $i % 2 === 0 ? '*' : '=' ;
$delimiter	= !($i & 1) ? ', ' : '' ;


$formatter	= new NumberFormatter( 'en_GB' ,  NumberFormatter::CURRENCY ) ;
$price		= $formatter->formatCurrency( '12345.67' , 'EUR' ) ;


$remove_first_two_symbols   = substr( $some_string , 2 );
$remove_last_two_symbols    = substr( $some_string , 0 , -2 ) ;


