jQuery(document).ready(function() {
   
	(function($) {
	
	var videoPresent = $('#wp-custom-header-video');
	var customHeader = document.getElementById('wp-custom-header');

		if(videoPresent) {
			customHeader.classList.add("video-header-wrapper");
			videoPresent.append('tetetetetetetetet');

		}
	console.log('front_cta works');
	})( jQuery );

});