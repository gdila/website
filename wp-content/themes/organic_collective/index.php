<?php
/**
* This template displays single post content.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<?php if (get_theme_mod('display_feature_post', '1') == '1') { ?>
		<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
			<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
		<?php } else { ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>
					<?php the_post_thumbnail( 'collective-featured-large' ); ?>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content">
	
		<?php if ( is_active_sidebar( 'post-sidebar' ) ) : ?>
			
			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">
	
				<!-- BEGIN .postarea -->
				<div class="postarea">
		
					<?php get_template_part( 'loop', 'post' ); ?>
				
				<!-- END .postarea -->
				</div>
			
			<!-- END .eleven columns -->
			</div>
			
			<!-- BEGIN .five columns -->
			<div class="five columns">
			
				<?php get_sidebar('post'); ?>
				
			<!-- END .five columns -->
			</div>
	
		<?php else : ?>
	
			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">
	
				<!-- BEGIN .postarea full -->
				<div class="postarea full">
		
					<?php get_template_part( 'loop', 'post' ); ?>
				
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