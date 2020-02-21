<?php

/**
 * Prepare books list
 *
 * @access	public
 * @return	array
 */
function books_list( $result )
{
	if( ! isset ( $result[0] ) ) return $result['cover'] = empty_cover();
	
	foreach( $result as $key => $value )
	{
		# Add cover
		$ID			= $result[$key]['ID'];
		$filename	= $_SERVER['DOCUMENT_ROOT'].cover_by_ID( $ID );
		
		if ( ! file_exists( $filename ) )
		{
			$result[$key]['cover'] = empty_cover();
		}
		else
		{
			$result[$key]['cover'] = cover_by_ID( $ID );
		}
	}
	
	return $result;
}


// --------------------------------------------------------------------

/**
 * Prepare books list
 *
 * @access	public
 * @return	array
 */
function rubrics_list( $result )
{
	$CI =& get_instance();
	
	foreach( $result as $key => $inner_array)
	{
		# Add counter
		$result[$key]['counter']	= $CI->M_rubric->counter( $result[$key]['ID'] );
		
		if( $result[$key]['counter'] == 0 )
		{
			unset( $result[$key] );
		}
	}
	
	return $result;
}


// --------------------------------------------------------------------


function add_checked_tags( $array_tags , $array_tags_current )
{
	if ( is_array( $array_tags ) && is_array( $array_tags_current ) )
	{
		$array_tags_current = array_shift_up( $array_tags_current );
		foreach( $array_tags as $key => $inner_array)
		{
			if( in_array( $inner_array['ID'] , $array_tags_current ) )
			{
				# Add checked
				$array_tags[$key]['checked'] = TRUE;
			}
			else
			{
				$array_tags[$key]['checked'] = FALSE;
			}
		}
	}
	
	$array_tags = sort_multidimensionalArray( $array_tags , 'SORT_ASC' , 'rubric' );
	
	return $array_tags;
}


// --------------------------------------------------------------------


function cover_by_ID( $ID )
{
	$CI =& get_instance();
	
	# Load configuration
	$CI->config->load('My/cfg_files' , TRUE);
	$cfg			= $CI->config->item('My/cfg_files');
	
	$path 			= $cfg['64_path'];
	$suffix			= $cfg['64_suffix'];
	
	return $path.$ID.$suffix;;
}


// --------------------------------------------------------------------


function empty_cover()
{
	$CI =& get_instance();
	
	# Load configuration
	$CI->config->load('My/cfg_files' , TRUE);
	$cfg			= $CI->config->item('My/cfg_files');
	
	$path 			= $cfg['64_path'];
	$empty			= $cfg['64_empty'];
	
	return $path.$empty;
}

