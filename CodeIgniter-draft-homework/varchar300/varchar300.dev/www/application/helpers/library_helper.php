<?php

function URI_segment_number( $URI_segment_number )
{
	$CI =& get_instance();
	
	$URI_segment = NULL;
	
	if ( $CI->uri->segment( $URI_segment_number ) )
	{
		$URI_segment = (int) $CI->uri->segment( $URI_segment_number );
		if ( ! empty( $URI_segment ) )
		{
			( $URI_segment % PAGINATION_PER_PAGE ) ? $URI_segment : PAGINATION_PER_PAGE;
		}
	}
	
	return $URI_segment;
}