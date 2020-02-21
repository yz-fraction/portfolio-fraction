<?php
	/**
	 * User-friendly number format.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function num_format( $number )
	{
		//English
		if( LANG == 'eng')
		{
			return number_format($number);
		}
		
		//Ukrainian, russian
		if( LANG == 'rus' OR LANG == 'ukr')
		{
			return str_replace('', '', number_format( $number, 0, '.', ' '));
		}
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * Decimals. English format.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function decimals( $number )
	{
		//7.01
		return number_format(substr( $number,	0, 3), 1);
		//7.0
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * Calculating the average values of an array.
	 *
	 * @access	public
	 * @param	array
	 * @return	integer
	 */
	function array_calculate_average( $array )
	{
		$total = NULL;
		$count = count( $array ); //total numbers in array
		
		foreach ( $array as $value )
		{
			$total = $total + $value; // total value of array numbers
		}
		$average = ($total/$count); // get average value
		
		return $average;
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * Calculating the median values of an array.
	 *
	 * @access	public
	 * @param	array
	 * @return	integer
	 */
	function array_calculate_median( $array )
	{
		sort( $array );
		
		$count = count( $array ); //total numbers in array
		
		$middleval = floor( ( $count-1)/2 ); // find the middle value, or the lowest middle value
		
		if($count % 2)
		{
			// odd number, middle is the median
			$median = $array[$middleval];
		} else
		{
			// even number, calculate avg of 2 medians
			$low = $array[ $middleval ];
			$high = $array[ $middleval+1 ];
			$median = ( ( $low+$high )/2 );
		}
		
		return $median;
	}
	



/* End of file number_helper.php */
/* Location: ./application/helpers/number_helper.php */