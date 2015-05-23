<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<div class="border-line dark blog-divider"><span class="circle radius-half"><i class="fa fa-pencil"></i></i></span></div>
	
	<div class="post-author text-center">
		<p><i class="fa fa-clock-o"></i> &nbsp;<?php _e("Posted on", 'organicthemes'); ?> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time(__("F j, Y", 'organicthemes')); ?></a> <?php _e("by", 'organicthemes'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
	</div>
	
	<h2 class="headline text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h2>
	
	<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
	<?php } else { ?>
		<?php if ( has_post_thumbnail() ) { ?>
			<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-large' ); ?></a>
		<?php } ?>
	<?php } ?>
	
	<!-- BEGIN .article -->
	<div class="article">
	
		<?php the_content(__("Read More", 'organicthemes')); ?>
		
	<!-- END .article -->
	</div>

<!-- END .post class -->
</div>