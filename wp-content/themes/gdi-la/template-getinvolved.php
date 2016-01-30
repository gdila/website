<?php
/**
Template Name: Get Involved
*
* This template is used to display the get involved page
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

			<!-- BEGIN .postarea full -->
			<div class="postarea full">
				<div class="article">
				<?php /* User is logged in and has the correct permissions */ ?>
					<?php if ( is_user_logged_in() && current_user_can( 'serve_as_volunteer' ) ) : ?>
						<?php the_field( 'logged_in_volunteer' ); ?>
					<?php /* User is logged in but doesn't have the correct permissions */ ?>
					<?php elseif ( is_user_logged_in() && ! current_user_can( 'serve_as_volunteer' )) : ?>
						<?php the_field( 'logged_in_pending' ); ?>
					<?php /* User is not logged in */ ?>
					<?php else : ?>
						<?php the_field( 'logged_out' ); ?>
					<?php endif; ?>
				</div>

			<!-- END .postarea full -->
			</div>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>