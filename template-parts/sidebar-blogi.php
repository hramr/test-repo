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
		<div class="quartLabel"><h2>Uusimmat blogit</h2></div>
			<div class="contents">		
				<?php $main = new WP_Query (array('post__not_in'=> array($post_id), 'post_type' => 'blogit', 'posts_per_page' => 4));
					 if( have_posts() ) : 
						while( $main->have_posts() ) : $main->the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>						
								<div class="post-entry">																
									<?php if( has_post_thumbnail() ) : ?>
										<a class="iB w100" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									<?php endif; ?>
										<div clas="kredit">
											<p class="teksti"><?php the_time('j.n.Y') ?></p>
												<?php $themeta = get_field('blogaajan_nimi'); ?>
												<?php echo "<p class='teksti'>&nbsp;|&nbsp;" . $themeta . "&nbsp;</p>"; ?>
										</div>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
		<div class="quartLabel"><h2 class="mostRead">Uusimmat</h2></div>
			<div class="contents">	
			<?php $args = array(
        'posts_per_page' => 5,
        'orderby' => 'most_recent'
        );
        $the_query = new WP_Query( $args );?>
        <ul class="wpp-list">
        <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        	 <li>        	 
        	 	<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
        	 	<div clas="kredit">
							<p class="teksti"><?php the_time('j.n.Y') ?></p>
						</div>
        	 </li>
        <?php endwhile;  ?>        
        <?php endif; ?>
        </ul>
      </div>  
	</section>

	<div id="stickyalias"></div>

</aside><!-- #secondary -->
