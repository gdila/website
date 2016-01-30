<?php
/**
* The footer for our theme.
* This template is used to generate the footer for the theme.
*
* @package Collective
* @since Collective 1.0
*
*/
?>

<div class="clear"></div>

<!-- END .container -->
</div>

<!-- BEGIN .footer -->
<div class="footer">

	<?php if ( is_active_sidebar('footer') ) { ?>
	
	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content">
	
		<!-- BEGIN .footer-widgets -->
		<div class="footer-widgets">
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : ?>
			<?php endif; ?>
		
		<!-- END .footer-widgets -->
		</div>
		
		</div>
	
	<!-- END .row -->
	</div>
	
	<?php } ?>
		
	<!-- BEGIN .footer-information -->
	<div class="footer-information">
	
		<!-- BEGIN .footer-content -->
		<div class="footer-content">
	
			<div class="align-left">
				<p><?php esc_html_e("Copyright", 'collective'); ?> &copy; <?php echo date(__("Y", 'collective')); ?> &middot; <?php esc_html_e("All Rights Reserved", 'collective'); ?> &middot; <?php bloginfo('name'); ?></p>
				<p><a href="http://www.organicthemes.com/themes/" target="_blank"><?php esc_html_e("Collective Theme", 'collective'); ?></a> <?php esc_html_e("by", 'collective'); ?> <a href="http://www.organicthemes.com" target="_blank"><?php esc_html_e("Organic Themes", 'collective'); ?></a> &middot; <a href="http://kahunahost.com" target="_blank" title="WordPress Hosting"><?php esc_html_e("WordPress Hosting", 'collective'); ?></a> &middot; <a href="<?php bloginfo('rss2_url'); ?>"><?php esc_html_e("RSS Feed", 'collective'); ?></a> &middot; <?php wp_loginout(); ?></p>
			</div>
			
			<div class="align-right">
				
				<?php if ( has_nav_menu( 'social-menu' ) ) { ?>
					
					<?php wp_nav_menu( array(
						'theme_location' => 'social-menu',
						'title_li' => '',
						'depth' => 1,
						'container_class' => 'social-menu',
						'menu_class'      => 'social-icons',
						'link_before'     => '<span>',
						'link_after'      => '</span>',
						)
					); ?>
					
				<?php } ?>
				
			</div>
	
		<!-- END .footer-content -->
		</div>
	
	<!-- END .footer-information -->
	</div>

<!-- END .footer -->
</div>

<!-- END #wrap -->
</div>

<?php wp_footer(); ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=246727095428680";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>