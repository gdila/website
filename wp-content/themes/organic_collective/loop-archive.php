<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>

<!-- BEGIN .post class -->
<div <?php post_class('archive-holder'); ?> id="post-<?php the_ID(); ?>">

	<div class="border-line dark blog-divider"><span class="circle radius-half"><i class="fa fa-pencil"></i></i></div>

	<div class="post-author text-center">
		<p><i class="fa fa-clock-o"></i> &nbsp;<?php esc_html_e("Posted on", 'collective'); ?> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time(__("F j, Y", 'collective')); ?></a> <?php esc_html_e("by", 'collective'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
	</div>

	<h2 class="headline text-center"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	
	<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
	<?php } else { ?>
		<?php if ( has_post_thumbnail() ) { ?>
			<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'collective' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-medium' ); ?></a>
		<?php } ?>
	<?php } ?>
	
	<!-- BEGIN .excerpt -->
	<div class="excerpt">
	
		<?php the_excerpt(); ?>
		
	<!-- END .excerpt -->
	</div>

<!-- END .post class -->
</div>

<?php endwhile; ?>

<!-- BEGIN .pagination -->
<div class="pagination">
	<?php echo collective_get_pagination_links(); ?>
<!-- END .pagination -->
</div>

<?php else: ?>

<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'collective'); ?></p>

<?php endif; ?>