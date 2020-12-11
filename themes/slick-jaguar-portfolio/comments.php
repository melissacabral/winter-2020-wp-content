<?php 
/*
This file loads when you call comments_template() in your theme
*/ 

//exit the file if a password is required
if( post_password_required() ){
	return;
}
?>
<section class="comments">
	<h3><?php comments_number( 'No comments yet', 'One comment on this post', '% Comments on this post' ); ?></h3>

	<ol class="comment-list">
		<?php wp_list_comments(array(
			'type' => 'comment', //hide pings
			'avatar_size' => 50,
		)); ?>
	</ol>

</section>

<section class="pagination">
	<?php previous_comments_link(); ?>
	<?php next_comments_link(); ?>
</section>

<section class="comment-form">
	<?php comment_form(); ?>
</section>


<?php 
//count the pings
$pingscount = slick_pings_count(); 
if( $pingscount >= 1 ){ ?>
<section class="pings">
	<h3>
	<?php echo $pingscount == 1 ? 'One site Mentions ' : "$pingscount Sites mention "; ?>
	this article</h3>

	<ol>
		<?php wp_list_comments(array(
			'type' 			=> 'pings', //pingbacks and trackbacks
			'short_ping' 	=> true,
		)); ?>
	</ol>
</section>
<?php } //end if there are pings ?>