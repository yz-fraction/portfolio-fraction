<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_rubric extends CI_Model {
	
	/**
	* /rubric/12/
	*/
	public function show( $ID )
	{
		$result = $this->db->
						select('
								book.ID ,
								book.author ,
								book.title ,
								
								rubric.rubric
								' )->
						from( 'book' )->
						join( 'rubriclink' ,	'book.ID	= rubriclink.book_ID' )->
						join( 'rubric' ,		'rubric.ID	= rubriclink.rubric_ID' )->
						where( array( 'rubric.ID' => $ID ) )->
						get()->
						result_array();
		$result = books_list( $result );
		
		if ( isset( $result[0]['ID'] ) )
		{
			return $result;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// --------------------------------------------------------------------
	
	
	/**
	 * Get checked rubrics
	 */
	function checked_rubrics( $book_ID )
	{
		$array_tags_current = $this->db->
									select( 'rubric.ID' )->
									from( 'rubriclink' )->
									join( 'rubric' ,	'rubric.ID	= rubriclink.rubric_ID' )->
									where( array( 'book_ID' => $book_ID ) )->
									get()->
									result_array();
		$array_tags			= $this->db->
									select('
											ID ,
											rubric
											')->
									from( 'rubric' )->
									get()->
									result_array();
		
		return add_checked_tags( $array_tags , $array_tags_current );
	}
	
	
	// --------------------------------------------------------------------
	
	
	function counter( $ID )
	{
		return $this->db->
					select('ID')->
					from( 'rubriclink' )->
					where( array( 'rubric_ID' => $ID ) )->
					get()->
					num_rows();
			
	}
}

/* End of file m_rubric.php */
/* Location: ./application/models/m_rubric.php */