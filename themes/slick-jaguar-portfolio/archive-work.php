<?php get_header(); //requires header.php ?>
		<main class="content">
			
			<?php //The Loop
			if( have_posts() ){	
			?>
			<h1 class="page-heading"><?php post_type_archive_title(); ?></h1>
			<?php
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class('clearfix'); ?>>
				<div class="overlay">
					
					<?php the_post_thumbnail( 'banner' ) ?>
					<div class="info">
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<h3><?php the_field('client'); ?></h3>
					</div>

				</div><!-- end .overlay -->

				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
				
			</article>
			<!-- end .post -->

			<?php 
				} //end while
			?>

			<div class="pagination">
				<?php 
				//archive pagination
				previous_posts_link();
				next_posts_link();
				?>
			</div>

			<?php 
			}else{ ?>

				<h2>No Page to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
	
<?php get_footer();  //require footer.php ?>