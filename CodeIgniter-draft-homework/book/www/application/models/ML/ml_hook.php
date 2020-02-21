<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ML_hook extends CI_Model {
	
	/**
	* /book/12/
	*/
	public function title_book( $ID )
	{
		$result = $this->db->
						select('
								title ,
								' )->
						from( 'book' )->
						where( array( 'ID' => $ID ) )->
						limit( 1 )->
						get()->
						result_array();
		
		if ( isset( $result[0]['title'] ) )
		{
			return $result[0]['title'];
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	* /welcome/page/2/
	*/
	public function title_pagination( $number )
	{
		$number = $number / PAGINATION_PER_PAGE + 1;
		return $number.' '.lang('page').'. '.lang('Books');
		
	}
	
	/**
	* /welcome/page/2/
	*/
	public function rubric_pagination( $ID )
	{
		$result = $this->db->
						select('
								rubric ,
								' )->
						from( 'rubric' )->
						where( array( 'ID' => $ID ) )->
						limit( 1 )->
						get()->
						result_array();
		
		if ( isset( $result[0]['rubric'] ) )
		{
			return $result[0]['rubric'];
		}
		else
		{
			return FALSE;
		}
		
	}
}

/* End of file ml_hook.php */
/* Location: ./application/models/ml_hook.php */