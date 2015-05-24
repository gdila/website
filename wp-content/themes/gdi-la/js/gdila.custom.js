;(function ($, gdila, undefined) {

	gdila.classesMasonry = function() {
		$('.members').masonry({
			itemSelector : '.third.columns',
			gutterWidth : 0,
			isAnimated: true,
			columnWidth : function( containerWidth ) {
			    return containerWidth / 3; }
		}).imagesLoaded(function() {
		   $('.members').masonry('reload');
		});
	};

	gdila.init = function() {
	  gdila.classesMasonry();
	};

}(jQuery, window.gdila = window.gdila || {}));


jQuery(function(){
	gdila.init();
});

jQuery( window ).resize( gdila.classesMasonry );