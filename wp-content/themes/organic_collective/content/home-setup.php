<!-- BEGIN .row -->
<div class="row page-section" data-type="background" data-speed="10" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-bg.jpg);">>
		
	<!-- BEGIN .content -->
	<div class="content">
		
		<!-- BEGIN .featured-page -->
		<div class="featured-page">
				
			<!-- BEGIN .information -->
			<div class="information wide">
	
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
				
				<h2 class="headline text-center"><?php esc_html_e("Welcome To Collective", 'collective'); ?></h2>
				<p class="text-center"><?php printf( wp_kses( __( 'To get started set and save the options for the theme within the <a href="%1$s">Customizer</a>.', 'collective' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
					
				<?php } ?>
				
			<!-- END .information -->
			</div>
				
		<!-- END .featured-page -->
		</div>
		
	<!-- END .content -->
	</div>

<!-- END .row -->
</div>