<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

//this for post_type_post
$category = get_the_category();
$categoryName = $category[0]->cat_name;
$categoryId = $category[0]->cat_ID;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<div id="trio2" class="trio">
				<?php
					//are we in tag_archive // avainsana-arkisto
					if ( is_tag() ) :
						?>
						<header class="page-header">
						<?php
							echo '<h1 class="page-title">Avainsana-arkisto: ' . single_cat_title( '', false ) . '</h1>';
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
						</header>
						<?php						
				    $tag = get_queried_object();
				    $tagSlug = $tag->term_id;				    
							
						$tagQuery = new WP_Query( array( 'posts_per_page' => -1 , 'tag_id' => $tagSlug , 'post_type' => 'blogit' ) );
					
					//are we in blogs archive // blogi-arkisto	
					elseif( is_tax('blokaus')) : ?>

						<header class="page-header">
						<?php						
							echo '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>';
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
						</header>
						<?php
						$cat = get_term_by('name', single_cat_title('',false), 'blokaus');
						$categoryName = $cat->slug; 											
						$tagQuery = new WP_Query( 
						array( 
							'posts_per_page' => -1,
							'post_type' => get_post_type(),
							'tax_query' => array(
				        array(
				            'taxonomy' => 'blokaus',
				            'field'    => 'slug',
				            'terms'    => $categoryName,
				        ),
    					),  
						));
						
					else: ?>

						<header class="page-header">
						<?php
							echo '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>';
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
						</header>
						<?php						
						$tagQuery = new WP_Query( array( 'posts_per_page' => -1,'post_type' => get_post_type() , 'paged' => $page, 'cat' => $categoryId  ) );
					
					endif;

						while ( $tagQuery->have_posts() ) : $tagQuery->the_post();
							get_template_part( 'template-parts/content', 'archive' );
						endwhile;	
							//if (is_tag()) : ?>
							<!--<div class="tagCloud">
								<?php
									$tags = get_tags();
									if ($tags) {
									echo '<ul class="blogitTags">';
									foreach ($tags as $tag) {
										echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name.'</a> </li> ';
									}
									echo '</ul>';
								}?>
							</div>-->
						<? //endif; ?>
			</div>			

		<?php endif; ?>	

			<?php	if (  $archiveQuery->max_num_pages > 1 ) : ?>
		    <div class="navigation">
		    	<div class="next">
						<?php next_posts_link( __( '<div class="loadMore">Lataa lisää</div>', 'responsive' ) ); ?>
					</div>
				</div>
	    <?php endif; ?>

		</main>
	</div>

<?php get_footer();