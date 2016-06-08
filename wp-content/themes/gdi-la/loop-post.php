<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post-category">
	<?php the_category( '&bull' ); ?>
</div>

<h1 class="headline"><?php the_title(); ?></h1>

<div class="post-author">
	<i class="fa fa-clock-o"></i> &nbsp;<?php the_time(__("F j, Y", 'organicthemes')); ?>
	&bull; <?php _e("by", 'organicthemes'); ?> <?php esc_url ( the_author_posts_link() ); ?>
	&bull; <i class="fa fa-comment"></i> &nbsp;<a class="scroll" href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), '% Comments'); ?></a>
</div>

<!-- BEGIN .article -->
<div class="article">

	<?php the_content(); ?>

<!-- END .article -->
</div>

<?php wp_link_pages(array(
	'before' => '<p class="page-links"><span class="link-label">' . __('Pages:', 'organicthemes') . '</span>',
	'after' => '</p>',
	'link_before' => '<span>',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'nextpagelink' => __('Next', 'organicthemes'),
	'previouspagelink' => __('Previous', 'organicthemes'),
	'pagelink' => '%',
	'echo' => 1 )
); ?>

<?php if (get_theme_mod('display_social_post') == '1') { ?>
<div class="social radius-top">
	<div class="like-btn">
		<div class="fb-like" href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
	</div>
	<div class="tweet-btn">
		<a href="http://twitter.com/share" class="twitter-share-button"
		data-url="<?php the_permalink(); ?>"
		data-via="<?php echo get_theme_mod('twitter_user'); ?>"
		data-text="<?php the_title(); ?>"
		data-related=""
		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
	</div>
	<div class="plus-btn">
		<g:plusone size="medium" annotation="bubble" href="<?php the_permalink(); ?>"></g:plusone>
	</div>
</div>
<?php } ?>

<!-- BEGIN .post-meta -->
<div class="post-meta radius-bottom">

	<p><?php $tag_list = get_the_tag_list( __( ", ", 'organicthemes' ) ); if ( ! empty( $tag_list ) ) { ?> &nbsp; &nbsp; <i class="fa fa-tags"></i> &nbsp;<?php _e("Tags:", 'organicthemes'); ?> <?php the_tags(''); ?><?php } ?></p>

<!-- END .post-meta -->
</div>

<!-- BEGIN .post-navigation -->
<div class="post-navigation">
	<div class="previous-post"><?php previous_post_link('&larr; %link'); ?></div>
	<div class="next-post"><?php next_post_link('%link &rarr;'); ?></div>
<!-- END .post-navigation -->
</div>

<?php if ( comments_open() || '0' != get_comments_number() ) comments_template(); ?>

<div class="clear"></div>

<?php endwhile; else: ?>

<p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>

<?php endif; ?>