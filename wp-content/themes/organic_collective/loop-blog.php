<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('category_blog', '0'), 'posts_per_page'=>get_theme_mod('postnumber_blog', '10'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
<?php global $more; $more = 0; ?>

	<!-- BEGIN .blog-holder -->
	<div class="blog-holder">

		<!-- BEGIN .post class -->
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			
			<div class="border-line dark blog-divider"><span class="circle radius-half"><i class="fa fa-pencil"></i></i></span></div>
			
			<div class="post-author text-center">
				<p><i class="fa fa-clock-o"></i> &nbsp;<?php esc_html_e("Posted on", 'collective'); ?> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time(__("F j, Y", 'collective')); ?></a> <?php esc_html_e("by", 'collective'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
			</div>
			
			<h2 class="headline text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h2>
			
			<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
				<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
			<?php } else { ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'collective' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'collective-featured-large' ); ?></a>
				<?php } ?>
			<?php } ?>
			
			<!-- BEGIN .article -->
			<div class="article">
			
				<?php the_content(__("Read More", 'collective')); ?>
				
			<!-- END .article -->
			</div>
		
		<!-- END .post class -->
		</div>
		
	<!-- END .blog-holder -->
	</div>

<?php endwhile; ?>

	<?php if($wp_query->max_num_pages > 1) { ?>
		<!-- BEGIN .pagination -->
		<div class="pagination">
			<?php echo collective_get_pagination_links(); ?>
		<!-- END .pagination -->
		</div>
	<?php } ?>

<?php else : ?>

	<div class="error-404">
		<h1 class="headline"><?php esc_html_e("No Posts Found", 'collective'); ?></h1>
		<p><?php esc_html_e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'collective'); ?></p>
	</div>

<?php endif; ?>