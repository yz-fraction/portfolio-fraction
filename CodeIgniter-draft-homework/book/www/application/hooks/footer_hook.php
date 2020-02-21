<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function start_footer()
{
	$CI =& get_instance();
	
	if (  ! $CI->input->is_ajax_request_form() AND
			$CI->router->fetch_method() != 'upload_poster'
		)
	{
		$CI->load->view('2_page_footer');
	}
}

/* End of file footer_hook.php */
/* Location: ./application/hooks/footer_hook.php */