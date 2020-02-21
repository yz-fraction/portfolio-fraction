<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {

	public function index()
	{
		# Get books
		$article['books']	= $this->M_welcome->get_last_books( URI_segment_number( 3 ) );
		
		# Pagination config
		$config['base_url']		= base_url().'book/page/';
		$config['total_rows']	= $this->db->count_all( 'book' );
		$this->pagination->initialize($config);
		
		$this->parser->parse('V_book_index_article' , $article );
	}
	
	// --------------------------------------------------------------------
	

	/**
	 * Show current book
	 *
	 * /book/12/
	 */
	public function show()
	{
		# Book ID
		$ID					= $this->uri->segment(2);
		
		# Get book data
		$data				= $this->M_book->show( $ID );
		
		# Get rubrics
		$data['rubrics']	= $this->M_book->get_rubrics( $ID );
		
		# If book does not exist
		if ( ! isset( $data['ID'] ) )
		{
			show_404('page');
		}
		
		# Load view
		$this->parser->parse('V_book_show_article' , $data );
	}
}

// END Book class

/* End of file book.php */
/* Location: ./application/controllers/book.php */