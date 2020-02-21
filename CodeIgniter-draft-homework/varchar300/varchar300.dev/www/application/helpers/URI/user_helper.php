<?php

function get_countries( $result )
{
	foreach ( $result as $k => $v )
	{	
		$result[ $v['id'] ] = $v['ru'];
		
		unset( $result[0] );
	}
	
	return $result;
}