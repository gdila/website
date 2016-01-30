<!-- BEGIN .members -->
<div class="members">

<?php if ( is_home() && '0' != get_theme_mod( 'category_team_home', '0' ) || is_home() && '' != get_theme_mod( 'category_team_home', '0' ) ) { ?>

	<?php $team = new WP_Query(array(
		'post_type' => 'team', 
		'posts_per_page' => 999, 
		'suppress_filters'=>0, 
		'tax_query' => array(
	        array(
		        'taxonomy' => 'category-team',
		        'field' => 'id',
		        'terms' => get_theme_mod( 'category_team_home', '0' ),
	        ))
	    )); ?>
	    
<?php } else { ?>

	<?php $team = new WP_Query(array('post_type' => 'team', 'posts_per_page' => 999, 'suppress_filters'=>0)); ?>
	
<?php } ?>

<?php if ($team->have_posts()) : while($team->have_posts()) : $team->the_post(); ?>
<?php global $more; $more = 0; ?>
	
<!-- BEGIN .four columns -->
<div class="four columns">
	
	<!-- BEGIN .holder -->
	<div class="holder">
		
		<?php if ( has_post_thumbnail() ) { ?>
			<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'collective' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-small' ); ?></a>
		<?php } else { ?>
			<div class="feature-img"><img src="<?php echo get_template_directory_uri(); ?>/images/default-profile.jpg" alt="<?php the_title(); ?>" /></div>
		<?php } ?>
		
		<!-- BEGIN .information -->
		<div class="information">
		
			<h2 class="title text-center"><?php the_title(); ?></h2>
			
			<?php if ( ! empty( $post->post_excerpt ) || get_post_meta($post->ID, 'team_title', true) ) { ?>
				
				<div class="excerpt">
				
					<?php if ( get_post_meta($post->ID, 'team_title', true) ) : ?>
						<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'team_title', true); ?></p>
					<?php endif; ?>
					
					<span class="border-line"></span>
					
					<?php if ( ! empty( $post->post_excerpt ) ) { ?>
						<?php the_excerpt(); ?>
					<?php } ?>
					
					<?php if ( get_post_meta($post->ID, 'team_twitter_name', true) && get_post_meta($post->ID, 'team_twitter_link', true) ) : ?>
						<p class="subtitle"><a href="<?php echo get_post_meta(get_the_ID(), 'team_twitter_link', true); ?>" rel="bookmark"><?php esc_html_e("@", 'collective'); ?><?php echo get_post_meta(get_the_ID(), 'team_twitter_name', true); ?></a></p>
					<?php endif; ?>
				
				</div>
			
			<?php } ?>
		
		<!-- END .information -->
		</div>
	
	<!-- END .holder -->
	</div>

<!-- END .four columns -->
</div>

<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<!-- END .members -->
</div>