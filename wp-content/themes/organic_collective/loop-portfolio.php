<!-- BEGIN .portfolio-wrap -->
<div class="portfolio-wrap">
	
	<!-- BEGIN .portfolio -->
	<div class="portfolio <?php if ( 'two' == get_theme_mod('portfolio_columns', 'three')) { ?>portfolio-half<?php } if ( 'three' == get_theme_mod('portfolio_columns', 'three')) { ?>portfolio-third<?php } ?>">
		
		<!-- BEGIN .row -->
		<ul id="portfolio-list" class="row">
			
		<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('category_portfolio', '0'), 'posts_per_page'=>999, 'suppress_filters'=>0)); ?>
		<?php if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	
			<!-- BEGIN .portfolio-item -->
			<li class="portfolio-item <?php if ( 'one' == get_theme_mod('portfolio_columns', 'three')) { ?>single<?php } if ( 'two' == get_theme_mod('portfolio_columns', 'three')) { ?>half<?php } if ( 'three' == get_theme_mod('portfolio_columns', 'three')) { ?>third<?php } ?> <?php $allClasses = get_post_class(); foreach ($allClasses as $class) { echo $class . " "; } ?>" data-filter="category-<?php $allClasses = get_post_class(); foreach ($allClasses as $class) { echo $class . " "; } ?>">
			
				<!-- BEGIN .post-holder -->
				<div class="post-holder">
				
					<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
						<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
					<?php } else { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'collective' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-large' ); ?></a>
						<?php } ?>
					<?php } ?>
				
					<?php if ( get_theme_mod('display_portfolio_info', '1') == '1') { ?>
						<div class="excerpt">
							<h2 class="title text-center"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php if ( ! empty( $post->post_excerpt ) ) { ?>
								<?php the_excerpt(); ?>
							<?php } ?>
						</div><!-- END .excerpt -->
					<?php } ?>
				
				<!-- END .post-holder -->
				</div>
			
			<!-- END .portfolio-item -->
			</li>
	
		<?php endwhile; ?>
	
		<!-- END .row -->
		</ul>
	
		<?php else: ?>
		
		<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'collective'); ?></p>
		
		<?php endif; ?>
	
	<!-- END .portfolio -->
	</div>

<!-- END .portfolio-wrap -->
</div>