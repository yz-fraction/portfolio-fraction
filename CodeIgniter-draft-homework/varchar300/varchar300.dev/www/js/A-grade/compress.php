<?php
Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
Header("Cache-Control: no-cache, must-revalidate");
Header("Pragma: no-cache");
Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");

ob_start("compress");

	function compress($buffer)
	{
		/* remove comments */
		//$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!' , '' , $buffer );
		
		/* remove tabs, spaces, newlines, etc. */
		//$buffer = str_replace(	array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ') ,
		//						'' ,
		//						$buffer );
		
		file_put_contents('compressed.js' , $buffer );
		
		return $buffer;
	}
	
	include('../_log.js');
	include('../main.js');
	
	$file_list = glob("bootstrap/*.js");
		foreach($file_list as $key => $value)
		{
			include($value);
		}
	
	echo '$(document).ready(function () {';
		include('../main.js');
		
		$file_list = glob("JS_*.js");
		foreach($file_list as $key => $value)
		{
			include($value);
		}
	echo '});';
	
ob_end_flush();
?>