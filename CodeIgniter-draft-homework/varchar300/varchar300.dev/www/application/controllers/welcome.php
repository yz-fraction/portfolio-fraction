<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	/**
	* Welcome page
	*/
	public function index()
	{
		$data['messages'] = $this->M_welcome->get_last_messages( 1 );
		
		if ( $data['messages'] )
		{
			$this->parser->parse('V_welcome_index_article' , $data );
		}
		else
		{
			show_404('page');
		}
	}
	
	public function user()
	{
		$this->load->view('1_page_header');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */