<?php
	
	/**
	* Convert array to object and then object back to array
	* 
	* $array = objectToArray( $init );
	* $object = arrayToObject( $array );
	*/
	function objectToArray($d)
	{
		if (is_object($d))
		{
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
		
		if (is_array($d))
		{
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else
		{
			// Return array
			return $d;
		}
	}

	// --------------------------------------------------------------------

	
	function arrayToObject($d)
	{
		if (is_array($d))
		{
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return (object) array_map(__FUNCTION__, $d);
		}
		else
		{
			// Return object
			return $d;
		}
	}


	// --------------------------------------------------------------------


	/**
	 *	Array
	 *	(
	 *		[0] => Array
	 *			(
	 *				[film_taglinker_tag_id] => 12
	 *			)
	 *			
	 *		[1] => Array
	 *			(
	 *				[film_taglinker_tag_id] => 11
	 *			)
	 *	)
	 *	
	 *	to
	 *	
	 *	Array
	 *	(
	 *		[0] => 12
	 *		[1] => 11
	 *	)
	 */
	function array_shift_up( $array )
	{
		if ( is_array( $array ) )
		{
			foreach ( $array as $key => $inner_array )
			{
				foreach ( $inner_array as $inner_k => $inner_value )
				{
					$array[ $key ] = $inner_value;
				}
			}
			return $array;
		}
		else
		{
			return FALSE;
		}
	}


	// --------------------------------------------------------------------


	/**
	 *	Array
	 *	(
	 *		[0] => Array
	 *			(
	 *				[ID] => 12
	 *				[name] => Apple
	 *			)
	 *			
	 *		[1] => Array
	 *			(
	 *				[ID] => 11
	 *				[name] => Melon
	 *			)
	 *	)
	 *	
	 *	to
	 *	
	 *	Array
	 *	(
	 *		[12] => Apple
	 *		[11] => Melon
	 *	)
	 */
	function array_rename_shift_up( $array , $key , $value )
	{
		if ( is_array( $array ) )
		{
			foreach ( $array as $k => $v )
			{
				$new_key				= $array[$k][$key];
				$array_new[$new_key]	= $array[$k][$value];
			}
			
			unset( $array );
			
			return $array_new;
		}
		else
		{
			return FALSE;
		}
	}


	// --------------------------------------------------------------------


	/*
	 * Rename array keys in multidimensional array
	 * 
	 *	Array
	 * (
	 *	 [0] => Array
	 *		 (
	 *			 [old] => 15
	 *			 [fee_amount] => 308.5
	 *			 [year] => 2009                
	 *		 )
	 *
	 *	 [1] => Array
	 *		(
	 *			 [old] => 14
	 *			 [fee_amount] => 308.5
	 *			 [year] => 2009
	 *		)
	 * )
	 */
	function rename_key_in_multidimensionalArray( $array , $old_key , $new_key )
	{
		if ( is_array( $array ) )
		{
			foreach ( $array as $key => $value )
			{
				$array[ $key ][ $old_key ] = $array[$k][ $old_key ];
				unset( $array[ $key ][ $old_key ]);
			}
			return $array;
		}
		else
		{
			return FALSE;
		}
	}


	// --------------------------------------------------------------------


	/*
	 * Sort multidimensional array by value
	 * 
	 */
	function sort_multidimensionalArray( $array , $sort_type , $order_by )
	{
		if ( is_array( $array ) )
		{
			foreach ( $array as $key => $row )
			{
				$sort[$key]  = $row[$order_by];
			}
			switch ( $sort_type )
			{
				case 'SORT_ASC':	array_multisort( $sort, SORT_ASC , $array );	break;
				case 'SORT_DESC':	array_multisort( $sort, SORT_DESC , $array );	break;
				default:			array_multisort( $sort, SORT_DESC , $array );
			}
			
			return $array;
		}
		else
		{
			return FALSE;
		}
	}


	// --------------------------------------------------------------------


	function regExp_value_in_multidimensionalArray( $array , $regExp )
	{
		if ( is_array( $array ) )
		{
			foreach ( $array as $key => $inner_array )
			{
				foreach ( $inner_array as $inner_k => $inner_value )
				{
					$array[ $key ][ $inner_k ] = trim( preg_replace( $regExp, '' , $inner_value ) );
				}
			}
			return $array;
		}
		else
		{
			return FALSE;
		}
	}


/* End of file objectArray_helper.php */
/* Location: ./application/helpers/objectArray_helper.php */