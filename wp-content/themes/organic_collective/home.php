<?php
/**
* This template is used to display the home page.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( '0' != get_theme_mod( 'page_feature', '0' ) ) { ?>
	
		<?php get_template_part( 'content/home', 'page' ); ?>
	
	<?php } else { ?>
		
		<?php get_template_part( 'content/home', 'setup' ); ?>
		
	<?php } ?>
	
	<?php if ( '0' != get_theme_mod( 'category_team_home', '0' ) ) { ?>
	<?php if ( '' != get_theme_mod( 'category_team_home', '0' ) ) { ?>
	
	<?php $team = new WP_Query(array('post_type' => 'team')); ?>
	<?php if ( $team->have_posts() ) { ?>
		
	<!-- BEGIN .row -->
	<div class="row team-section" <?php if ( '' != get_theme_mod( 'team_background' ) ) { ?> style="background-image: url(<?php echo get_theme_mod('team_background') ?>); background-repeat: repeat;" <?php } ?>>
		
		<!-- BEGIN .content -->
		<div class="content">
		
			<!-- BEGIN .featured-team -->
			<div class="featured-team">
			
				<?php if ( '' != get_theme_mod('team_title', 'My Team') ) { ?>
					<h4 class="headline text-center"><?php echo get_theme_mod('team_title', 'My Team'); ?></h4>
				<?php } ?>
						
				<?php get_template_part( 'loop', 'team' ); ?>
		
			<!-- END .featured-team -->
			</div>
			
		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>
	
	<?php } ?>
	
	<?php } ?>
	<?php } ?>
	
	<?php if ( '0' != get_theme_mod( 'category_news', '0' ) ) { ?>
	<?php if ( '' != get_theme_mod( 'category_news', '0' ) ) { ?>
		
	<!-- BEGIN .row -->
	<div class="row news-section" <?php if ( '' != get_theme_mod( 'news_background' ) ) { ?> style="background-image: url(<?php echo get_theme_mod('news_background') ?>); background-repeat: repeat;" <?php } ?>>
		
		<!-- BEGIN .content -->
		<div class="content">
		
			<!-- BEGIN .featured-news -->
			<div class="featured-news">
						
				<?php get_template_part( 'content/home', 'news' ); ?>
		
			<!-- END .featured-news -->
			</div>
			
		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>
	
	<?php } ?>
	<?php } ?>
	
	<?php if ( '0' != get_theme_mod( 'page_footer', '0' ) ) { ?>
	<?php if ( '' != get_theme_mod( 'page_footer', '0' ) ) { ?>
	
		<?php get_template_part( 'content/home', 'footer' ); ?>
	
	<?php } ?>
	<?php } ?>

<!-- END .post class -->
</div>

<?php get_footer(); ?>