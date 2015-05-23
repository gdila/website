<?php
/**
* This page template is used to display a 404 error message.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<!-- BEGIN .hentry -->
<div class="hentry">

	<h1 class="headline page-headline text-center"><?php _e("Not Found, Error 404", 'organicthemes'); ?></h1>
		
	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content">
	
		<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>
		
			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">
		
			<div class="postarea">
				<p><?php _e("The page you are looking for no longer exists.", 'organicthemes'); ?></p>
			</div>
			
			<!-- END .eleven columns -->
			</div>
			
			<!-- BEGIN .five columns -->
			<div class="five columns">
			
				<?php get_sidebar( 'page' ); ?>
				
			<!-- END .five columns -->
			</div>
		
		<?php else : ?>
		
			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">
		
			<div class="postarea full">
				<p><?php _e("The page you are looking for no longer exists.", 'organicthemes'); ?></p>
			</div>
			
			<!-- END .sixteen columns -->
			</div>
			
		<?php endif; ?>
		
		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>

<!-- END .hentry -->
</div>

<?php get_footer(); ?>