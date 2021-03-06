<?php get_header(); //requires header.php ?>
		<main class="content">
			<h2>
				Posts filtered by 
				<?php 
				if( is_category() ){
					single_cat_title();
					echo ' category';
				}elseif( is_tag() ){
					single_tag_title();
					echo ' tag';
				}elseif( is_date() ){
					the_archive_title();
				}
				?>
			</h2>


			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class('clearfix'); ?>>
				
			<?php slick_post_thumbnail(); ?>

				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="entry-content">
					<?php 
					//short version of the_content()
					the_excerpt(); ?>
				</div>
				<div class="postmeta">
					<span class="author">by: <?php the_author(); ?> </span>
					<span class="date"> <?php the_time('F j, Y'); ?> </span>
					<span class="num-comments"><?php comments_number(); ?></span>
					<span class="categories"><?php the_category(); ?></span>
					<?php the_tags('<span class="tags">', ', ', '</span>'); ?>
				</div>
				<!-- end .postmeta -->
			</article>
			<!-- end .post -->

			<?php comments_template(); ?>

			<?php 
				} //end while
				?>
			<div class="pagination">
				<?php 
				//archive pagination
				//previous_posts_link('&larr; Newer Posts'); 
				//next_posts_link('Older Posts &rarr;'); 
				
				//number style
				the_posts_pagination(array(
					'mid_size' => 3,
					'prev_text' => '&larr; Previous',
					'next_text' => 'Next &rarr;',
				));
				?>
			</div>

			<?php
			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
		
<?php get_sidebar(); //require sidebar.php ?>		
<?php get_footer();  //require footer.php ?>