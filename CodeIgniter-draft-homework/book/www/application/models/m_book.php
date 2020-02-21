<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_book extends CI_Model {
	
	/**
	* /book/12/
	*/
	public function show( $ID )
	{
		$result = $this->db->
						select('
								ID ,
								author ,
								title ,
								' )->
						from( 'book' )->
						where( array( 'ID' => $ID ) )->
						limit( 1 )->
						get()->
						result_array();
		
		$result = books_list( $result );
		
		if ( isset( $result[0]['ID'] ) )
		{
			return $result[0];
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// --------------------------------------------------------------------
	
	
	/**
	 * Get rubrics
	 */
	function get_rubrics( $book_ID )
	{
		return $this->db->
						select( '
								rubric.ID		AS rubric_ID ,
								rubric.rubric
								' )->
						from( 'rubriclink' )->
						join( 'rubric' ,		'rubric.ID	= rubriclink.rubric_ID' )->
						where( array( 'book_ID' => $book_ID ) )->
						get()->
						result_array();
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function last_ID()
	{
		$query = $this->db->
						select( 'ID' )->
						from( 'book' )->
						order_by( 'ID', 'DESC' )->
						limit( 1 );
		$result = $query->get()->result_array();
		
		
		if ( isset( $result[0]['ID'] ) )
		{
			return $result[0]['ID'];
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function exist( $book_ID )
	{
		$result = $this->db->
						select( 'ID' )->
						from( 'book' )->
						where( array( 'ID' => $book_ID ) )->
						limit( 1 )->
						get()->
						result_array();
		
		if ( isset( $result[0]['ID'] ) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

/* End of file m_book.php */
/* Location: ./application/models/m_book.php */