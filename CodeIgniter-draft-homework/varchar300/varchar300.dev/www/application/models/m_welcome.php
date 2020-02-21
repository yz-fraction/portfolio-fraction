<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_welcome extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
		# Load Ion config
		$this->load->config('ion_auth', TRUE);
		
		# Initialize DB tables data
		$this->tables  = $this->config->item('tables', 'ion_auth');
	}
	
	
	function get_last_messages( $number )
	{
		$result_message = $this->db->
								select( 'id , date , message , user_id ' )->
								from( 'message' )->
								limit( PAGINATION_PER_PAGE , $number )->
								order_by( 'date' , 'DESC' )->
								get()->
								result_array();
		
		if ( isset( $result_message[0]['id'] ) )
		{
			foreach( $result_message as $key => $value )
			{
				$result = $this->db->
								select( 'user_id , name' )->
								from( $this->tables['meta'] )->
								where( 'user_id' , $result_message[$key]['user_id'] )->
								limit( 1 )->
								get()->
								result_array();
				
				$result_message[$key]['name'] 				= $result[0]['name'];
				$result_message[$key]['timestamp_rus']		= mysql_timestamp_to_human( $result_message[$key]['date'] );
				$result_message[$key]['timestamp_human']	= DB_timestamp_russification( $result_message[$key]['date'] );
			}
			
			return $result_message;
		}
		else
		{
			return FALSE;
		}
	}
}

/* End of file m_welcome.php */
/* Location: ./application/models/m_welcome.php */