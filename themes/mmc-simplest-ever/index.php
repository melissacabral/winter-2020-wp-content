<?php get_header(); //require header.php ?>
    <main class="content">
      <?php //example of conditional tags
      if( is_front_page() ){
        echo 'This is Front Page';
      }elseif( is_home() ){
        echo 'This is Home (blog)';
      }elseif( is_single() ){
        echo 'this is a single post';
      }elseif( is_page() ){
        echo 'This is a page';
      }  ?>
   

    <?php 
    //The Loop Begin:
    if( have_posts() ){ 
    	while( have_posts() ){
    		the_post();
    ?>
    	
    <article class="post">
        <h2 class="entry-title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
        <div class="entry-content">
      	  <?php the_content(); ?>
        </div>
        <div class="postmeta">
          <span class="author">by: <?php the_author_posts_link(); ?> </span>
          <span class="date"> <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> </span>
          <span class="num-comments"> <?php comments_number(); ?> </span>
          <span class="categories"><?php the_category(); ?></span>
          <span class="tags"><?php the_tags(); ?></span>
        </div>
        <!-- end .postmeta -->
      </article>
      <!-- end .post -->
    
    <?php 
    	} //end while
	}else{
		echo 'No Posts Found.';
    } //end of The Loop ?>	

    </main>
    <!-- end .content -->

   
<?php get_sidebar(); //require sidebar.php ?>
<?php get_footer();  //require footer.php ?>