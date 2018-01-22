<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ura
 */
global $post_id;
?>
<aside id="secondary" class="widget-area" role="complementary">

	<section id="sRef" class="singlePanel">	
		<div class="quartLabel"><h2>Lain Mukaan</h2></div>
			<div class="contents">
				<ul class="wpp-list">
				<?php $main = new WP_Query (array( 'post__not_in'=> array($post_id), 'post_type' => 'lainMukaan', 'posts_per_page' => -1));
					 if( have_posts() ) : 
						while( $main->have_posts() ) : $main->the_post(); ?>
										
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a>
								</li>							
						<?php endwhile; endif; ?>	
				</ul>			
			</div>	
	</section>

	<section id="sticky" class="singlePanel">	
		<div class="quartLabel"><h2>Luetuimmat</h2></div>
			<div class="contents">		
				<?php wpp_get_mostpopular(
					'range="weekly"&post_type=post&stats_views=0&limit=5'
					);
				?>			
			</div>	
	</section>

	<div id="stickyalias"></div>

</aside><!-- #secondary -->
