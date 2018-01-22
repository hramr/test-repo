<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>

<!--lainmukaan-->
<div class="lainMukaanWrap">
	<div class="preLaw">
		<h2>Lain mukaan</h2>
	</div>
	<div class="leftColumnLaw">
		<img class="fW" src="<?php echo get_template_directory_uri() ?>/images/lawSymbol.jpg">
	</div>
	<div class="rightColumnLaw">
	<?php $main = new WP_Query (array( 'post_type' => 'lainMukaan' ,'posts_per_page' => 4));
		 if( have_posts() ) :
			while( $main->have_posts() ) : $main->the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a href="<?php the_permalink(); ?>">
						<div class="post-entry">
							<?php if( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail(); ?>
							<?php endif; ?>
							<div class="kirjoittaja">
			 					<?php
									$key = 'Kirjoittaja';
									$themeta = get_post_meta($post->ID, $key, TRUE);
									if($themeta != '') {
										echo '<p>' . $themeta . '</p>';
									}
								?>
			 				</div>
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div>
					</a>
				</div>
			<?php endwhile; endif; ?>
	</div>
</div>
