<?php
/**
Template Name: Archives
*
* This template is used to display site archives of posts, pages and categories.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail()) { ?>
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
			
			<!-- BEGIN .postarea full -->
			<div class="postarea full">
				
				<div class="archive-column">
					<h6><?php esc_html_e("By Page:", 'collective'); ?></h6>
					<ul><?php wp_list_pages('title_li='); ?></ul>
				</div>
				
				<div class="archive-column">
					<h6><?php esc_html_e("By Post:", 'collective'); ?></h6>
					<ul><?php wp_get_archives('type=postbypost&limit=100'); ?></ul>
				</div>
				
				<div class="archive-column last">
					<h6><?php esc_html_e("By Month:", 'collective'); ?></h6>
					<ul><?php wp_get_archives('type=monthly'); ?></ul>
					
					<h6><?php esc_html_e("By Category:", 'collective'); ?></h6>
					<ul><?php wp_list_categories('sort_column=name&title_li='); ?></ul>
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