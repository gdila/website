<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme Setup
/*-----------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'collective_setup' ) ) :

function collective_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'collective', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'collective-featured-large', 2400, 1200, true ); // Large Featured Image
	add_image_size( 'collective-featured-medium', 1120, 640, true ); // Medium Featured Image
	add_image_size( 'collective-featured-small', 640, 640, true ); // Small Featured Image

	// Create Menus
	register_nav_menus( array(
		'header-menu' => esc_html__( 'Header Menu', 'collective' ),
		'social-menu' => esc_html__( 'Social Menu', 'collective' ),
	));
	
	// Custom Header
	$defaults = array(
		'width'                 => 60,
		'height'                => 60,
		'default-image'			=> '',
		'flex-height'           => true,
		'flex-width'            => true,
		'default-text-color'    => 'ffffff',
		'header-text'           => false,
		'uploads'               => true,
	);
	add_theme_support( 'custom-header', $defaults );
	
	// Custom Background
	$defaults = array(
		'default-color'          => 'F9F9F9',
	);
	add_theme_support( 'custom-background', $defaults );
}
endif; // collective_setup
add_action( 'after_setup_theme', 'collective_setup' );

/*-----------------------------------------------------------------------------------------------------//
	Theme Updater
-------------------------------------------------------------------------------------------------------*/

function collective_theme_updater() {
	require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'collective_theme_updater' );

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function collective_cat_id_to_name( $id ) {
	$cat = get_category( $id );
	if ( is_wp_error( $cat ) )
		return false;
	return $cat->cat_name;
}

/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('collective_enqueue_scripts') ) {
	function collective_enqueue_scripts() {
	
		// Enqueue Styles
		wp_enqueue_style( 'collective-style', get_stylesheet_uri() );
		wp_enqueue_style( 'collective-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'collective-style' ), '1.0' );
		
		// Resgister Scripts
		wp_register_script( 'collective-fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'collective-hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'collective-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'collective-hover' ), '20130729' );
		wp_register_script( 'collective-isotope', get_template_directory_uri() . '/js/jquery.isotope.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'collective-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '20130729' );
	
		// Enqueue Scripts
		wp_enqueue_script( 'collective-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		wp_enqueue_script( 'collective-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'collective-superfish', 'collective-fitvids', 'collective-isotope', 'collective-fittext', 'jquery-masonry' ), '20130729', true );
		wp_enqueue_script( 'collective-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130729', true );
		
		// IE Conditional Scripts
		global $wp_scripts;
		$wp_scripts->add_data( 'collective-html5shiv', 'conditional', 'lt IE 9' );
		
		// Load Flexslider on front page and slideshow page template
		if( is_home() || is_front_page() || is_single() || is_page_template('template-slideshow.php') || is_page_template('template-featured-slider.php') || is_page_template('template-blog.php') ) {
			wp_enqueue_script( 'collective-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20130729' );
		}
		
		// Load Equal Height script on home page template only
		if ( ( is_home() || is_front_page() ) ) {
			wp_enqueue_script( 'collective-equal-heights', get_template_directory_uri() . '/js/jquery.equalHeight.js', array( 'jquery' ), '20130625' );
		}
		
		// Load Twitter on single pages
		if ( is_singular() ) {
			wp_enqueue_script( 'collective-twitter', get_template_directory_uri() . '/js/twitter.min.js', array( 'jquery' ), '20131004' );
		}
	
		// Load single scripts only on single pages
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	    	wp_enqueue_script( 'comment-reply' );
	    }
	}
}
add_action('wp_enqueue_scripts', 'collective_enqueue_scripts');

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Integration			       	     	 
-------------------------------------------------------------------------------------------------------*/

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div class="row">
		<div class="content">
		
			<div class="eleven columns">
				<div class="postarea">
    <?php
}
function mytheme_close_woocommerce_content_wrappers() {
	?>
	    		</div>
	    	</div>
	 
	        <div class="five columns">
	        	<?php get_sidebar( 'post' ); ?>
	        </div>
        
        </div>
 	</div>
    <?php
}
add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// WooCommerce default product columns
function loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_widgets_init() {
	register_sidebar(array(
		'name'=> esc_html__( "Page Sidebar", 'collective' ),
		'id' => 'page-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> esc_html__( "Blog Sidebar", 'collective' ),
		'id' => 'blog-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> esc_html__( "Post Sidebar", 'collective' ),
		'id' => 'post-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> esc_html__( "Left Sidebar", 'collective' ),
		'id' => 'left-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> esc_html__( "Footer Widgets", 'collective' ),
		'id' => 'footer',
		'before_widget'=>'<div id="%1$s" class="widget %2$s"><div class="footer-widget">',
		'after_widget'=>'</div></div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
}
add_action( 'widgets_init', 'organic_widgets_init' );

/*-----------------------------------------------------------------------------------------------------//
	Add Stylesheet To Visual Editor
-------------------------------------------------------------------------------------------------------*/
	
add_action( 'widgets_init', 'organic_add_editor_styles' );
/**
* Apply theme's stylesheet to the visual editor.
*
* @uses add_editor_style() Links a stylesheet to visual editor
* @uses get_stylesheet_uri() Returns URI of theme stylesheet
*/
function organic_add_editor_styles() {
	add_editor_style( 'css/style-editor.css' );
}
	
/*----------------------------------------------------------------------------------------------------//
/*	Content Width
/*----------------------------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 800;

/**
 * Adjust content_width value based on the presence of widgets
 */
function collective_content_width() {
	if ( ! is_active_sidebar( 'post-sidebar' ) || is_active_sidebar( 'page-sidebar' ) || is_active_sidebar( 'blog-sidebar' ) ) {
		global $content_width;
		$content_width = 1200;
	}
}
add_action( 'template_redirect', 'collective_content_width' );
	
/*-----------------------------------------------------------------------------------------------------//
	Comments Function
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'collective_comment' ) ) :
function collective_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'collective' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'collective' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
	?>
	<li <?php comment_class(); ?> id="<?php echo esc_attr( 'li-comment-' . get_comment_ID() ); ?>">

		<article id="<?php echo esc_attr( 'comment-' . get_comment_ID() ); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'collective' ),
							sprintf( '<span class="fn">%s</span>', wp_kses_post( get_comment_author_link() ) ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s', 'collective' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'collective' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'collective' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( esc_html__( 'Edit', 'collective' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for collective_comment()

/*-----------------------------------------------------------------------------------------------------//	
	Custom Excerpt Length		       	     	 
-------------------------------------------------------------------------------------------------------*/

function collective_excerpt_length( $length ) {
	return 72;
}
add_filter( 'excerpt_length', 'collective_excerpt_length', 999 );

function collective_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. esc_html__('Read More', 'collective') .'</a>';
}
add_filter('excerpt_more', 'collective_excerpt_more');

/*-----------------------------------------------------------------------------------------------------//	
	Add Excerpt To Pages		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action( 'init', 'collective_add_excerpts_to_pages' );
function collective_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*-----------------------------------------------------------------------------------------------------//
/*	Pagination Function
/*-----------------------------------------------------------------------------------------------------*/

function collective_get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => esc_html__('&laquo;', 'collective'),
		'next_text' => esc_html__('&raquo;', 'collective'),
		'total' => $wp_query->max_num_pages
	) );
}

