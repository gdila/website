<?php
/**
* This template is used to display author information, when clicking on an authors name.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content">
	
		<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>
		
			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">
			
				<!-- BEGIN .postarea -->
				<div class="postarea">
				
					<?php get_template_part( 'content/content', 'author' ); ?>
				
				<!-- END .postarea -->
				</div>
		
			<!-- END eleven columns -->
			</div>
		
			<!-- BEGIN .five columns -->
			<div class="five columns">
	
				<?php get_sidebar( 'page' ); ?>
			
			<!-- END .four columns -->
			</div>
			
		<?php else : ?>
		
			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">
			
				<!-- BEGIN .postarea full -->
				<div class="postarea full">
				
					<?php get_template_part( 'content/content', 'author' ); ?>
				
				<!-- END .postarea full -->
				</div>
		
			<!-- END sixteen columns -->
			</div>
			
		<?php endif; ?>
		
		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>
	
<!-- END .post class -->
</div>

<?php get_footer(); ?>