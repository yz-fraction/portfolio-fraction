<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * JavaScript
 *
 * Generates script to a JavaScript file
 *
 * @access	public
 * @param	mixed	stylesheet srcs or an array
 * @param	string	src
 * @param	boolean	should index_page be added to the JavaScript path
 * @return	string
 */
if ( ! function_exists('script_tag') )
{
	function script_tag( $src = '', $index_page = FALSE )
	{
		$CI =& get_instance();
		
		$script = '<script ';
		//$script = '<script src="js/libs/modernizr-2.5.3.min.js"></script>';
		
		if ( is_array( $src ) )
		{
			foreach ($src as $k => $v )
			{
				if ($k == 'src' AND strpos($v, '://') === FALSE )
				{
					if ($index_page === TRUE)
					{
						$script .= 'src="'.$CI->config->site_url($v).'" ';
					}
					else
					{
						$script .= 'src="'.$CI->config->slash_item('base_url').$v.'" ';
					}
				}
				else
				{
					$script .= "$k=\"$v\" ";
				}
			}
			
			$script .= "/>";
		}
		else
		{
			if ( strpos($src, '://') !== FALSE)
			{
				$script .= 'src="'.$src.'" ';
			}
			elseif ($index_page === TRUE)
			{
				$script .= 'src="'.$CI->config->site_url($src).'" ';
			}
			else
			{
				$script .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
			}
			
			$script .= '></script>';
		}
		
		return $script;
	}
}

// ------------------------------------------------------------------------


if ( ! function_exists('meta_property') )
{
	function meta_property( $name = '' , $content = '' )
	{
		$meta_property = '<meta property="'.$name.'" content="'.$content.'" />';
		
		return $meta_property;
	}
}


// ------------------------------------------------------------------------


if ( ! function_exists('meta_name') )
{
	function meta_name( $name = '' , $content = '' )
	{
		$meta_name = '<meta name="'.$name.'" content="'.$content.'" />';
		
		return $meta_name;
	}
}


// ------------------------------------------------------------------------


if ( ! function_exists('meta_fb') )
{
	function meta_fb( $name = '' , $content = '' )
	{
		$meta_og = '<meta property="fb:'.$name.'" content="'.$content.'" />';
		
		return $meta_og;
	}
}


// ------------------------------------------------------------------------


if ( ! function_exists('HTML') )
{
	function HTML()
	{
		$HTML = '
		<!--[if lt IE 7 ]> <html lang="'.LNG.'" class="no-js ie6"> <![endif]-->
		<!--[if IE 7 ]>    <html lang="'.LNG.'" class="no-js ie7"> <![endif]-->
		<!--[if IE 8 ]>    <html lang="'.LNG.'" class="no-js ie8"> <![endif]-->
		<!--[if IE 9 ]>    <html lang="'.LNG.'" class="no-js ie9"> <![endif]-->
		<!--[if (gt IE 9)|!(IE)]><!-->
		<html class="no-js"
				 lang="'.LNG.'"
				 prefix="og: http://ogp.me/ns#"
				 xmlns:og="http://opengraphprotocol.org/schema/"
				 xmlns:fb="http://www.facebook.com/2008/fbml">
		<!--<![endif]-->
		';
		
		return $HTML;
	}
}


// ------------------------------------------------------------------------


if ( ! function_exists('copyright') )
{
	function copyright( $year = '' , $LNG = '' )
	{
		if ( empty( $year ) OR empty( $LNG ) )
		{
			return '&copy;';
		}
		
		
		if( date('Y') > $year )
		{
			$year = $year.'&#150;'.date('Y');
		}
		
		
		$copyright	= '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.'.$LNG.'" title="Creative Commons Attribution-NonCommercial 3.0" rel="nofollow">
				&copy;
			</a>
			
			 '.lang('laquo').'
			<a href="'.lang('copyright_URL').'" title="'.lang('copyright_tooltipe').'">
				'.lang('copyright_name').'
			</a>
			'.lang('raquo').',
			
			 '.$year.'
		';
		
		return $copyright;
	}
}


// ------------------------------------------------------------------------


if ( ! function_exists('link_item') )
{
	function link_item( $link , $text , $title )
	{
		if ( base_url().$link.'/' != current_url() )
		{
			return  '	<a href="'.$link.'" title="'.$title.'">
							'.$text.'
						</a>.';
		}
		else
		{
			return  $text;
		}
	}
}


// ------------------------------------------------------------------------


/* End of file HTML5_helper.php */
/* Location: ./application/helpers/HTML5_helper.php */