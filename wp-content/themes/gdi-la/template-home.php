<?php
/**
Template Name: GDILA Home
*
* This template is used to display the GDILA home page.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<?php $thumb = ( '' != get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>
			<h1 class="headline img-headline"><?php the_title(); ?></h1>
			<?php the_post_thumbnail( 'collective-featured-large' ); ?>
		</div>
	<?php } else { ?>
		<h1 class="headline page-headline text-center"><?php the_title(); ?></h1>
	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">

			<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>

				<!-- BEGIN .eleven columns -->
				<div class="eleven columns">

					<!-- BEGIN .postarea -->
					<div class="postarea">

						<!-- BEGIN .row -->
						<div class="row news-section" <?php if ( '' != get_theme_mod( 'news_background' ) ) { ?> style="background-image: url(<?php echo get_theme_mod('news_background') ?>); background-repeat: repeat;" <?php } ?>>

								<!-- BEGIN .featured-news -->
								<div class="featured-news">

									<h2>Recent News</h2>

									<?php get_template_part( 'content/home', 'news' ); ?>

								<!-- END .featured-news -->
								</div>

						<!-- END .row -->
						</div>

					<!-- END .postarea -->
					</div>

				<!-- END .eleven columns -->
				</div>

				<!-- BEGIN .five columns -->
				<div class="five columns">

					<?php get_sidebar(); ?>

				<!-- END .five columns -->
				</div>

			<?php else : ?>

				<!-- BEGIN .sixteen columns -->
				<div class="sixteen columns">

					<!-- BEGIN .postarea full -->
					<div class="postarea full">

						<?php get_template_part( 'loop', 'page' ); ?>

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