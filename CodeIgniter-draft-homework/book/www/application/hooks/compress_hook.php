<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function compress()
{
	$CI		= & get_instance();
	
	$buffer	= $CI->output->get_output();
	
	$search = array('/\t/' ,
					'/\>[^\S ]+/s' , 
					'/[^\S ]+\</s' , 
					'/(\s)+/s' ,									# shorten multiple whitespace sequences
					'#(?://)?<!\[CDATA\[(.*?)(?://)?\]\]>#s'		# leave CDATA alone
	);
	$replace = array(' ' ,
					'>' ,
					'<' ,
					'\\1' ,
					"//&lt;![CDATA[\n".'\1'."\n//]]>"
	);
	
	//$buffer = preg_replace('/ +/' , ' ' , $buffer );
	//$buffer = str_replace( array( "\r\n", "\r", "\n", "\t" ) , '' , $buffer );
	
	$CI->output->set_output( $buffer );
	$CI->output->_display();
}

/* End of file compress.php */
/* Location: ./system/application/hools/compress.php */