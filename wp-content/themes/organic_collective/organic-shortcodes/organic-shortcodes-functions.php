<?php

/*-----------------------------------------------------------------------------------------------------//	
	Toggle Box Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_toggle( $atts, $content = null ) {

    extract(shortcode_atts(array(
    	'title'	=> 'Toggle Item',
   	), $atts));
	
	$out = '
		<div class="toggle-box">
		<p class="toggle-trigger"><a href="javascript:void(0);">' .$title. '</a></p>
		<div class="toggle-section"><p>' .do_shortcode($content). '</p></div>
		</div>';

    return $out;
}
add_shortcode('toggle', 'organic_toggle');

/*-----------------------------------------------------------------------------------------------------//	
	Horizontal Rating Bar Shortcode	       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_rating($atts) {  
    extract(shortcode_atts(array(
    	"title" => '',  
        "number" => '50'  
    ), $atts));  
    return 
    '<div class="rating-container">
    	<p class="rating-title">'.$title.'</p>
    	<div class="bar-rating"><span style="width:'.$number.'%;"></span></div>
    </div>';  
}
add_shortcode("rating", "organic_rating");

/*-----------------------------------------------------------------------------------------------------//	
	Modal Box Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_modal( $atts, $content = null ) {

    extract(shortcode_atts(array(
    	'title'	=> 'Open Modal',
    	'tag'	=> 'organic-modal',
	    'color'	=> '',
	    'size'	=> '',
	    'align'	=> '',
    ), $atts));

	$style = ($color) ? ' '.$color.'-btn' : '';
	$align = ($align) ? ' align-'.$align : '';
	
	$out = '
		<div class="modal-btn '.$align.'"><a class="organic-btn '.$style.' '.$size.'-btn '.$align.'" href="#'.$tag.'" rel="modal:open"><span class="btn-holder">' .$title. '</span></a></div>
		<div id="' .$tag. '" class="organic-modal" style="display: none;"><span class="modal-title">' .$title. '</span>' .do_shortcode($content). '</div>';

    return $out;
}
add_shortcode('modal', 'organic_modal');

/*-----------------------------------------------------------------------------------------------------//	
	Accordion Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_accordion($atts, $content = null) {
    extract(shortcode_atts(array(
        "collapsible" => "false"
    ), $atts));

    $GLOBALS["section_count"] = 0;
    // Get the content
    do_shortcode($content);
    // Generate output
    if (is_array( $GLOBALS["sections"] )) {
        foreach ($GLOBALS["sections"] as $section) {
            $panes[] = '<p><a href="#'. str_replace(" ", "-", strtolower($section["name"])) .'">'. $section["name"] .'</a></p>
            <div id="'. str_replace(" ", "-", strtolower($section["name"])) .'">
            	'. do_shortcode($section["content"]) .'
            </div>';
        }
    }
    $output = "\n".'<div class="organic-accordion">'. implode("\n", $panes) .'</div>'."\n";
    
    unset( $GLOBALS["sections"] ); // Clear array fix for multiple shorcodes
    return $output;
}
add_shortcode("accordion", "organic_accordion");

function organic_accordion_section($atts, $content = null) {
    extract(shortcode_atts(array(
        "name" => "Accordion Section Name"
    ), $atts));
   
    $x = $GLOBALS["section_count"];
    $GLOBALS["sections"][$x] = array(
        "name"   => sprintf( $name, $GLOBALS["section_count"] ),
        "content" => $content
    );
    $GLOBALS["section_count"] += 1;
}
add_shortcode("section", "organic_accordion_section");

/*-----------------------------------------------------------------------------------------------------//	
	Tabs Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_tab_group( $atts, $content ){

	$GLOBALS['tab_count'] = 0;

	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'] ) ){
		$int = '1';
		foreach( $GLOBALS['tabs'] as $tab ){
			
			$tabs[] = '<li><a href="#tabs-'.$int.'">'.$tab['title'].'</a></li>';
			
			$panes[] = '
			<div id="tabs-'.$int.'">
				<h3>'.$tab['title'].'</h3>
				'.$tab['content'].'
			</div>';
			
			$int++;
		}
		
		$return = "\n".'
		<div class="organic-tabs">
			<ul>'.implode( "\n", $tabs ).'</ul>
			'."\n".' '.implode( "\n", $panes ).'
		</div>'."\n";		
	}
	
	unset( $GLOBALS['tabs'] ); // Clear array fix for multiple shorcodes
	return $return;
}
add_shortcode( 'tabs', 'organic_tab_group' );	

function organic_tab( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => 'Tab %d'
	), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );
	
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'organic_tab' );


/*-----------------------------------------------------------------------------------------------------//	
	Icons Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_icons( $atts, $content = null ) {

    extract(shortcode_atts(array(
	    'style'	=> '',
	    'color'	=> '',
    ), $atts));
	
	$out = '<span class="organic-icon"><i class="fa fa-'.$style.'" style="color: #'.$color.';"></i> ' .do_shortcode($content). '</span>';

    return $out;
}
add_shortcode('icon', 'organic_icons');

/*-----------------------------------------------------------------------------------------------------//	
	Headline Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_headline( $atts, $content = null ) {

    extract(shortcode_atts(array(
	    'align'	=> '',
	    'color'	=> '',
	    'size'	=> '',
    ), $atts));
	
	$out = '<h2 class="organic-headline '.$size.'-headline" style="text-align: '.$align.'; color: #'.$color.';">' .do_shortcode($content). '</h2>';

    return $out;
}
add_shortcode('headline', 'organic_headline');

/*-----------------------------------------------------------------------------------------------------//	
	Button Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_button( $atts, $content = null ) {

    extract(shortcode_atts(array(
	    'link'	=> '#',
	    'target'=> '',
	    'color'	=> '',
	    'size'	=> '',
	    'align'	=> '',
    ), $atts));

	$style = ($color) ? ' '.$color.'-btn' : '';
	$align = ($align) ? ' align-'.$align : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<div class="btn-container '.$align.'"><a' .$target. ' class="organic-btn '.$style.' '.$size.'-btn '.$align.'" href="' .$link. '"><span class="btn-holder">' .do_shortcode($content). '</span></a></div>';

    return $out;
}
add_shortcode('button', 'organic_button');

/*-----------------------------------------------------------------------------------------------------//	
	Message Box Shortcode		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_box( $atts, $content = null ) {

    extract(shortcode_atts(array(
	    'color'	=> '',
	    'align'	=> '',
    ), $atts));

	$style = ($color) ? ' '.$color.'-box' : '';
	$align = ($align) ? ' text-'.$align : '';
	
	$out = '<div class="organic-box '.$style.$align.'"><a href="#blank" class="close"><i class="fa fa-times"></i></a><div class="box-content">' .do_shortcode($content). '</div></div>';
	
    return $out;
}
add_shortcode('box', 'organic_box');

/*-----------------------------------------------------------------------------------------------------//	
	Column Shortcodes		       	     	 
-------------------------------------------------------------------------------------------------------*/

