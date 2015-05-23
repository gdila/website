<?php
/**
* Jetpack Compatibility File
* See: http://jetpack.me/
*
* @package Collective
* @since Collective 2.0
*/

/**
* Add support for Jetpack's Featured Content and Infinite Scroll
*/
function collective_jetpack_setup() {

	// SEO recognition of featured videos
	add_filter( 'jetpack_open_graph_tags', 'enhanced_og_video' );
	
}
add_action( 'after_setup_theme', 'collective_jetpack_setup' );