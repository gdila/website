<?php
/**
Template Name: Portfolio
*
* This template is used to display a 4-column portfolio.
*
* @package Collective
* @since Collective 1.0
*
*/
get_header(); ?>

<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'collective-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class('portfolio-page'); ?> id="page-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>
			<h1 class="headline img-headline"><?php the_title(); ?></h1>
			<?php the_post_thumbnail( 'collective-featured-large' ); ?>
		</div>
	<?php } else { ?>
		<h1 class="headline page-headline text-center"><?php the_title(); ?></h1>
	<?php } ?>
	
	<?php
		$portfoliocat = get_theme_mod('category_portfolio', '0');
		if ( function_exists('icl_object_id')) { 
			$multi_lingual_ID = icl_object_id($portfoliocat, 'category', false);
			$terms = get_terms('category', 'child_of='.$multi_lingual_ID.'&hide_empty=0' );
		} else {
			$terms = get_terms('category', 'child_of='.$portfoliocat.'&hide_empty=0' );
		}
		$count = count($terms);
		if ( $count > 0 ) {
			echo '<ul id="portfolio-filter">';
			echo '<li><a class="radius-full" href="javascript:void(0)" data-filter="*">All</a></li>';
			foreach ( $terms as $term ) {
				$termname = strtolower($term->slug);
				$termname = str_replace(' ', '-', $termname);
				echo '<li><a href="javascript:void(0)" data-filter=".category-'.$termname.'" rel="'.$termname.'">'.$term->name.'</a></li>';
			}
			echo "</ul>";
		}
	?>
	
	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content">
	
			<?php get_template_part( 'loop', 'portfolio' ); ?>
		
		<!-- END .sixteen columns -->
		</div>
	
	<!-- END .content -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>