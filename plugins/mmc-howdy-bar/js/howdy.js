//WP runs in "noconflict" mode - $ is undefined
jQuery(document).ready(function( $ ){
	//$ is defined in here!
	
	//event handler for the dismiss button
	$('#mmc-howdy-bar .howdy-dismiss').click( function(){
		$( '#mmc-howdy-bar' ).fadeOut();
	} );

});
	