function organic_one_third( $atts, $content = null ) {
   return '<div class="organic-column one-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'organic_one_third');

function organic_one_third_last( $atts, $content = null ) {
   return '<div class="organic-column one-third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'organic_one_third_last');

function organic_two_third( $atts, $content = null ) {
   return '<div class="organic-column two-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'organic_two_third');

function organic_two_third_last( $atts, $content = null ) {
   return '<div class="organic-column two-third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'organic_two_third_last');

function organic_one_half( $atts, $content = null ) {
   return '<div class="organic-column one-half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'organic_one_half');

function organic_one_half_last( $atts, $content = null ) {
   return '<div class="organic-column one-half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'organic_one_half_last');

function organic_one_fourth( $atts, $content = null ) {
   return '<div class="organic-column one-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'organic_one_fourth');

function organic_one_fourth_last( $atts, $content = null ) {
   return '<div class="organic-column one-fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'organic_one_fourth_last');

function organic_three_fourth( $atts, $content = null ) {
   return '<div class="organic-column three-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'organic_three_fourth');

function organic_three_fourth_last( $atts, $content = null ) {
   return '<div class="organic-column three-fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'organic_three_fourth_last');

function organic_one_fifth( $atts, $content = null ) {
   return '<div class="one-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'organic_one_fifth');

function organic_one_fifth_last( $atts, $content = null ) {
   return '<div class="organic-column one-fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'organic_one_fifth_last');

function organic_two_fifth( $atts, $content = null ) {
   return '<div class="organic-column two-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'organic_two_fifth');

function organic_two_fifth_last( $atts, $content = null ) {
   return '<div class="organic-column two-fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'organic_two_fifth_last');

function organic_three_fifth( $atts, $content = null ) {
   return '<div class="organic-column three-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'organic_three_fifth');

function organic_three_fifth_last( $atts, $content = null ) {
   return '<div class="organic-column three-fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'organic_three_fifth_last');

function organic_four_fifth( $atts, $content = null ) {
   return '<div class="organic-column four-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'organic_four_fifth');

function organic_four_fifth_last( $atts, $content = null ) {
   return '<div class="organic-column four-fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'organic_four_fifth_last');

function organic_one_sixth( $atts, $content = null ) {
   return '<div class="organic-column one-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'organic_one_sixth');

function organic_one_sixth_last( $atts, $content = null ) {
   return '<div class="organic-column one-sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'organic_one_sixth_last');

function organic_five_sixth( $atts, $content = null ) {
   return '<div class="organic-column five-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'organic_five_sixth');

function organic_five_sixth_last( $atts, $content = null ) {
   return '<div class="organic-column five-sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'organic_five_sixth_last');

/*-----------------------------------------------------------------------------------------------------//	
	Empty paragraph tag and line break fix for shortcodes		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_filter('the_content', 'shortcode_empty_paragraph_fix');

function shortcode_empty_paragraph_fix($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}