if (window.webshim) {
    (function () {
        webshim.polyfill('forms forms-ext');
    })();
}

jQuery(document).ready(function($) {
	
	jQuery.fn.exists = function(){return this.length>0;}
	
	/* ScrollSpy */
	$('body').scrollspy({
		target: '#nav' ,
		offset: $(window).height() * 0.2
	});
	
	/* Affix */
	$('#nav').affix({
		offset: {
			top: $( '#firstscreen-section' ).outerHeight() +1
		}
	});

	$(window).bind( 'load resize orientationchange' , function() {
		
		/* # Variables. */
		responsivebreakpoint	= findBootstrapEnvironment();
		
		function is_frontpage() {
			return window.location.pathname === '/' ? true : false ;
		}
		
		
		/* Set section width&height. */
		viewport_width	= $( window ).width();
		viewport_height	= $( window ).height();
		$( '.section-offers' ).css({'margin-top': viewport_width + 'px'});
		$( '.section-bg' ).css({'height': viewport_height + 'px'});
		/* ./ Set section width&height. */
	});
	
	$( '#lightGallery' ).lightGallery();
	
	/* Set responsive breakpoint.*/
	$(window).bind( 'load resize' , function()
	{
		$( 'body' ).data( 'responsivebreakpoint' , findBootstrapEnvironment() ) ;
		$( 'body' ).attr( 'data-responsivebreakpoint' , findBootstrapEnvironment() ) ;
		
		$( 'body' ).removeClass( 'device-df device-xs device-sm device-md device-lg' ) ;
		$( 'body' ).addClass( 'device-' + findBootstrapEnvironment() ) ;
	});
	
	/* Find Bootstrap environment */
	function findBootstrapEnvironment() {
		var envs = ['df','xs', 'sm', 'md', 'lg'];

		var $el = $('<div>');
		$el.appendTo($('body'));

		for (var i = envs.length - 1; i >= 0; i--) {
			var env = envs[i];

			$el.addClass('hidden-'+env);
			if ($el.is(':hidden')) {
				$el.remove();
				return env;
			}
		}
	}
	
	/* Preloader */
	$('body').append('<div id="preloader"></div>');
	$('#preloader').css('position','fixed');
	$('#preloader').css('left','0');
	$('#preloader').css('top','0');
	$('#preloader').css('z-index','10000');
	$('#preloader').css('width','100%');
	$('#preloader').css('height','100%');
	$('#preloader').css('overflow','visible');
	$('#preloader').css('background-color','rgb(66,66,66)');
	$('#preloader').css('background-color','rgba(88, 88, 88, .66)');
	var opts = {
		lines: 8,
		length: 8,
		radius: 8,
		color: '#111',
	};
	var target = document.getElementById('preloader');
	var spinner = new Spinner(opts).spin(target);
	$(window).load(function(){
		$( '#preloader' ).fadeOut(500, function(){
			spinner.stop();
			$(this).remove();
			$( '#thetopofthepage' ).fadeIn(500, function(){
				
			});
		});
	});
	
	$('body').append('<div id="winSize"></div>');
	var WindowsSize=function(){
		var h=$(window).height(),
			w=$(window).width();
			d=findBootstrapEnvironment();
		$('#winSize').html("<p>Width: "+w+"<br>Height: "+h+"<br>Device: "+d+"</p>");
		$('#winSize').css('position','fixed');
		$('#winSize').css('bottom','1%');
		$('#winSize').css('right','1%');
		$('#winSize').css('border','rgba(0,0,0,0.8) 3px solid');
		$('#winSize').css('background','rgba(0,0,0,0.6)');
		$('#winSize').css('padding','5px 10px');
		$('#winSize').css('color','#fff');
		$('#winSize').css('z-index','9999');
	};
	$(document).ready(WindowsSize); 
	$(window).resize(WindowsSize); 
});