<?php
function DB_timestamp_russification( $date )
	{
		$date_format = 'D, j F Y G:i';
		
		$date = date( $date_format, strtotime( $date ) );
		
		$monthNames_en = array( 'January',
								'February',
								'March',
								'April',
								'May',
								'June',
								'July',
								'August',
								'September',
								'October',
								'November',
								'December');
								
		$monthNames_ru = array(	lang('january'),
								lang('february'),
								lang('march'),
								lang('april'),
								lang('may'),
								lang('june'),
								lang('july'),
								lang('august'),
								lang('september'),
								lang('october'),
								lang('november'),
								lang('december'));
								
		$dNames_en = array(		'Mon',
								'Tue',
								'Wed',
								'Thu',
								'Fri',
								'Sat',
								'Sun');
								
		$dNames_ru = array(		lang('Mon'),
								lang('Tue'),
								lang('Wed'),
								lang('Thu'),
								lang('Fri'),
								lang('Sat'),
								lang('Sun'));
		$date = str_replace( $monthNames_en, $monthNames_ru, $date );
		$date = str_replace( $dNames_en, $dNames_ru, $date );
		
		return $date;
	}

	// --------------------------------------------------------------------

	/**
	 * Humanize MySQL timestamp.
	 *
	 * @access	public
	 * @param	time
	 * @return	string
	 *
	 * $DB_time_value
	 * $time_value
	 * $d
	 */
	function mysql_timestamp_to_human( $DB_time_value )
	{
		$time_value = mysql_to_unix( $DB_time_value );
		
		$today_day	= date('d');
		$added_day	= date('d', $time_value);
		$added_month= date('m', $time_value);
		$added_hour	= date('G', $time_value);
		$month_now	= date('m');
		$yesterday	= date('d', strtotime("yesterday"));
		$day_before_yesterday	= date('d', strtotime("-2 day"));
		
		$d = time() - $time_value;
		
		
		# Second
		if 		($d < 60)		{$time_value =  $d;				$ago = lang('sec_ago');}
		
		# Minute
		elseif	($d < 3600)		{$time_value =  round($d / 60);	$ago = lang('min_ago');}
		
		# Hour
		elseif	($d < 86400)	{
									$number = (string)round($d / 3600);
									$number = $number[strlen($number)-1];
									$time_value =  round($d / 3600);
									
									$ago =	(   $time_value == 0 ) ? lang('about_hours_ago') : 
									$ago =	(   $time_value == 1  OR $time_value == 21 ) ? lang('hour_ago') : 
									$ago =	( ( $time_value >= 2  && $time_value <= 4  ) OR
											  ( $time_value >= 22 && $time_value <= 24 ) ) ? lang('hourGen_ago') :
											lang('hours_ago');
								}
		
		# Day
		else					{
									$number = (string)round($d / 86400);
									$number = $number[strlen($number)-1];
									$time_value =  round($d / 86400);
									$ago =	( $time_value == 0 ) ? lang('about_days_ago') : 
									$ago =	( $time_value == 2 OR $time_value == 3 OR $time_value == 4 ) ? lang('dayGen_ago') :
											lang('days_ago');
									if( $time_value ==  1 )	{$time_value = NULL; $ago = lang('day_ago');}
									if( $time_value == 30 )	{$time_value = NULL; $ago = lang('month_ago');}
									if( $time_value >= 31 ) {$time_value = NULL; $ago = lang('month_more_ago');}
								}
		
		if( ( (int)$added_day == (int)$yesterday OR
		      (int)$added_day == (int)$today_day) &&
			  (int)$added_month == (int)$month_now &&
			  round($d / 3600) > 1 )
		{
			switch ( (int)$added_hour )
			{
				case '0':	$ago = lang('night');break;
				case '1':	$ago = lang('night');break;
				case '2':	$ago = lang('night');break;
				case '3':	$ago = lang('night');break;
				case '4':	$ago = lang('night');break;
				case '5':	$ago = lang('early_in_the_morning');break;
				case '6':	$ago = lang('early_in_the_morning');break;
				case '7':	$ago = lang('morning');break;
				case '8':	$ago = lang('morning');break;
				case '9':	$ago = lang('morning');break;
				case '10':	$ago = lang('forenoon');break;
				case '11':	$ago = lang('forenoon');break;
				case '12':	$ago = lang('midday');break;
				case '13':	$ago = lang('afternoon');break;
				case '14':	$ago = lang('afternoon');break;
				case '15':	$ago = lang('afternoon');break;
				case '16':	$ago = lang('afternoon');break;
				case '17':	$ago = lang('afternoon');break;
				case '18':	$ago = lang('evening');break;
				case '19':	$ago = lang('evening');break;
				case '20':	$ago = lang('evening');break;
				case '21':	$ago = lang('evening');break;
				case '22':	$ago = lang('afterevening');break;
				case '23':	$ago = lang('afterevening');break;
				default:	$ago =	NULL;
			}
		}
			
			if( (int)$added_day == (int)$today_day &&
			    (int)$added_month == (int)$month_now &&
				round($d / 3600) > 1
			   )
			{
				$time_value = lang('today');
			}
				if( (int)$added_day == (int)$yesterday)
				{
					$time_value = lang('day_ago');
				}
					if( (int)$added_day == (int)$day_before_yesterday )
					{
						$time_value = NULL;
						$ago = lang('day_before_yesterday');
					}
					
		return $time_value.$ago;
	}

	// --------------------------------------------------------------------

	



/* End of file datetimeRus_helper.php */
/* Location: ./application/helpers/datetimeRus_helper.php */