<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Constant for subdomen
 */
function start_head()
{
	$CI =& get_instance();
	
	$CI->load->library('ion_auth');
	
	$data['logged_in'] = $CI->ion_auth->logged_in();
	
	switch ( uri_string() )
	{
		case '':					$title = lang('Site_Welcome');			break;
		case 'users':				$title = lang('Users');					break;
		case 'users/page':			$title = lang('Users');					break;
		case 'messages':			$title = lang('Messages');				break;
		case 'auth':				$title = lang('Authorization');			break;
		case 'auth/login':			$title = lang('Authorization');			break;
		case 'auth/logout':			$title = lang('Authorization');			break;
		case 'auth/create_user':	$title = lang('Registration');			break;
		case 'auth/edit':			$title = lang('hook_Edit');				break;
		case 'auth/change_email':	$title = lang('hook_Change_email');		break;
		case 'auth/change_password':$title = lang('hook_Change_password');	break;
		default: $title = NULL;
	}
	
	# /users/page/
	if 		( $title == NULL && $CI->uri->segment(2) == 'page' )
	{
		$title = lang('Users').'. '.lang('head_page').' — '.$CI->uri->segment(3);
	}
	
	# /user/
	elseif	( $title == NULL && $CI->uri->segment(1) == 'user' )
	{
		$title = lang('head_user') . ' ' . $CI->ion_auth->get_user_name_surname( $CI->uri->segment(2) );
	}
	
	# /messages/1/
	elseif	( $title == NULL && $CI->uri->segment(1) == 'messages' && $CI->uri->segment(2) )
	{
		$title = lang('Made_good_deed') . ' ' . $CI->ion_auth->get_user_name_surname_by_message_ID( $CI->uri->segment(2) );
		$breadcrumb_1 = lang('Messages');
	}
	elseif	( $title == NULL )
	{
		show_404('page');
	}
	
	
	$data['title'] = $title;
	if ( isset( $breadcrumb_1 ) ) $data['breadcrumb_1'] = $breadcrumb_1 ;
	
	if ( ! $CI->input->is_ajax_request_form() )
	{
		$CI->load->view('1_page_header' , $data );
	}
	
}

/* End of file head.php */
/* Location: ./application/hooks/head_hook.php */