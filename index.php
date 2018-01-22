<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<!--big story-->
		<div class="featuredBlock">

				<?php $main = new WP_Query (array( 'posts_per_page' => 1, 'cat' => array(3,4,5,6)));
				 if( have_posts() ) :
					while( $main->have_posts() ) : $main->the_post();
					$post_id = get_the_ID(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('featured'); ?>>
							<div class="post-entry">
								<?php if( has_post_thumbnail() ) : ?>
									<?php
										$post_id = get_the_ID();
										$key = '_youtube_src';
										$themeta = get_post_meta($post->ID, $key, TRUE);

										$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
										if (empty($themeta)) { ?>
										<a class="w100 iB" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
										<?php } else {  ?>
										<div onclick="trackOutboundLink('<?php echo the_permalink(); ?>'); return false;"  class="youtube" style="background-position: 0;background-image: url('<?php echo $thumb['0'];?>');" id="<?php echo $themeta; ?>"  data-params="modestbranding=1&showinfo=0&controls=1&vq=hd720">
											<div class="play"></div>
										</div>
									<?php } ?>
								<?php endif; ?>

								<div class="iB">

									<div class="category">
									<?php 
										$cat = new WPSEO_Primary_Term('category', get_the_ID());
	    				    	$cat = $cat->get_primary_term();
	    				    	$catName = get_cat_name($cat);
										$category_id = get_cat_ID( $catName );
										$category_link = get_category_link( $category_id ); ?>

										<?php if( !empty($cat)  ){ ?>
											<a href="<?php echo esc_url( $category_link ); ?>">
	    									<p class="category_name">    									
	    										<?php echo $catName; ?>
	    			    				</p>
    			    				</a>	
    			    			<?php	} else { ?>
												<?php foreach((get_the_category()) as $cat) {
												echo '<a href="/'
												. $cat->category_nicename . '"><p class="category_name">' . $cat->cat_name .
												'</p></a>';
												} ?>											
    			    			<?php	} ?>
    							</div>

									<p class="teksti"><?php the_time('j.n.Y') ?></p>
								</div>
								<h2 class="featuredTitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
							</div>
							<!-- end of .post-entry -->
						</div><!-- end of #post-<?php the_ID(); ?> -->
					<?php endwhile; endif; ?>

				<!--second story-->
				<section class="featuredRight">
					<div class="editRec"><h2>Toimitus suosittelee</h2></div>
						<section class="">
							<?php
								$latest_news = get_posts( array(
										'meta_query' => array(
														array(
															'key' => 'ura_lehti_featured_post_field',
															'value' => '1',
														)
													),
										'order' => 'desc',
										'orderby' => 'modified',
										'posts_per_page' => 10,
										'post_type' => array('blogit', 'post','lainmukaan')
									) );

								if ( is_array( $latest_news ) ) :
									$i = 1;
									foreach ( $latest_news as $news ) :
									?>
									<div class="wrapEdits">
										<div class="runNum">
											<span class="latestNewsNum"><?php echo $i++; ?></span>
										</div>
											<div class="latestTitles">
												<a href="<?php echo the_permalink( $news->ID ); ?>">
													<?php echo get_the_title( $news->ID  ); ?>
												</a>
											</div>
								  </div>
								<?php
								endforeach;
								endif;
							?>
					  </section>
				</section>
		</div>

		<div id="trio2" class="trio">
			<?php
				$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$main = new WP_Query( array( /*'offset' => 1,*/'post__not_in' => array($post_id), 'paged' => $paged, 'posts_per_page' => 6,  'cat' => array(3,4,5,6)) );
					while( $main->have_posts() ) : $main->the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class(array('third','masoner')); ?>>
							<div class="post-entry w100">

								<?php if( has_post_thumbnail() ) : ?>
									<?php
										$post_id = get_the_ID();
										$key = '_youtube_src';
										$themeta = get_post_meta($post->ID, $key, TRUE);
									?>
									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
									<?php if (empty($themeta)) { ?>
										<a class="w100 iB" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									<?php } else {  ?>
										<div onclick="trackOutboundLink('<?php echo the_permalink(); ?>'); return false;"  class="youtube" style="background-position: 0;background-image: url('<?php echo $thumb['0'];?>');" id="<?php echo $themeta; ?>"  data-params="modestbranding=1&showinfo=0&controls=1&vq=hd720">
						      		<div class="play"></div>
						      	</div>
									<?php } ?>
								<?php endif; ?>

								<div class="iB">

									<div class="category">
									<?php 
										$cat = new WPSEO_Primary_Term('category', get_the_ID());
	    				    	$cat = $cat->get_primary_term();
	    				    	$catName = get_cat_name($cat);
										$category_id = get_cat_ID( $catName );
										$category_link = get_category_link( $category_id ); ?>

										<?php if( !empty($cat)  ){ ?>
											<a href="<?php echo esc_url( $category_link ); ?>">
	    									<p class="category_name">    									
	    										<?php echo $catName; ?>
	    			    				</p>
    			    				</a>	
    			    			<?php	} else { ?>
												<?php foreach((get_the_category()) as $cat) {
												echo '<a href="/'
												. $cat->category_nicename . '"><p class="category_name">' . $cat->cat_name .
												'</p></a>';
												} ?>											
    			    			<?php	} ?>
    							</div>

									
									<p class="teksti"><?php the_time('j.n.Y') ?></p>
								</div>
								<h2 class="trioTitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
							</div>
							<!-- end of .post-entry -->
						</div><!-- end of #post-<?php the_ID(); ?> -->
			<?php endwhile;  ?>
		</div>

		<?php if (  $main->max_num_pages > 1 ) : ?>
	    <div class="navigation">
	    	<div class="next">
					<!--<?php next_posts_link( __( '<img src="http://uralehti.fi/wp-content/themes/ura-lehti/images/icon-more.jpg">', 'responsive' ) ); ?>-->
					<?php next_posts_link( __( '<div class="loadMore">Lataa lisää</div>', 'responsive' ) ); ?>
				</div>
			</div>
    <?php endif; ?>

		<?php get_template_part( 'template-parts/content', 'nimitykset' ); ?>

		<?php get_template_part( 'template-parts/content', 'lainmukaan' ); ?>

		<?php get_template_part( 'template-parts/content', 'uusimmatBlogit' ); ?>

	</main>
</div>

<?php get_footer();
