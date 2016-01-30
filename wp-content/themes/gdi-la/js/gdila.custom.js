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

	var signupform = function(){
		if (currentUser) {
			var firstNameField = $('#wivm_first_name'),
				lastNameField = $('#wivm_last_name'),
				emailField = $('#wivm_email'),
				phoneField = $('#wivm_phone');

			firstNameField.val(currentUser.firstName);
			lastNameField.val(currentUser.lastName);
			emailField.val(currentUser.email);
			phoneField.val(currentUser.phone);
		}
	};

	gdila.init = function() {
	  gdila.classesMasonry();
	  signupform();
	};

}(jQuery, window.gdila = window.gdila || {}));


jQuery(function(){
	gdila.init();
});

jQuery( window ).resize( gdila.classesMasonry );