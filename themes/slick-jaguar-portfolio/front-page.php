<?php get_header(); //requires header.php ?>
		<main class="content">
			
			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class('clearfix'); ?>>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php 
					//supports paged posts
					wp_link_pages( array(
						'next_or_number' => 'number',
					) ); ?>
				</div>
				
			</article>
			<!-- end .post -->

			<?php 
				} //end while
			}else{ ?>

				<h2>No Page to show</h2>

			<?php } //end of The Loop ?>
			
		
			<?php 
			//show the front page widgets if they exist
			if( is_active_sidebar('front_page_features') ){ ?>
				<div class="featured">
					<?php dynamic_sidebar('Front Page Features'); ?>
				</div>
			<?php } ?>


		</main>
		<!-- end .content -->
	
<?php get_footer();  //require footer.php ?>