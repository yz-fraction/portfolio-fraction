<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		# Get rubrics
		$aside['rubrics']	= $this->M_welcome->get_rubrics();
		
		# Get books
		$article['books']	= $this->M_welcome->get_last_books( URI_segment_number( 3 ) );
		
		
		# Pagination config
		$config['base_url']		= base_url().'welcome/page/';
		$config['total_rows']	= $this->db->count_all( 'book' );
		$this->pagination->initialize($config);
		
		
		$this->parser->parse('V_welcome_index_aside' , $aside );
		
		$this->parser->parse('V_welcome_index_article' , $article );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */