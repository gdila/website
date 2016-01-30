<!-- BEGIN .slideshow -->
<div class="slideshow">
	
	<!-- BEGIN .flexslider -->
	<div class="flexslider loading" data-speed="<?php echo get_theme_mod('transition_interval', '8000'); ?>" data-transition="<?php echo get_theme_mod('transition_style', 'fade'); ?>">
	
		<div class="preloader"></div>
	
		<!-- BEGIN .slides -->
		<ul class="slides">
				
			<?php $data = array(
				'post_parent'		=> $post->ID,
				'post_type' 		=> 'attachment',
				'post_mime_type' 	=> 'image',
				'order'         	=> 'ASC',
				'orderby'	 		=> 'menu_order',
				'numberposts' 		=> -1
			); ?>
			
			<?php
			$images = get_posts($data); foreach( $images as $image ) {
				$imageurl = wp_get_attachment_url($image->ID);
				echo '<li style="background-image: url('.$imageurl.');"><img src="'.$imageurl.'" /></li>' . "\n";
			} ?>
			
		<!-- END .slides -->
		</ul>
	
	<!-- END .flexslider -->
	</div>

<!-- END .slideshow -->
</div>