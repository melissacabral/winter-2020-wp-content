<?php
/*
Plugin Name: MMC Portfolio Post Type
Description: Sets up the "portfolio" custom post type 
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/
add_action( 'init', 'mmc_cpt' );
function mmc_cpt(){
	/**
	 * @link  https://developer.wordpress.org/reference/functions/register_post_type/
	 */
	register_post_type( 'work', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'label'			=> 'Portfolio',
		'menu_position' => 5,
		'menu_icon'		=> 'dashicons-portfolio',
		'supports'		=> array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'custom-fields' ),
		'show_in_rest' 	=> true, //enable block editor
		'rewrite' 		=> array( 'slug' => 'portfolio' ), //visible in the URL
	) );

	//attach a "work-category" taxonomy to the portfolio
	register_taxonomy( 'work_category', 'work', array(
		'hierarchical' 	=> true,  //act like categories, not tags
		'label' 		=> 'Work Category',
		'show_in_rest' 	=> true,
		'show_admin_column' => true,
		'rewrite'		=> array( 'slug' => 'work-category' ),
		
	) );
} /*end cpt function*/


/**
 * Flush the permalinks (rewrite rules) when this plugin activates
 */
function mmc_cpt_flush(){
	mmc_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__ , 'mmc_cpt_flush' );