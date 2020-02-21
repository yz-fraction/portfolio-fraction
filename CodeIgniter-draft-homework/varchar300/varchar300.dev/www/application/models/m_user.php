<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
		$this->load->config('ion_auth', TRUE);
		
		# Initialize db tables data
		$this->tables  = $this->config->item('tables', 'ion_auth');
    }
	
	
	function show_dossier( $user_id )
    {
		$result = $this->db->
						select('
								user_id ,
							    name ,
								surname ,
								sex ,
								age ,
								city ,
								country ,
								socium ,
								
								country.ru	AS country ,
								country.id	AS country_id
								')->
						from( $this->tables['meta'] )->
						join( 'country' ,		$this->tables['meta'].'.country		= country.id', 'left' )->
						where( array( 'user_id'	=> $user_id ) )->
						limit( 1 )->
						get()->
						result_array();
		
		if ( isset( $result[0]['name'] ) )
		{
			return $result;
		}
		else
		{
			return FALSE;
		}
	}
	
	function show_messages( $user_id )
	{
		$result = $this->db->
						select('
								date,
								message
								' )->
						from( 'message' )->
						where( array( 'user_id' => $user_id ) )->
						order_by( 'date' , 'ASC' )->
						get()->
						result_array();
		
		if ( isset( $result[0]['message'] ) )
		{
			return $result;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_users( $to  = NULL )
    {
		$result = $this->db->
							select('
									user_id ,
									name ,
									city
									')->
							from( $this->tables['users'] )->
							join( $this->tables['meta'] , 'users.id = meta.user_id' )->
							limit( PAGINATION_PER_PAGE , $to )->
							order_by( 'user_id' , 'DESC' )->
							get()->
							result_array();
		
		if ( isset( $result[0]['user_id'] ) )
		{
			return $result;
		}
		else
		{
			return FALSE;
		}
    }
	
	function get_countries()
    {
        $result = $this->db->
						select('
								id ,
								ru
								')->
						from( 'country' )->
						order_by( 'ru' , 'ASC' )->
						get()->
						result_array();
		
		if ( isset( $result[0]['id'] ) )
		{
			return get_countries( $result );
		}
		else
		{
			return FALSE;
		}
    }
	
	function edit( $data )
	{
		$UID			= $this->ion_auth->current_UID();
		$data['sex']	= $data['sex'][0];
		
		unset( $data['users_edit_submit'] );
		unset( $data['users_edit_form'] );
		
		$result	= $this->db->update(	$this->tables['meta'] ,
										$data ,
										array( 'user_id' => $UID )
										);
		
		return ( $result ) ? TRUE : FALSE ;
	}
}