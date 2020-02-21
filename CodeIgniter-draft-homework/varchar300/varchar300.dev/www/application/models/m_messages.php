<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_messages extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function show( $message_id )
	{
		$result = $this->db->
						select('date ,
								message ,
								user_id' )->
						from('message')->
						where(array( 'id' => $message_id ) )->
						limit( 1 )->
						get()->
						result_array();
		
		if ( isset( $result[0]['message'] ) )
		{
			return $result[0];
		}
		else
		{
			return FALSE;
		}
	}
	
	
	function add( $data )
	{
		$user				= $this->ion_auth->user()->row();
		$data['user_id']	= $user->id;
		
		unset( $data['messages_add_submit'] );
		unset( $data['messages_add_form'] );
		
		$result = $this->db->insert('message', $data);
		
		return ( $result ) ? TRUE : FALSE ;
	}
	
	
	function delete( $message_id )
	{
		$result = $this->db->delete('message' , array( 'id' => $message_id ) );
		
		return ( $result ) ? TRUE : FALSE ;
	}
	
	
	function delete_user_messages( $user_id )
	{
		$result = $this->db->delete('message' , array( 'id' => $user_id ) );
		
		return ( $result ) ? TRUE : FALSE ;
	}
}