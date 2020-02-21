<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRUD_book extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		
		# Load library
		$this->load->library('manipulation_book');
		$this->load->library('form_validation');
		
		# Load model
		$this->load->model('ML/ML_Files');
    }
	
	
	/**
	 * Edit & update
	 *
	 * /book/12/edit/
	 */
	public function index( $action )
	{
		switch( $action )
		{
			case 'create': 	# Book data
							$data	= array();
							break;
						
			case 'edit': 	# Book ID
							$ID		= $this->uri->segment(2);
							
							# Get book data
							$data	= $this->M_book->show( $ID );
							
							# If book does not exist
							if ( ! $data )
							{
								show_404('page');
							}
							break;
		}
		
		# Valid?
		if ( $this->form_validation->run('book_update') )
		{
			# Get POST data
			$POST	= $this->input->post( NULL , TRUE );
				
				switch( $action )
				{
					case 'create': 	# Insert data
									$action			= $this->manipulation_book->index( $POST , FALSE , 'insert' );
									$upload_cover	= FALSE;
									
									# Message: success update
									if ( $action )
									{
										$data['insert_success'] =  lang('form_success_insert');
										$upload_cover			= TRUE;
										$ID						= $this->M_book->last_ID();
									}
									
									# Message: error update
									if ( ! $action ) $data['insert_error'] =  lang('form_error_insert');
									break;
								
					case 'edit': 	# Update data
									$action	= $this->manipulation_book->index( $POST , $ID , 'update' );
									$upload_cover	= FALSE;
									
									# Message: success update
									if ( $action )
									{
										$data['update_success'] =  lang('form_success_updated');
										$upload_cover			= TRUE;
									}
									
									# Message: error update
									if ( ! $action ) $data['update_error'] =  lang('form_error_updated');
									break;
				}
			
			# Upload cover
			if( $_FILES['userfile']['size'] > 0 AND $upload_cover )
			{
				# Try to upload cover
				$upload					= $this->ML_Files->upload_poster( $ID );
				
				# Message: success upload
				$data['upload_success']	= ( $upload )	? TRUE : FALSE;
				
				# Message: error upload
				$display_errors			= ( ! $this->upload->display_errors() ) ? lang('upload_error') : $this->upload->display_errors();
				$data['upload_error']	= ( ! $upload )	? $display_errors : FALSE;
			}
		}
		
		# Generate form
		$form	= $this->manipulation_book->form( $data );
		
		switch( $action )
		{
			case 'create': 	$data	= array_merge( $data , $form );
							break;
						
			case 'edit': 	# Merge data
							$data	= array_merge( $data , $form );
							break;
		}
		
		# Load view
		$this->parser->parse('V_book_edit_article' , $data );
		
	}
	
	
	// --------------------------------------------------------------------
	
	
	/**
	 * Delete
	 * /book/12/delete/
	 */
	public function delete( $ID )
	{
		# Load configuration
		$this->config->load('My/cfg_files' , TRUE);
		$cfg	= $this->config->item('My/cfg_files');
		
		# Delete
		$result	= $this->manipulation_book->book_delete( $ID );
		
		# Load view
		$this->load->view('V_book_delete_article');
		
		
		# Get books
		$article['books']	= $this->M_welcome->get_last_books( URI_segment_number( 3 ) );
		
		# Pagination config
		$config['base_url']		= base_url().'book/page/';
		$config['total_rows']	= $this->db->count_all( 'book' );
		$this->pagination->initialize($config);
		
		# Load view
		$this->parser->parse('V_book_index_article' , $article );
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function create_AJAX()
	{
		if ( $this->input->is_ajax_request_form() )
		{
			if ( ! $this->form_validation->run('book_update') )
			{
				# Error message
				$message = array(
									'title'		=> form_error('title') ,
									'author'	=> form_error('author') ,
									'rubrics'	=> form_error('rubrics[]') ,
								);
			}
			else
			{
				# Insert data
				$action			= $this->manipulation_book->index( $_POST , FALSE , 'insert' );
				
				$message 	= array(
									'submit'		=> AJAX_good_response( lang('form_success_insert') ) ,
									);
			}
			echo json_encode( $message );
		}
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function update_AJAX()
	{
		if ( $this->input->is_ajax_request_form() )
		{
			if ( ! $this->form_validation->run('book_update') )
			{
				$message = array(
									'title'		=> form_error('title') ,
									'author'	=> form_error('author') ,
								);
				echo json_encode( $message );
			}
			else
			{
				# Book ID
				$ID			= $_POST['ID'];
				
				# Update data
				$this->manipulation_book->index( $_POST , $ID , 'update' );
				
				$submitted 	= array(
									'submit'		=> AJAX_good_response( lang('form_success_updated') ) ,
								);
				echo json_encode( $submitted );
			}
		}
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function upload_poster( $ID )
	{
		# Upload cover
			if( $_FILES['userfile']['size'] > 0 )
			{
				# Try to upload cover
				$upload					= $this->ML_Files->upload_poster( $ID );
				
				$message = ( $upload ) ? AJAX_good_response( lang('upload_success') ) : $this->upload->display_errors();
				
				$submitted 	= array(
									'status'		=> $message ,
									);
				echo json_encode( $submitted );
			}
	}
}

/* End of file crud_book.php */
/* Location: ./application/controllers/crud_book.php */