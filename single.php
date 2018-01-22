<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ura
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php		
			while ( have_posts() ) : the_post();
				if ( is_singular('blogit') ) {
					get_template_part( 'template-parts/content', 'singleBlogi' );
				} elseif (is_singular('lainmukaan')) {
					get_template_part( 'template-parts/content', 'singleLainMukaan' );
				} else {
					get_template_part( 'template-parts/content', 'single' );
				}	
			endwhile;
		?>

		</main>
	</div>

<?php 
if ( is_singular('blogit') ) {
	get_template_part( 'template-parts/sidebar', 'blogi' );
} elseif (is_singular('lainmukaan')) {
	get_template_part( 'template-parts/sidebar', 'lainMukaan' );
} else {
	get_template_part( 'template-parts/sidebar', 'Article' );
}

get_footer();
