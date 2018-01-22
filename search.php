<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ura
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Hakutulokset: %s', 'ura-lehti' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<div id="trio2" class="trio">

				<?php

				$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$searchQuery = new WP_Query( array( 'paged' => $page ,'posts_per_page' => 6 ) );

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				//the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</div>

			<?php	if (  $searchQuery->max_num_pages > 1 ) : ?>
		    <div class="navigation">
		    	<div class="next">
						<?php next_posts_link( __( '<div class="loadMore">Lataa lisää</div>', 'responsive' ) ); ?>
					</div>
				</div>
	    <?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
