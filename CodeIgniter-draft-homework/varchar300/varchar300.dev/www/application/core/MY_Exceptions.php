<?php
class MY_Exceptions extends CI_Exceptions {
	
	/**
	 * Unknown error
	 *
	 * @access	private
	 * @param	string	the page
	 * @param 	bool	log error yes/no
	 * @return	string
	 */
	function unknown_error( $page = '' , $log_error = TRUE )
	{
		$heading = "Unknown error";
		$message = "Unknown error.";

		// By default we log this, but allow a dev to skip it
		if ( $log_error )
		{
			log_message( 'programmer' , 'Unknown error --> Class:'.__CLASS__.' (method: '.__METHOD__.')' );
		}

		echo $this->show_error( $heading , $message , 'error_general');
		exit;
	}

	// --------------------------------------------------------------------

}


?>