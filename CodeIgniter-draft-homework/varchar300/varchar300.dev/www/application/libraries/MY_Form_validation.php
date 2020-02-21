<?php
class MY_Form_validation extends CI_Form_validation {
	
	protected $_error_prefix		= '<p><span class="form_show_error label label-important">';
	protected $_error_suffix		= '</span></p>';
	

	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function rating( $str )
	{
		return ( preg_match( '\-?\d+(\.\d{0,})?' , $str ) ) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------
	

	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function alpha_rus( $str )
	{
		return ( preg_match( '/[^(Її)|(\x7F-\xFF)]/' , $str ) ) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	
	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function alpha_dash( $str )
	{
		//return filter_var( $str , FILTER_SANITIZE_STRING , FILTER_FLAG_STRIP_LOW );
		//return filter_var( $str ,
		//				    FILTER_VALIDATE_REGEXP,
		//					array(
		//						  'options'	=>	array( 'regexp'	=>	'/[^(\w)|(\x7F-\xFF)|(\s)]/' )
		//						  )
		//				  );
		return ( preg_match( '/[^(\w)|(\x7F-\xFF)|(\s)]/' , $str ) ) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	
	/**
	 * Alpha-numeric-punctuation
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function alpha_punctuation( $str )
	{
		return ( preg_match( '/[^(\w)|(\x7F-\xFF)|(,.:;!?)|(\s)]/' , $str ) ) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	
}
?>