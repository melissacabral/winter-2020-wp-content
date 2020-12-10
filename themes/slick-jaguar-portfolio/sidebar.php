<aside class="sidebar">

	<?php 
	//display the widget area if it exists. otherwise show fallback sections
	if( ! dynamic_sidebar( 'Blog Sidebar' ) ){ ?>

	<section id="categories" class="widget">
		<h3 class="widget-title"> Categories </h3>
		<ul>
			<?php 
			wp_list_categories( array(
				'title_li' 		=> '',
				'show_count' 	=> true,
			) ); 
			?>
		</ul>
	</section>
	<section id="archives" class="widget">
		<h3 class="widget-title"> Archives </h3>
		<ul>
			<?php wp_get_archives( array(
				'type' => 'monthly',
			) ); ?>
		</ul>
	</section>
	<section id="tags" class="widget">
		<h3 class="widget-title"> Tags </h3>

		<?php wp_tag_cloud( array(
			'format' => 'list', //default flat
			'largest' => 1,
			'smallest'	=> 1,
			'unit' => 'em',
		) ); ?>
	</section>
	<section id="meta" class="widget">
		<h3 class="widget-title"> Meta </h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
		</ul>
	</section>

<?php } //end if no widget area ?>

</aside><!-- end .sidebar -->