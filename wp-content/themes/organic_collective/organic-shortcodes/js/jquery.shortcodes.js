( function( $ ) {
		
	function setupShortcodes() {
		
		/* jQuery UI Tabs ---------------------*/
		$(function() {
			$( ".organic-tabs" ).tabs();
		});
		
		/* jQuery UI Accordion ---------------------*/
		$(function() {
			$( ".organic-accordion" ).accordion({
				collapsible: true,
				heightStyle: "content"
			});
		});
		
		/* Close Message Box ---------------------*/
		$('.organic-box a.close').click(function() {
			$(this).parent().stop().fadeOut('slow', function() {
			});
		});
		
		/* Toggle Box ---------------------*/
		$('.toggle-trigger').click(function() {
			$(this).toggleClass("active").next().fadeToggle("slow");
		});
	}
	
	$( document )
	.ready( setupShortcodes )
	.on( 'post-load', setupShortcodes );
	
})( jQuery );