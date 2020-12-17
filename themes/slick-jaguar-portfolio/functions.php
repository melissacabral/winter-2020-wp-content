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

//Add Widget Areas (dynamic sidebars)
//the next step is to display them in your templates
add_action( 'widgets_init', 'slick_widget_areas' );
function slick_widget_areas(){
	register_sidebar(array(
		'name' 				=> 'Blog Sidebar',
		'id' 				=> 'blog_sidebar',
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title'		=> '</h3>',
	));

	register_sidebar(array(
		'name' 				=> 'Footer Area',
		'id' 				=> 'footer_area',
		'description'		=> 'Appears at the bottom of every screen',
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title'		=> '</h3>',
	));

	register_sidebar(array(
		'name' 				=> 'Front Page Features',
		'id' 				=> 'front_page_features',
		'description'		=> 'This looks best with three widgets',
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title'		=> '</h3>',
	));

	register_sidebar(array(
		'name' 				=> 'Page Widgets',
		'id' 				=> 'page_widgets',
		'description'		=> 'This will only show up on pages that use the custom template "Page with Sidebar"',
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title'		=> '</h3>',
	));
	register_sidebar(array(
		'name' 				=> 'Shop Sidebar',
		'id' 				=> 'shop_sidebar',
		'description'		=> 'shows up on the shop and single-product templates"',
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title'		=> '</h3>',
	));
}//end widget areas function
//This is where we can copy + paste code to eachother - live!


// http://collabedit.com/ueg5y
//Count all real comments on a post
add_filter( 'get_comments_number', 'slick_comments_count' );
function slick_comments_count(){
    //post id
    global $id;
    $comments = get_approved_comments( $id );
    $count = 0;
    
    //go through the comments array, counting each real comment
    foreach( $comments AS $comment ){
        if( $comment->comment_type == 'comment' ){
            $count ++;
        }
    }
    return $count;
}

//Count all the trackbacks and pingbacks on a post

function slick_pings_count(){
    //post id
    global $id;
    $comments = get_approved_comments( $id );
    $count = 0;

    //go through the comments array, counting each real comment
    foreach( $comments AS $comment ){
        if( $comment->comment_type != 'comment' ){
            $count ++;
        }
    }

    return $count;
}

/**
 * Attach any styles and scripts here
 */
add_action('wp_enqueue_scripts', 'slick_scripts');
function slick_scripts(){
	//main stylesheet
	wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), '0.1' );
}

/**
 * Custom image size for portfolio
 */
add_image_size( 'banner', 1200, 400, true );


/**
 * WooCommerce support and features
 */
add_action( 'after_setup_theme', 'mmc_slick_woo' );
function mmc_slick_woo(){
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}


//Replace the <main> content wrapper with our own
//https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<main class="content">';
}

function my_theme_wrapper_end() {
  echo '</main>';
}

/**
 * Show cart contents / total Ajax
 * @see  https://docs.woocommerce.com/document/show-cart-contents-total/
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}



/**
 * Remove all woocommerce styles
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	//unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

/**
 * Examples of re-ordering output by Removing & adding hooked actions
 */
add_action('after_setup_theme', 'mmc_slick_remove_hooks');
function mmc_slick_remove_hooks(){
	//remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	
	//remove the existing price from the single so we can put it back in a different order
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
}

//put the price back in a lower order
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 6);

//no close php