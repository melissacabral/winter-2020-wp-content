<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
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
	<?php wp_body_open(); //required HOOK ?>	
	<div class="site">
		<header class="header">
			<div class="branding">
				<?php //custom logo activated in functions.php
				the_custom_logo();
				?>

				<h1 class="site-title">
					<a href="<?php echo esc_url(home_url()); ?>">
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



			<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'portfolio-shop-wcm400' ); ?>">
				<?php echo sprintf ( _n( 
					'%d item', 
					'%d items', 
					WC()->cart->get_cart_contents_count(),
					'portfolio-shop-wcm400'
					 ), WC()->cart->get_cart_contents_count() ); ?> 
				- <?php echo WC()->cart->get_cart_total(); ?></a>

			</div>
			<?php get_search_form(); ?>

			
		</header>