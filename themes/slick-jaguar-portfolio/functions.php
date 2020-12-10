<?php
//activate customizer > background options
add_theme_support( 'custom-background' );

//better SEO from unique <title> tags
//developer: remove any <title> tag from your header.php
add_theme_support('title-tag');

//activate better markup on built-in forms and galleries
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 
	'caption', 'style', 'script' ) );

//better feeds - useful for blogs and news sites
add_theme_support( 'automatic-feed-links' );

//activate "featured image"
// run the_post_thumbnail() in your template to display them
add_theme_support( 'post-thumbnails' );

//custom header image
//set the defaults here
//make sure to add the embedded CSS in header.php 
$args = array(
	'width' => 1200,
	'height' => 800,
	'default-text-color' => '#474747',
);
add_theme_support( 'custom-header', $args );


//custom logo
//make sure to add the_custom_logo() in header.php 
$args = array(
	'width' => 300,
	'height' => 300,
	'flex-height' => true,
    'flex-width'  => false,
);
add_theme_support( 'custom-logo' );


//custom function example
//display a featured image with a link to the single post
function slick_post_thumbnail( $size = 'thumbnail' ){
	if( has_post_thumbnail() ){ ?>
		<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( $size ); ?>
		</a>
<?php } //end if has featured image
}

//hook example: filter the length of the excerpt
function slick_excerpt_length(){
	if( is_search() ){
		return 20;
	}else{
		return 60;
	}
}
add_filter( 'excerpt_length', 'slick_excerpt_length' );



//improve the [...]
function slick_readmore(){
	return '&hellip; <a href="' . get_the_permalink() . '" class="button">Keep Reading</a>';
}
add_filter( 'excerpt_more', 'slick_readmore' );


//action hook example
//hook onto loop_start for some custom breadcrumbs
function slick_crumbs(){
	echo 'these are some crumbs';
}
//add_action( 'loop_start', 'slick_crumbs' );


//Add Menu Support
//step one is to register the menu locations. 
//the next step is to display them in your templates (header.php)
add_action( 'init', 'slick_menu_locations' );
function slick_menu_locations(){
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
	) );
}

//no close php