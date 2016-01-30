<?php
/**
* The Header for our theme.
* Displays all of the <head> section and everything up till <div id="wrap">
*
* @package Collective
* @since Collective 1.0
*
*/
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<meta charset="<?php bloginfo('charset'); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">

<?php get_template_part( 'style', 'options' ); ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo esc_url( bloginfo('pingback_url') ); ?>">

<!-- Social Buttons -->
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrap -->
<div id="wrap">

	<!-- BEGIN .container -->
	<div class="container">
	
		<!-- BEGIN #header -->
		<div id="header">
			
			<!-- BEGIN .row -->
			<div class="row">
			
				<!-- BEGIN #header-bar -->
				<div id="header-bar">
			
					<!-- BEGIN #logo -->
					<div id="logo">
					
					<?php if ( get_theme_mod( 'collective_logo', get_template_directory_uri() . '/images/logo.png' ) ) { ?>
					
						<h1 id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'collective_logo', get_template_directory_uri() . '/images/logo.png' ) ); ?>" alt="" />
								<span class="logo-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></span>
							</a>
						</h1>
						
						<?php if ( get_theme_mod('display_site_title', '1') == '1' ) { ?>
						
						<div id="masthead">
							<h1 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a></span></h1>
						</div>
						
						<?php } ?>
						
					<?php } else { ?>
					
						<div id="masthead">
							<h1 class="site-title no-logo"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a></span></h1>
						</div>
						
					<?php } ?>
					
					<!-- END #logo -->
					</div>
					
					<span class="menu-toggle"><i class="fa fa-bars"></i></span>
					
				<!-- END #header-bar -->
				</div>
			
				<!-- BEGIN #navigation -->
				<nav id="navigation" class="navigation-main" role="navigation">

					<?php if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'title_li' => '',
							'depth' => 4,
							'container_class' => '',
							'menu_class'      => 'menu'
							)
						);
					} else { ?>
						<div class="menu-container"><ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul></div>
					<?php } ?>
				
				<!-- END #navigation -->
				</nav>
			
			<!-- END .row -->
			</div>
		
		<!-- END #header -->
		</div>