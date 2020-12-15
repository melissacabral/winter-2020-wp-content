<?php get_header(); //requires header.php ?>
		<main class="content">
			
			<?php //The Loop
			if( have_posts() ){	
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
						
						<?php 
						//grab the subtitle custom field
						$subtitle = get_post_meta(  $id , 'subtitle', true ); 
						if( $subtitle  ){  ?>
							<h3><?php echo $subtitle; ?></h3>
						<?php } ?>

					</div>

				</div><!-- end .overlay -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				
			</article>
			<!-- end .post -->

			<?php 
				} //end while
			?>

			<div class="pagination">
				<?php 
				//singular pagination
				previous_post_link( '%link', '&larr; %title' );
				next_post_link( '%link', '%title &rarr;' );
				?>
			</div>

			<?php 
			}else{ ?>

				<h2>No Page to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
	
<?php get_footer();  //require footer.php ?>