<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rubric extends CI_Controller {

	public function index()
	{
		# Get rubrics
		$data['rubrics']	= $this->M_welcome->get_rubrics();
		
		$this->parser->parse('V_rubric_index_article' , $data );
	}
	
	// --------------------------------------------------------------------
	

	/**
	 * Show current rubric
	 *
	 * /rubric/12/
	 */
	public function show()
	{
		# Rubric ID
		$ID				= $this->uri->segment(2);
		
		# Get book data
		$data['books']	= $this->M_rubric->show( $ID );
		
		# If book does not exist
		if ( ! $data['books'] )
		{
			show_404('page');
		}
		
		# Load view
		$this->parser->parse('V_rubric_show_article' , $data );
		
	}
}

/* End of file book.php */
/* Location: ./application/controllers/book.php */