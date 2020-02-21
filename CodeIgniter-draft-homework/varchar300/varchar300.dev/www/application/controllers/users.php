<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('pagination');
		$this->load->database();
    }
	
	
	public function index()
	{
		$data['users'] = $this->M_user->get_users( URI_segment_number( 3 ) );
		
		$config['base_url']		= base_url().'users/page/';
		$config['total_rows']	= $this->db->count_all( 'meta' );
		$this->pagination->initialize($config);
		
		if ( $data['users'] )
		{
			
			$this->load->view('V_users_index_article' , $data );
		}
		else
		{
			show_404('page');
		}
	}
	
	
	public function dossier( $user_id )
	{
		# Load user dossier
		$data['dossier'] = $this->M_user->show_dossier( $user_id );
		if ( $data['dossier'] )
		{
			$this->load->view('V_users_dossier_aside', $data['dossier'][0] );
		}
		else
		{
			show_404('page');
		}
		
		# Load user messages
		$data['messages'] = $this->M_user->show_messages( $user_id );
		if ( $data['messages'] )
		{
			$this->load->view('V_users_dossier_article', $data );
		}
		else
		{
			# TODO: add action.
			show_404('page');
		}
	}
	
	public function current()
	{
		if ( ! $this->ion_auth->logged_in() )
		{
			redirect('auth', 'refresh');
		}
		else
		{
			redirect( base_url().'user/'.$this->ion_auth->current_UID().'/' , 'location' );
		}
	}
	
	public function delete( $user_id )
	{
		$delete_user			= $this->ion_auth->delete_user( $user_id );
		$delete_user_messages	= $this->M_messages->delete_user_messages( $user_id );
		
		if( $delete_user &&
		    $delete_user_messages )
		{
			$this->load->view('V_users_delete_article');
		}
		else
		{
			
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */