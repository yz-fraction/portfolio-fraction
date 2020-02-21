<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_welcome extends CI_Model {
	
	function get_last_books( $number )
	{
		$result = $this->db->
							select( '
									ID ,
									author ,
									title
									' )->
							from( 'book' )->
							limit( PAGINATION_PER_PAGE , $number )->
							order_by( 'ID' , 'DESC' )->
							get()->
							result_array();
		
		return books_list( $result );
	}
	
	
	// --------------------------------------------------------------------
	
	
	function get_rubrics()
	{
		$result = $this->db->
							select( '
									ID ,
									rubric ,
									' )->
							from( 'rubric' )->
							order_by( 'rubric' , 'DESC' )->
							get()->
							result_array();
		
		return rubrics_list( $result );
	}
}

/* End of file m_welcome.php */
/* Location: ./application/models/m_welcome.php */