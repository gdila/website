<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- BEGIN .article -->
<div class="article">

	<?php the_content(__("Read More", 'collective')); ?>
	
<!-- END .article -->
</div>

<?php wp_link_pages(array(
	'before' => '<p class="page-links"><span class="link-label">' . esc_html__('Pages:', 'collective') . '</span>',
	'after' => '</p>',
	'link_before' => '<span>',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'nextpagelink' => esc_html__('Next', 'collective'),
	'previouspagelink' => esc_html__('Previous', 'collective'),
	'pagelink' => '%',
	'echo' => 1 )
); ?>

<div class="clear"></div>
<?php edit_post_link(__("(Edit)", 'collective'), '', ''); ?>

<?php endwhile; else: ?>

<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'collective'); ?></p>

<?php endif; ?>