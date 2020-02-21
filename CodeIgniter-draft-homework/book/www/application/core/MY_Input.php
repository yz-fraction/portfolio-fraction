<?php
class MY_Input extends CI_Input {
	
	/**
	 * Is AJAX-form Request?
	 *
	 * Test to see if a request contains the HTTP_X_REQUESTED_WITH header and
	 * $_SERVER['CONTENT_TYPE'] contains the 'application/x-www-form-urlencoded; charset=UTF-8'
	 *
	 * @return 	boolean
	 */
	public function is_ajax_request_form()
	{
		return ( 	(	isset(	$_SERVER['CONTENT_TYPE'] ) AND
								$_SERVER['CONTENT_TYPE'] == 'application/x-www-form-urlencoded; charset=UTF-8' ) &&
					$this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest' ) ? TRUE : FALSE;
		
	}

	// --------------------------------------------------------------------

}


?>