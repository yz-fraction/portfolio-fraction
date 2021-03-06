<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_system'] = array(
                                'class'    => '',
                                'function' => 'addExceptionHandler',
                                'filename' => 'exception_hook.php',
                                'filepath' => 'hooks'
                                ); 
$hook['pre_system'] = array(
                                'class'    => '',
                                'function' => 'language',
                                'filename' => 'CONSTANTS_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'] = array(
								'class'		=> '',
								'function'	=> 'start_head',
								'filename'	=> 'head_hook.php',
								'filepath'	=> 'hooks'
								);

$hook['post_controller'] = array(
								'class'		=> '',
								'function'	=> 'start_footer',
								'filename'	=> 'footer_hook.php',
								'filepath'	=> 'hooks'
								);

$hook['display_override'] = array(
								'class'		=> '',
								'function'	=> 'compress',
								'filename'	=> 'compress_hook.php',
								'filepath'	=> 'hooks'
								);



/* End of file hooks.php */
/* Location: ./application/config/hooks.php */