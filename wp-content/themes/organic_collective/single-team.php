<?php
/**
* This template displays single post content for the team custom post type.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'team-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<?php if ( '1' == get_theme_mod('display_feature_team', '') ) { ?>
		<?php if ( has_post_thumbnail()) { ?>
			<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>
				<h1 class="headline member-headline"><?php the_title(); ?></h1>
				<?php the_post_thumbnail( 'team-featured-large' ); ?>
			</div>
		<?php } ?>
	<?php } ?>
	
	<?php if ( '' == get_theme_mod('display_feature_team', '') ) { ?>
		<h1 class="headline page-headline text-center"><?php the_title(); ?></h1>
	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content team-content">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- BEGIN .five columns -->
			<div class="five columns">
				
				<!-- BEGIN .sidebar left -->	
				<div class="sidebar left">
					
					<?php if ( '' == get_theme_mod('display_feature_team', '')) { ?>
					
					<!-- BEGIN .profile-pic -->	
					<div class="profile-pic">
					
						<?php if ( has_post_thumbnail()) { ?>
							<div class="feature-img"><?php the_post_thumbnail( 'collective-featured-small' ); ?></div>
						<?php } else { ?>
							<div class="feature-img"><img src="<?php echo get_template_directory_uri(); ?>/images/default-profile.jpg" alt="<?php the_title(); ?>" /></div>
						<?php } ?>
					
					<!-- END .profile-pic -->
					</div>
					
					<?php } ?>
					
					<!-- BEGIN .team-links -->	
					<div class="team-links">
					
						<?php if ( get_post_meta($post->ID, 'team_link', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_link', true); ?>" target="_blank"><i class="fa fa-external-link"></i> &nbsp; <?php esc_html_e("My Website", 'collective'); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_email', true) ) : ?>
							<a class="team-link" href="mailto:<?php echo get_post_meta(get_the_ID(), 'team_email', true); ?>" target="_blank"><i class="fa fa-envelope-o"></i> &nbsp; <?php esc_html_e("Email Me", 'collective'); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_facebook', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_facebook', true); ?>" target="_blank"><i class="fa fa-facebook"></i> &nbsp; <?php esc_html_e("Facebook", 'collective'); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_twitter_link', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_twitter_link', true); ?>" target="_blank"><i class="fa fa-twitter"></i> &nbsp; <?php esc_html_e("@", 'collective'); ?><?php echo get_post_meta(get_the_ID(), 'team_twitter_name', true); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_google', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_google', true); ?>" target="_blank"><i class="fa fa-google-plus"></i> &nbsp; <?php esc_html_e("Google+", 'collective'); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_linkedin', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_linkedin', true); ?>" target="_blank"><i class="fa fa-linkedin"></i> &nbsp; <?php esc_html_e("LinkedIn", 'collective'); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_dribbble', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_dribbble', true); ?>" target="_blank"><i class="fa fa-dribbble"></i> &nbsp; <?php esc_html_e("Dribbble", 'collective'); ?></a>
						<?php endif; ?>
						
						<?php if ( get_post_meta($post->ID, 'team_github', true) ) : ?>
							<a class="team-link" href="<?php echo get_post_meta(get_the_ID(), 'team_github', true); ?>" target="_blank"><i class="fa fa-github-alt"></i> &nbsp; <?php esc_html_e("Github", 'collective'); ?></a>
						<?php endif; ?>
					
					<!-- END .team-links -->	
					</div>
					
					<?php if ( get_post_meta($post->ID, 'team_twitter_id', true) ) : ?>
						<?php require_once( trailingslashit( get_template_directory() ). 'includes/latest-tweet.php' ); ?>
						<div id="tweets"></div>
					<?php endif; ?>
				
				<!-- END .sidebar-left -->
				</div>
			
			<!-- END .five columns -->
			</div>
			
			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">
			
				<!-- BEGIN .postarea right -->	
				<div class="postarea right">
				
					<h2 class="headline small"><?php echo get_post_meta(get_the_ID(), 'team_title', true); ?></h2>
					
					<!-- BEGIN .article -->
					<div class="article">
					
						<?php the_content(); ?>
						
					<!-- END .article -->
					</div>
				
				<!-- END .postarea right -->	
				</div>
			
			<!-- END .eleven columns -->
			</div>
			
			<div class="clear"></div>
			
			<?php endwhile; else: ?>
			
			<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'collective'); ?></p>
			
			<?php endif; ?>
				
		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>