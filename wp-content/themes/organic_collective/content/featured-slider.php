<!-- BEGIN .slideshow -->
<div class="slideshow">

	<!-- BEGIN .flexslider -->
	<div class="flexslider loading" data-speed="<?php echo get_theme_mod('transition_interval', '8000'); ?>" data-transition="<?php echo get_theme_mod('transition_style', 'fade'); ?>">
	
		<div class="preloader"></div>
		
		<!-- BEGIN .slides -->
		<ul class="slides">
		
			<?php $slider = new WP_Query(array('cat'=>get_theme_mod('category_slideshow_home', '0'), 'posts_per_page'=>get_theme_mod('postnumber_slideshow_home', '10'), 'suppress_filters'=>0)); ?>
			<?php if ($slider->have_posts()) : while($slider->have_posts()) : $slider->the_post(); ?>
			<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>
			<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
			
			<li <?php if ( has_post_thumbnail()) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } if ( ! has_post_thumbnail() && ! get_post_meta($post->ID, 'featurevid', true) ) { ?> style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/default-img.svg);"<?php } ?>>
			
				<?php if ( ! empty( $post->post_excerpt ) ) { ?>
					<div class="information">
						<div class="excerpt">
							<h2 class="headline slider-headline"><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php } ?>
			
				<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
					<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
				<?php } else { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'collective' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'featured-large' ); ?></a>
					<?php } else { ?>
						<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'collective' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/default-img.svg" alt="<?php the_title(); ?>" /></a>
					<?php } ?>
				<?php } ?>

			</li>
			
			<?php endwhile; ?>
			<?php endif; ?>
			
		<!-- END .slides -->
		</ul>
		
	<!-- END .flexslider -->
	</div>

<!-- END .slideshow -->
</div>