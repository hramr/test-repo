<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ura
 */

?>

<aside id="secondary" class="widget-area" role="complementary">

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
										'post_type' => array('blogit', 'post' )
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

	<section id="sRef" class="singlePanel">	
		<div class="quartLabel"><h2 class="mostRead">Uusimmat</h2></div>
			<div class="contents">		
				<?php $main = new WP_Query (array( 'posts_per_page' => 5, 'cat' => array(3,4,5,6)));
					 if( have_posts() ) : 
						while( $main->have_posts() ) : $main->the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>						
								<div class="post-entry">

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

									<?php if( has_post_thumbnail() ) : ?>
										<a class="iB w100" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail('large'); ?>
										</a>
									<?php endif; ?>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
								</div>
								<!-- end of .post-entry -->						
							</div><!-- end of #post-<?php the_ID(); ?> -->
						<?php endwhile; endif; ?>		
			</div>	
	</section>

	<section id="sticky" class="singlePanel">		
		<div class="quartLabel"><h2 class="mostRead">Luetuimmat</h2></div>
			<div class="contents">		
				<?php wpp_get_mostpopular(
					'range="weekly"&post_type=post&stats_views=0&limit=10'
					);
				?>			
			</div>

			<div class="liity" style="display:none;">
				<!--<a target="blank" href="https://verkkoasiointi-yhteiskunta--ala-fi.pwire.fi/liittymislomake/perustiedot/"><img src="<?php echo get_template_directory_uri() ?>/images/liity.jpg"></a>-->
				liityGraffa
			</div>
	</section>

	<div id="stickyalias"></div>

</aside><!-- #secondary -->
