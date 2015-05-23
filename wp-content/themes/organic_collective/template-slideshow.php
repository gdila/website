<?php
/**
Template Name: Slideshow
*
* This template is used to display a page with a slideshow.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<h1 class="headline page-headline text-center"><?php the_title(); ?></h1>

	<!-- BEGIN .gallery-slider -->
	<div class="gallery-slider">

		<?php get_template_part( 'content/gallery', 'slider' ); ?>
	
	<!-- END .gallery-slider -->
	</div>
	
	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">
		
		<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>
			
			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">
	
				<!-- BEGIN .postarea -->
				<div class="postarea">
		
					<?php get_template_part( 'loop', 'page' ); ?>
				
				<!-- END .postarea -->
				</div>
			
			<!-- END .eleven columns -->
			</div>
			
			<!-- BEGIN .five columns -->
			<div class="five columns">
			
				<?php get_sidebar(); ?>
				
			<!-- END .five columns -->
			</div>
	
		<?php else : ?>
	
			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">
	
				<!-- BEGIN .postarea full -->
				<div class="postarea full">
				
					<?php get_template_part( 'loop', 'page' ); ?>
				
				<!-- END .postarea full -->
				</div>
			
			<!-- END .sixteen columns -->
			</div>
	
		<?php endif; ?>
		
		<!-- END .content -->
		</div>
		
	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>