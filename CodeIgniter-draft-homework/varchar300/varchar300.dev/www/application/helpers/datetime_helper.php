<?php
	
	/**
	 * Converting MySQL datetime to RSS pubDate.
	 *
	 * @access	public
	 * @param	datetime
	 * @return	datetime
	 */
	function MySQL_datetime_to_DATE_RSS( $MySQL_datetime )
	{
		//2012-06-07 15:27:31
		return gmdate(DATE_RSS, strtotime( $MySQL_datetime ));
		//Thu, 07 Jun 2012 12:27:31 +0000
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * Convert robot-time forman to human-time format.
	 *
	 * @access	public
	 * @param	string
	 * @return	integer
	 */
	function robot_time_to_human_time( $robot_time )
	{
		//170
		return date('H:i:s', mktime( 0, $robot_time, 0 ) );
		//02:50:00
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * Convert robot-time forman to human-time format.
	 *
	 * @access	public
	 * @param	string
	 * @return	integer
	 */
	function minute_to_ISO8601( $minute )
	{
		//170
		//return date(DATE_ISO8601, strtotime( $minute ) );
		return date('h:m:s', mktime( 0, $minute, 0 ) );
		//13:47:00
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * xxx.
	 *
	 * @access	xxx
	 * @param	xxx
	 * @return	xxx
	 */
	
	

	// --------------------------------------------------------------------



/* End of file datetime_helper.php */
/* Location: ./application/helpers/datetime_helper.php */