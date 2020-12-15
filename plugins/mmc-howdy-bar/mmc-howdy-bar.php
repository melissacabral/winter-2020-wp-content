<?php
/*
Plugin Name: MMC Howdy Bar
Description: Simple plugin demo - adds an announcement bar at the top of our page
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

/**
 * Display the HTML for the bar
 * @since  0.1 
 */
add_action('wp_footer', 'mmc_howdy_html');
function mmc_howdy_html(){
	?>
	<!-- Howdy Bar by Melissa Cabral -->
	<div id="mmc-howdy-bar">
		<span class="howdy-message">
			This is an important announcement
		</span>
		<a class="howdy-button" src="#">Click Here</a>

		<a class="howdy-dismiss">&times;</a>
	</div>
	<!-- End Howdy Bar -->
	<?php
}

/**
 * Attach all CSS & JS files needed
 */
add_action( 'wp_enqueue_scripts', 'mmc_howdy_scripts' );
function mmc_howdy_scripts(){
	//stylesheet URL
	$styleurl = plugins_url( 'css/howdy-bar.css', __FILE__ );
	//register and enqueue the stylesheet
	wp_enqueue_style( 'howdy-style', $styleurl );

	//attach jquery (built into WP)
	wp_enqueue_script( 'jquery' );

	//attach our custom script
	$jsurl = plugins_url( 'js/howdy.js', __FILE__ );
						//handle, 		src, 	deps, 			ver, in footer?
	wp_enqueue_script( 'howdy-script', $jsurl, array('jquery'), '0.1', true );
}


//no close php
