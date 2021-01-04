<?php 
/*
Plugin Name: MMC Admin Tweaks
Description: Admin panel and login form customization
Author: Melissa Cabral
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
 */


/**
 * Custom Login Form CSS
 */
add_action( 'login_enqueue_scripts', 'mmc_login_style' );
function mmc_login_style(){
	$url = plugins_url( 'css/login.css', __FILE__ );
	wp_enqueue_style( 'custom-login', $url );
}
/**
 * Change the login logo URL
 */
add_filter( 'login_headerurl', 'mmc_login_logo_url' );
function mmc_login_logo_url(){
	return home_url();
}
add_filter( 'login_headertitle', 'mmc_login_logo_title' );
function mmc_login_logo_title(){
	return 'Go back to ' . get_bloginfo( 'name' );
}

/**
 * Toolbar Customization
 * Remove the WP logo from the toolbar
 */
add_action( 'admin_bar_menu', 'mmc_toolbar', 999 );
function mmc_toolbar( $wp_admin_bar ){
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->add_node( array(
		'id' => 'mmc-help',
		'title' => '<span class="ab-icon dashicons dashicons-editor-help"></span> Get Help',
		'href' => 'http://google.com',
		'meta' => array( 'target' => '_blank' ), //other HTML attributes
	) );  
}

/**
 * Remove Dashboard widgets
 */
add_action( 'admin_menu', 'mmc_dashboard' );
function mmc_dashboard(){
	//detect what type of user (manage options checks for administrator)
	if( current_user_can('manage_options') ){
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}else{
		//remove news and events
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	}	
}

/**
 * Add dashboard widgets
 */
add_action( 'wp_dashboard_setup', 'mmc_dash_widget_add' );
function mmc_dash_widget_add(){
	wp_add_dashboard_widget( 'mmc_support', 'Helpful Videos', 'mmc_custom_dash_widget' );
}


//custom callback for the content of the widget
function mmc_custom_dash_widget(){
	?>

	<iframe width="300" height="169" src="https://www.youtube.com/embed/x7R2HcTAyjI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

	<?php
}


/**
 * From Admin Color Generator
 * @link https://wpadmincolors.com
 */
add_action('admin_init', 'mmc_admin_admin_color_scheme');
function mmc_admin_admin_color_scheme() {
  //Get the url
  $url = plugins_url( 'css/mmc-admin.css', __FILE__ );
 
  //Melissa
  wp_admin_css_color( 'mmc-admin', __( 'Melissa' ),   $url ,
    array( '#1c1a22', '#fff', '#d52140' , '#0ba5a5')
  );
}

/**
 * Admin Footer Text
 */
add_filter('admin_footer_text', 'mmc_footer_text');
function mmc_footer_text(){
	return 'Anything you want here';
}

/**
 * Remove menu items
 */
add_action( 'admin_menu', 'mmc_admin_menu' );
function mmc_admin_menu(){
	remove_menu_page( 'edit-comments.php' );
}