/*-----------------------------------------------------------------------------------------------------//
/*	Custom Page Links
/*-----------------------------------------------------------------------------------------------------*/

function collective_wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; 

    $args['next_or_number'] = 'number'; // Keep numbering for the main part
    if (!$more)
        return $args;

    if($page-1) // There is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';

    if ($page<$numpages) // There is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after'];

    return $args;
}

add_filter('wp_link_pages_args', 'collective_wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init_featurevid");
add_action('save_post', 'save_featurevid');

function admin_init_featurevid(){
	add_meta_box("featurevid-meta", esc_html__("Featured Video Embed Code", 'collective'), "meta_options_featurevid", "post", "normal", "high");
}

function meta_options_featurevid(){
	global $post;
	$custom = get_post_custom($post->ID);
	$featurevid = isset( $custom["featurevid"] ) ? esc_attr( $custom["featurevid"][0] ) : '';

	echo '<textarea name="featurevid" cols="60" rows="4" style="width:97.6%" />'.$featurevid.'</textarea>';
}

function save_featurevid($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if ( isset($_POST["featurevid"]) ) { 
		update_post_meta($post->ID, "featurevid", $_POST["featurevid"]); 
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	Add Home Link To Custom Menu		       	     	 
-------------------------------------------------------------------------------------------------------*/

function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Strip inline width and height attributes from WP generated images		       	     	 
-------------------------------------------------------------------------------------------------------*/
 
function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); 
	return $html; 
	}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/*-----------------------------------------------------------------------------------------------------//
	Body Class
-------------------------------------------------------------------------------------------------------*/

function collective_body_class( $classes ) {
	if ( is_singular() )
		$classes[] = 'collective-singular';

	if ( is_active_sidebar( 'right-sidebar' ) )
		$classes[] = 'collective-right-sidebar';

	if ( '' != get_theme_mod( 'background_image' ) ) {
		// This class will render when a background image is set
		// regardless of whether the user has set a color as well.
		$classes[] = 'collective-background-image';
	} else if ( ! in_array( get_background_color(), array( '', get_theme_support( 'custom-background', 'default-color' ) ) ) ) {
		// This class will render when a background color is set
		// but no image is set. In the case the content text will
		// Adjust relative to the background color.
		$classes[] = 'collective-relative-text';
	}

	return $classes;
}
add_action( 'body_class', 'collective_body_class' );


/*-----------------------------------------------------------------------------------------------------//
	Filters wp_title to print a neat <title> tag based on what is being viewed.
-------------------------------------------------------------------------------------------------------*/

function collective_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'collective' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'collective_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------------------------//
	Includes
-------------------------------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/includes/jetpack.php' );
require_once( get_template_directory() . '/includes/customizer.php' );
require_once( get_template_directory() . '/includes/typefaces.php' );
require_once( get_template_directory() . '/includes/post-type-team.php'); 	// Get Custom Post Type : Team
include_once( get_template_directory() . '/organic-shortcodes/organic-shortcodes.php' );