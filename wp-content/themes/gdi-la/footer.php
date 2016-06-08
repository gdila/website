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
				<div id="mc_embed_signup">
					<form action="//gdila.us10.list-manage.com/subscribe/post?u=eaf08da442fc9264592085a62&amp;id=79ebd56ee2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
							<div class="mc-field-group">
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
							</div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>
							<div style="position: absolute; left: -5000px;"><input type="text" name="b_eaf08da442fc9264592085a62_79ebd56ee2" tabindex="-1" value=""></div>
							<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						</div>
					</form>
				</div>
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

<?php if ( is_user_logged_in() ) :
	global $current_user;
  get_currentuserinfo();
?>
<script>
	var currentUser = {
		'firstName': '<?php echo $current_user->user_firstname; ?>',
		'lastName' : '<?php echo $current_user->user_lastname; ?>',
		'email': '<?php echo $current_user->user_email; ?>',
		'id': '<?php echo $current_user->ID; ?>',
		'phone': '<?php echo get_user_meta($current_user->ID, "phone", true); ?>'
	};
</script>
<?php else : ?>
	<script>var currentUser = null;</script>
<?php endif; ?>


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