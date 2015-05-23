<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- BEGIN .article -->
<div class="article">

	<?php the_content(__("Read More", 'organicthemes')); ?>
	
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

<div class="clear"></div>
<?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?>

<?php endwhile; else: ?>

<p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>

<?php endif; ?>