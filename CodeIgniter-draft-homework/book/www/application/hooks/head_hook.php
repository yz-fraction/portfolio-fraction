<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Constant for subdomen
 */
function start_head()
{
	$CI =& get_instance();
	
	switch ( uri_string() )
	{
		case '':		$title 			= lang('Site_Welcome');
						break;
						
		case 'book':	$title			= lang('Books');
						$breadcrumb_1	= lang('Books');
						break;
						
		case 'rubric':	$title 			= lang('Rubrics');	
						$breadcrumb_1	= lang('Rubric');
						break;
						
		case 'book/new':			$title 		= TRUE; break;
		case 'book/update':			$title 		= TRUE; break;
		case 'book/upload_poster':	$title 		= TRUE; break;
		
		default: $title = FALSE;
	}
	
	if ( $title == FALSE )
	{
		# /book/12/
		if 		( $CI->uri->segment(1) == 'book' && is_numeric( $CI->uri->segment(2) ) )
		{
			$title = $CI->ML_hook->title_book( $CI->uri->segment(2) );
		}
		
		# /rubric/5
		elseif	( $CI->uri->segment(1) == 'rubric' && is_numeric( $CI->uri->segment(2) ) )
		{
			$title			= $CI->ML_hook->rubric_pagination( $CI->uri->segment(2) );
			$breadcrumb_1	= lang('Rubric');
			$breadcrumb_2	= $title;
		}
		
		# /welcome/page/5
		elseif	( $CI->uri->segment(1) == 'welcome' && $CI->uri->segment(2) == 'page' && is_numeric( $CI->uri->segment(3) ) )
		{
			$title = $CI->ML_hook->title_pagination( $CI->uri->segment(3) );
		}
		
		# /book/page/5
		elseif	( $CI->uri->segment(1) == 'book' && $CI->uri->segment(2) == 'page' && is_numeric( $CI->uri->segment(3) ) )
		{
			$title 			= $CI->ML_hook->title_pagination( $CI->uri->segment(3) );
			$breadcrumb_1	= lang('Books');
		}
		
		# /book/create/
		elseif	( $CI->uri->segment(1) == 'book' && $CI->uri->segment(2) == 'create' )
		{
			$title			= lang('Create');
		}
		
		# /book/create/
		elseif	( $CI->uri->segment(1) == 'book' && $CI->uri->segment(2) == 'upload_poster' && is_numeric( $CI->uri->segment(3) ) )
		{
			$title			= TRUE;
		}
		
		elseif	( $title == NULL )
		{
			show_404('page');
		}
	}
	
	
	$data['title'] = $title;
	
	if ( isset( $breadcrumb_1 ) ) $data['breadcrumb_1'] = $breadcrumb_1 ;
	if ( isset( $breadcrumb_2 ) ) $data['breadcrumb_2'] = $breadcrumb_2 ;
	
	if (  ! $CI->input->is_ajax_request_form() AND
			$CI->router->fetch_method() != 'upload_poster'
		)
	{
		$CI->load->view('1_page_header' , $data );
	}
	
}

/* End of file head_hook.php */
/* Location: ./application/hooks/head_hook.php */