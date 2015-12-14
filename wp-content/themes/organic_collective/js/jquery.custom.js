( function( $ ) {

	function removeNoJsClass() {
		$( 'html:first' ).removeClass( 'no-js' );
	}

	/* Superfish the menu drops ---------------------*/
	function superfishSetup() {
		$('.menu').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: true,
			autoArrows:  true,
			dropShadows: false
		});
	}

	/* Flexslider ---------------------*/
	function flexSliderSetup() {
		if( ($).flexslider) {
			var slider = $('.flexslider');
			slider.fitVids().flexslider({
				slideshowSpeed		: slider.attr('data-speed'),
				animationDuration	: 600,
				animation			: slider.attr('data-transition'),
				video				: false,
				useCSS				: false,
				prevText			: '<i class="fa fa-angle-left"></i>',
				nextText			: '<i class="fa fa-angle-right"></i>',
				touch				: false,
				animationLoop		: true,
				smoothHeight		: true,
				controlNav			: false,
				
				start: function(slider) {
					slider.removeClass('loading');
					$( ".preloader" ).hide();
				}
			});
		}
	}
		
	/* Portfolio Filter ---------------------*/
	function isotopeSetup() {
		var mycontainer = $('#portfolio-list');
		mycontainer.isotope({
			itemSelector: '.portfolio-item'
		});
	
		// filter items when filter link is clicked
		$('#portfolio-filter a').click(function(){
			var selector = $(this).attr('data-filter');
			mycontainer.isotope({ filter: selector });
			return false;
		});
	}
	
	/* Masonry ---------------------*/
	function masonrySetup() {
		$('.members').masonry({
			itemSelector : '.four.columns',
			gutterWidth : 0,
			isAnimated: true,
			columnWidth : function( containerWidth ) {
			    return containerWidth / 4; }
		}).imagesLoaded(function() {
		   $('.members').masonry('reload');
		});
	}
	
	/* Size Featured Image To Content ---------------------*/
	function sizingSetup() {
		$(".featured-news .feature-img").css({'height':($(".featured-news .information").height()+'px')});
	}
	
	/* Fit Text For Huge Headlines ---------------------*/
	function textSetup() {
		$(".headline.img-headline").fitText(1.4, { minFontSize: '48px', maxFontSize: '112px' });
		$(".headline.slider-headline").fitText(1.4, { minFontSize: '24px', maxFontSize: '96px' });
		$(".headline.member-headline").fitText(1.1, { minFontSize: '48px', maxFontSize: '96px' });
		$(".headline.post-headline").fitText(1.1, { minFontSize: '36px', maxFontSize: '96px' });
	}
	
	/* Parallax ---------------------*/
	function parallaxSetup() {
		var $window = $(window);
		$('.page-section[data-type="background"]').each(function(){
			var $bgobj = $(this); // assigning the object
			$(window).scroll(function() {
				var yPos = -($window.scrollTop() / $bgobj.data('speed'));
				// Put together our final background position
				var coords = '50% '+ yPos + 'px';
				// Move the background
				$bgobj.css({ backgroundPosition: coords });
			});
		});
	}
		
	function modifyPosts() {
	
		/* Insert Line Break Before More Links ---------------------*/
		$('<br />').insertBefore('.more-link');
		
		/* Hide Comments When No Comments Activated ---------------------*/
		$('.nocomments').parent().css('display', 'none');
		
		/* Animate Page Scroll ---------------------*/
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
		});
		
		/* Fit Vids ---------------------*/
		$('.feature-vid, .content').fitVids();

	}
	
	$( document )
	.ready( removeNoJsClass )
	.ready( superfishSetup )
	.ready( modifyPosts )
	.ready( sizingSetup )
	.ready( masonrySetup )
	.ready( parallaxSetup )
	.on( 'post-load', modifyPosts );
	
	$( window )
	.load( flexSliderSetup )
	.load( isotopeSetup )
	.load( textSetup )
	.resize( flexSliderSetup )
	.resize( textSetup )
	.resize( sizingSetup )
	.resize( masonrySetup )
	.resize( isotopeSetup );
	
})( jQuery );