<?php
header('Content-Type: text/html; charset=UTF-8');

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->database();
		
		//$this->output->enable_profiler(TRUE);
    }
	
	
	/**
	* /messages/
	*/
	public function index()
	{
		$data['messages'] = $this->M_welcome->get_last_messages( URI_segment_number( 3 ) );
		
		# Pagination config
		$config['base_url']		= base_url().'messages/page/';
		$config['total_rows']	= $this->db->count_all( 'message' );
		$this->pagination->initialize($config);
		
		if ( $data['messages'] )
		{
			
			$this->load->view('V_message_index_article' , $data );
		}
		else
		{
			//unknown_error( __CLASS__ , __METHOD__ );
		}
	}
	
	
	/**
	* /messages/
	*/
	public function show()
	{
		$data = $this->M_messages->show( $this->uri->segment(2) );
		
		if ( $data['message'] )
		{
			$data['user_name_surname'] = $this->ion_auth->get_user_name_surname( $data['user_id'] );
			
			$this->load->view('V_messages_show_article' , $data );
		}
		else
		{
			//unknown_error( __CLASS__ , __METHOD__ );
		}
	}
	
	
	/**
	* /messages/add/
	*/
	public function add()
	{
		//if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() )
		//{
		//	redirect( 'http://dobroedelo.dev' , 'location' , 403 );
		//}
		
		$this->load->library('form_validation');
		//$this->form_validation->set_error_delimiters('<div class="form_show_error">', '</div>');
		
		if ( $this->form_validation->run('message') == FALSE )
		{
			# Form data
			$data['form']			= array('id'			=> 'messages_add_form',
											'method'		=> 'post',
			);
			$data['form_message']	= array('id'			=> 'messages_add_message',
											'name'			=> 'message',
											
											'rows'			=> '3',
											'cols'			=> '30',
											'maxlength'		=> '300',
											
											'required'		=> '' ,
											
											'value'			=> set_value('message'),
											'placeholder'	=> lang('form_message_placeholder'),
			);
			$data['form_submit']	= array('id'			=> 'messages_add_submit',
											'name'			=> 'messages_add_submit',
											
											'class'			=> 'btn',
											
											'value'			=> lang('form_message_submit'),
			);
			
			# Error: AJAX Request
			if ( $this->input->is_ajax_request_form() )
			{
				$message = array(
									'message'	=> form_error('message'),
								);
				echo json_encode( $message );
			}
			
			# Error: Standart Request
			else
			{
				$this->load->view('V_messages_add_article' , $data );
			}
		}
		else
		{
			# Insert message
			$add	= $this->M_messages->add( $_POST );
			
			if( $add )
			{
				# Success Page: AJAX Request
				if ( $this->input->is_ajax_request_form() )
				{
					$submitted = array(
										'submit'		=> AJAX_good_response( lang('form_message_submitted') ) ,
									);
					echo json_encode( $submitted );
				}
				
				# Success Page: Standart Request
				else
				{
					$this->load->view('V_messages_add_article');
				}
			}
			else
			{
				
			}
			
			//print ('<pre>');
			//	print_r ( $_POST );
			//print ('</pre>');
		}
	}
	
	/**
	* /messages/delete/
	*/
	public function delete( $message_id )
	{	
		$delete	= $this->M_messages->delete( $message_id );
			
		if( $delete )
		{
			$this->load->view('V_messages_delete_article');
		}
		else
		{
			
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */