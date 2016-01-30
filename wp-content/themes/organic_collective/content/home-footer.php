<?php $featured_page = new WP_Query('page_id='.get_theme_mod('page_footer', '0')); while($featured_page->have_posts()) : $featured_page->the_post(); ?>
<?php global $more; $more = 0; ?>

<!-- BEGIN .row -->
<div class="row footer-section">
		
	<!-- BEGIN .content -->
	<div class="content">
		
		<!-- BEGIN .featured-page -->
		<div class="featured-page">
			
			<!-- BEGIN .holder -->
			<div class="holder">
				
				<!-- BEGIN .information -->
				<div class="information wide">
				
					<!-- BEGIN .padding -->
					<div class="padding">
					
						<h2 class="headline text-center"><?php the_title(); ?></h2>
						<?php the_content(__("Continue Reading", 'collective')); ?>
					
					<!-- END .padding -->
					</div>
					
				<!-- END .information -->
				</div>
			
			<!-- END .holder -->
			</div>
				
		<!-- END .featured-page -->
		</div>
		
	<!-- END .content -->
	</div>

<!-- END .row -->
</div>

<?php endwhile; ?>