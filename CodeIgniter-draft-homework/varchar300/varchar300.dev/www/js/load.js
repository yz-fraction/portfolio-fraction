yepnope([
			{
				load: '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
				complete:	function ()
							{
								if (!window.jQuery) {
									yepnope( '/js/library/jquery-1.7.1.min.js' );
								}
							}
			},
			
			{
				load: '/js/A-grade/'
			},
			
			{
				load: [ '/js/library/jquery.scrollto.min.js',
						'/js/library/jquery.history.js',
						'/js/library/ajaxify-html5.js']
			}
]);
