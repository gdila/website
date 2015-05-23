<?php

/* Stylesheets */
function gdila_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
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