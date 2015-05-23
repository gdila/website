<h4 class="headline text-center"><?php echo esc_html( collective_cat_id_to_name(get_theme_mod('category_news') ) ); ?></h4>

<?php $news = new WP_Query(array('cat'=>get_theme_mod('category_news'), 'posts_per_page'=>get_theme_mod('postnumber_news'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
<?php if ($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
<?php $thumb = ( '' != get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-small' ) : false; ?>

<!-- BEGIN .holder -->
<div class="holder">
	
<?php if ( has_post_thumbnail() ) { ?>
	
	<!-- BEGIN .four columns -->
	<div class="four columns">

		<a class="feature-img" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?> href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-small' ); ?></a>

	<!-- END .four columns -->
	</div>

	<!-- BEGIN .twelve columns -->
	<div class="twelve columns">
	
		<!-- BEGIN .information -->
		<div class="information">
		
			<!-- BEGIN .padding -->
			<div class="padding">
	
				<div class="post-author">
					<p><i class="fa fa-clock-o"></i> &nbsp;<?php _e("Posted on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?> <?php _e("by", 'organicthemes'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
				</div>
			
				<h2 class="headline small"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
			
			<!-- END .padding -->
			</div>
		
		<!-- END .information -->
		</div>
	
	<!-- END .twelve columns -->
	</div>

<?php } else { ?>

	<!-- BEGIN .sixteen columns -->
	<div class="sixteen columns">
			
		<!-- BEGIN .information -->
		<div class="information">
		
			<!-- BEGIN .padding -->
			<div class="padding">
	
				<div class="post-author">
					<p><i class="fa fa-clock-o"></i> &nbsp;<?php _e("Posted on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?> <?php _e("by", 'organicthemes'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
				</div>
			
				<h2 class="headline small"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
			
			<!-- END .padding -->
			</div>
		
		<!-- END .information -->
		</div>
	
	<!-- END .sixteen columns -->
	</div>

<?php } ?>

<!-- END .holder -->
</div>

<?php endwhile; else : ?>

<!-- BEGIN .holder -->
<div class="holder">

	<h2 class="headline small"><?php _e("No Posts Found", 'organicthemes'); ?></h2>
	<p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
	
<!-- END .holder -->
</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>