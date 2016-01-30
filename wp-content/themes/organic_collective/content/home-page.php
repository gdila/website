<?php $featured_page = new WP_Query('page_id='.get_theme_mod('page_feature', '0')); while($featured_page->have_posts()) : $featured_page->the_post(); ?>
<?php global $more; $more = 0; ?>

<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>

<!-- BEGIN .row -->
<div class="row page-section" data-type="background" data-speed="10" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);"<?php } else { ?> style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-bg.jpg);"<?php } ?>>
		
	<!-- BEGIN .content -->
	<div class="content">
		
		<!-- BEGIN .featured-page -->
		<div class="featured-page">
				
			<!-- BEGIN .information -->
			<div class="information wide">
	
				<h2 class="headline text-center"><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
				<a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php esc_html_e("Read More", 'collective'); ?></a>
				
			<!-- END .information -->
			</div>
				
		<!-- END .featured-page -->
		</div>
		
	<!-- END .content -->
	</div>

<!-- END .row -->
</div>

<?php endwhile; ?>