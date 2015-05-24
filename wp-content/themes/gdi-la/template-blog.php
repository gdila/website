<?php
/**
Template Name: Blog
*
* This template is used to display a blog. The content is displayed in post formats.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<?php $thumb = ( '' != get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( '' != get_the_post_thumbnail()) { ?>
		<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>
			<h1 class="headline img-headline"><?php the_title(); ?></h1>
			<?php the_post_thumbnail( 'collective-featured-large' ); ?>
		</div>
	<?php } ?>

	<?php if ( ! has_post_thumbnail() ) { ?>
		<h1 class="headline page-headline text-center"><?php the_title(); ?></h1>
	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">

		<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>

			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">

				<!-- BEGIN .postarea -->
				<div class="postarea">

					<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('category_blog'), 'posts_per_page'=>get_theme_mod('postnumber_blog'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
					<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<?php global $more; $more = 0; ?>

						<!-- BEGIN .blog-holder -->
						<div class="blog-holder">

							<?php get_template_part( 'loop', 'blog' ); ?>

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
							<h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
							<p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
						</div>

					<?php endif; ?>

				<!-- END .postarea -->
				</div>

			<!-- END .eleven columns -->
			</div>

			<!-- BEGIN .five columns -->
			<div class="five columns">

				<?php get_sidebar('blog'); ?>

			<!-- END .five columns -->
			</div>

		<?php else : ?>

			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">

				<!-- BEGIN .postarea full -->
				<div class="postarea full">

					<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('category_blog'), 'posts_per_page'=>get_theme_mod('postnumber_blog'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
					<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<?php global $more; $more = 0; ?>

						<!-- BEGIN .blog-holder -->
						<div class="blog-holder">

							<?php get_template_part( 'loop', 'blog' ); ?>

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
							<h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
							<p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
						</div>

					<?php endif; ?>

				<!-- END .postarea full -->
				</div>

			<!-- END .sixteen columns -->
			</div>

		<?php endif; ?>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>