<?php

/* Stylesheets */
function gdila_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
	wp_enqueue_script( 'gdila-custom', get_stylesheet_directory_uri() . '/js/gdila.custom.js', array( 'collective-custom' ) );
}
add_action( 'wp_enqueue_scripts', 'gdila_enqueue_styles' );


/* Google Fonts */
function gdila_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	/* Remove default fonts */
	wp_dequeue_style( 'collective_arimo' );
	wp_deregister_style( 'collective_arimo' );
	wp_dequeue_style( 'collective_lora' );
	wp_deregister_style( 'collective_lora' );
	wp_dequeue_style( 'collective_archivo_narrow' );
	wp_deregister_style( 'collective_archivo_narrow' );
	wp_dequeue_style( 'collective_oswald' );
	wp_deregister_style( 'collective_oswald' );

	/* Load new fonts */
	wp_register_style( 'roboto', "$protocol://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic" );
	wp_enqueue_style( 'roboto' );
}
add_action( 'wp_enqueue_scripts', 'gdila_fonts');


/* Customize the theme setup */
function collective_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'organicthemes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'collective-featured-large', 2400, 1200, true ); // Large Featured Image
	add_image_size( 'collective-featured-medium', 1120, 640, true ); // Medium Featured Image
	add_image_size( 'collective-featured-small', 320, 320, false ); // Small Featured Image

	// Create Menus
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'organicthemes' ),
		'social-menu' => __( 'Social Menu', 'organicthemes' ),
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


/* Customize Excerpts */
function custom_excerpt($text) {  // custom 'read more' link
   if (strpos($text, '[...]')) {
      $excerpt = strip_tags(str_replace('[...]', '&nbsp;<a href="'.get_permalink().'">Read more</a>', $text), "<a>");
   } else {
      $excerpt = '' . strip_tags($text) . '&nbsp;<a href="'.get_permalink().'">Read more</a>';
   }
   return $excerpt;
}
add_filter('the_excerpt', 'custom_excerpt');


/* Pull Quote */
function pullquote_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'align' => 'right',
		'cite' => ''
	), $atts );

	return '<blockquote class="pull-quote align' . esc_attr($a['align']) . '"><p>' . $content . '</p><cite>~ ' . esc_attr($a['cite']) . '</cite></blockquote>';
}
add_shortcode( 'pullquote', 'pullquote_shortcode' );