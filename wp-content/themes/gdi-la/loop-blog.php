<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<div class="holder blog-listing">
	<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
	<?php } else { ?>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="five columns">
				<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-small' ); ?></a>
			</div>
		<?php } ?>
	<?php } ?>

	<div class="eleven columns">
		<div class="padding">

	<div class="post-category">
		<?php the_category( '&bull' ); ?>
	</div>

	<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h2>

	<div class="post-author">
		<p><i class="fa fa-clock-o"></i> &nbsp;<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time(__("F j, Y", 'organicthemes')); ?></a> &bull; <?php _e("by", 'organicthemes'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
	</div>

	<!-- BEGIN .article -->
	<div class="article">

		<?php the_excerpt(); ?>

	<!-- END .article -->
	</div>

	</div>

	</div>

	</div>

<!-- END .post class -->
</div>
<?php endwhile; ?>
<?php else: ?>

<p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>

<?php endif; ?>