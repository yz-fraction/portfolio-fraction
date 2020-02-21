<?php
Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
Header("Cache-Control: no-cache, must-revalidate");
Header("Pragma: no-cache");
Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");


require 'lessphp/lessc.inc.php';
	$less = new lessc( 'LESS.less' );
	file_put_contents( 'LESS.css' , $less->parse() );
	
ob_start("compress");
	function compress($buffer)
	{
		/* remove comments */
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		
		/* remove tabs, spaces, newlines, etc. */
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		
		file_put_contents('compressed.css', $buffer);
		
		return $buffer;
	}
	
	include_once('bootstrap/bootstrap.css');
	include_once('bootstrap/bootstrap-responsive.css');
	include_once('LESS.css');
	

ob_end_flush();
?>
