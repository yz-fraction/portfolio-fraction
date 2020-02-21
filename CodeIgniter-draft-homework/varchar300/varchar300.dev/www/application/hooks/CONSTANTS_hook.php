<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Constant for subdomen
 */
function language()
{
	if( isset( $_SERVER['HTTP_HOST'] ) )
	{
		# Dinamic subdomain
		$URL		= explode('.', $_SERVER['HTTP_HOST']);
		$valid_url	= FALSE;
		
		if (count( $URL ) == 3 AND $URL[0] != 'www')
		{
			$valid_url = $URL[0];
		}
		if (count( $URL ) == 4 )
		{
			$valid_url = $URL[1];
		}
		unset( $URL );
		
		switch ( $valid_url )
		{
			case '':	define('LNG', 'ru');
						define('LANG', 'rus');
						define('LOCALE', 'ru-RU');
						define('LOCALE_ALT', 'ru-RU'); break;
			
			case 'uk':	define('LNG', 'uk');
						define('LANG', 'ukr');
						define('LOCALE', 'uk-UA');
						define('LOCALE_ALT', 'ru-UA'); break;  
			
			case 'en':	define('LNG', 'en');
						define('LANG', 'eng');
						define('LOCALE', 'en-US');
						define('LOCALE_ALT', 'en-GB'); break;
			
			default:	define('LNG', 'ru');
						define('LANG', 'rus');
						define('LOCALE', 'ru-RU');
						define('LOCALE_ALT', 'ru-RU');
		}
	}
}

/* End of file CONSTANTS.php */
/* Location: ./application/hooks/CONSTANTS.php */