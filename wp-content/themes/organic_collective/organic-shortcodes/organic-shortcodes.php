<?php

if( !function_exists( 'organic_shortcodes_init' ) ) {
	function organic_shortcodes_init() {

		// Include Shortcode Functions
		include_once( get_template_directory() . '/organic-shortcodes/organic-shortcodes-functions.php' );

	}
}
add_action( 'init', 'organic_shortcodes_init', 20 );

if( !function_exists( 'organic_shortcodes_enqueue_scripts' ) ) {
	function organic_shortcodes_enqueue_scripts() {
	
		// Enqueue Styles
		wp_enqueue_style( 'organic-shortcodes', get_template_directory_uri() . '/organic-shortcodes/css/organic-shortcodes.css', array(), '1.0' );
		wp_enqueue_style( 'organic-shortcodes-ie8', get_template_directory_uri() . '/organic-shortcodes/css/organic-shortcodes-ie8.css', array( 'organic-shortcodes' ), '1.0' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/organic-shortcodes/css/font-awesome.css', array( 'organic-shortcodes' ), '1.0' );
		
		// IE Conditional Styles
		global $wp_styles;
		$wp_styles->add_data('organic-shortcodes-ie8', 'conditional', 'lt IE 9');
		
		// Resgister Scripts
		wp_register_script( 'organic-modal', get_template_directory_uri() . '/organic-shortcodes/js/jquery.modal.min.js', array( 'jquery' ), '20130729' );
	
		// Enqueue Scripts
		wp_enqueue_script( 'organic-shortcodes-script', get_template_directory_uri() . '/organic-shortcodes/js/jquery.shortcodes.js', array( 'jquery', 'organic-modal', 'jquery-ui-accordion', 'jquery-ui-dialog' ), '20130729', true );
		
		// Enqueue jQuery UI Tabs code only if not in the Customizer
		// http://core.trac.wordpress.org/ticket/23225
		global $wp_customize;
		if ( ! isset( $wp_customize ) ) {
			wp_enqueue_script( 'organic-tabs', get_template_directory_uri() . '/organic-shortcodes/js/tabs.js', array( 'jquery', 'jquery-ui-tabs' ), '20130609', true );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'organic_shortcodes_enqueue_scripts' );

