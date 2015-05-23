<?php
/**
* Google Fonts Implementation
*
* @package Collective
* @since Collective 1.0
*
*/

/**
* Register Google Fonts
*
* @since Collective 1.0
*/
function organic_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'collective_arimo', "$protocol://fonts.googleapis.com/css?family=Arimo:400,400italic,700,700italic" );
	wp_register_style( 'collective_lora', "$protocol://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic" );
	wp_register_style( 'collective_archivo_narrow', "$protocol://fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic,700,700italic" );
	wp_register_style( 'collective_oswald', "$protocol://fonts.googleapis.com/css?family=Oswald:400,300,700" );
}
add_action( 'init', 'organic_register_fonts' );

/**
* Enqueue Google Fonts on Front End
*
* @since Collective 1.0
*/

function organic_fonts() {
	wp_enqueue_style( 'collective_arimo' );
	wp_enqueue_style( 'collective_lora' );
	wp_enqueue_style( 'collective_archivo_narrow' );
	wp_enqueue_style( 'collective_oswald' );
}
add_action( 'wp_enqueue_scripts', 'organic_fonts' );

/**
* Enqueue Google Fonts on Custom Header Page
*
* @since Collective 1.0
*/
function organic_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
	return;
	
	wp_enqueue_style( 'collective_arimo' );
	wp_enqueue_style( 'collective_lora' );
	wp_enqueue_style( 'collective_archivo_narrow' );
	wp_enqueue_style( 'collective_oswald' );
}
add_action( 'admin_enqueue_scripts', 'organic_admin_fonts' );