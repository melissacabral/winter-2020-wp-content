<!DOCTYPE html>
<html lang="en-us">
<head>
  <?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
	
	<style type="text/css">
		/*Custom header css*/
		.header{
			background-image:url( <?php header_image(); ?> );
			background-size: cover;
			background-position: center center;
			color:#<?php header_textcolor(); ?>;
		}
		.header a{
			color:inherit;
		}
		/*hide header text based on the setting*/
		<?php if( ! display_header_text() ){
			?>
			.branding h1, .branding h2{
				border: 0;
			    clip: rect(1px, 1px, 1px, 1px);
			    clip-path: inset(50%);
			    height: 1px;
			    margin: -1px;
			    overflow: hidden;
			    padding: 0;
			    position: absolute !important;
			    width: 1px;
			    word-wrap: normal !important;
			}
			<?php 
		} ?>
	</style>

</head>
<body <?php body_class() ?>>
	<div class="site">
		<header class="header">
			<div class="branding">
				<?php //custom logo activated in functions.php
				the_custom_logo();
				?>

				<h1 class="site-title">
					<a href="<?php echo home_url(); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
			</div>
			<div class="navigation">
				<?php 
				//main menu
				//display the menu from one menu location. register them first in functions.php
				wp_nav_menu( array(
					'theme_location' 	=> 'main_menu',
					'container'			=> 'nav', //div or nav or ''
					'container_class'	=> 'main-menu',
				) ); ?>
			</div>
			<div class="utilities">
				<?php 
				//we are using a custom plugin for the social icons
				//always check if the function exists when calling plugin functions
				if( function_exists('mmc_social_icons') ){
					mmc_social_icons();
				}
				?>
			</div>
			<?php get_search_form(); ?>

			
		</header>