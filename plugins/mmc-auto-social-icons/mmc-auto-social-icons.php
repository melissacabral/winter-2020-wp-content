<?php 
/*
Plugin Name: MMC Auto Social Icons
Description: Automatically changes icons in the .social-icons menu
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
 */


/**
 * Call this function to display this menu in your templates
 * @return HTML displays a div containing the menu output
 */
function mmc_social_icons(){
	wp_nav_menu( array(
		'theme_location'  => 'mmc_social_icons',
		'container_class' => 'mmc-social-icons',
		'fallback_cb'     => false,
		'link_before'     => '<span class="mmc-screen-reader-text">',
        'link_after'      => '</span>',
	) );
}

/**
 * create the menu location
 */
add_action('init', 'mmc_make_menu_location');
function mmc_make_menu_location(){
	register_nav_menus( array(
		'mmc_social_icons' => 'Auto Social Icons',
	) );
}

/**
 * Stylesheets
 */
add_action( 'wp_enqueue_scripts', 'mmc_social_icons_scripts' );
function mmc_social_icons_scripts(){
	
	$url = plugins_url('fonts/social-logos.css', __FILE__);
	wp_enqueue_style( 'social-logos', $url );

	$url = plugins_url('css/mmc-social-icon-menu.css', __FILE__);
	wp_enqueue_style( 'mmc-social-icons-style', $url );
}



