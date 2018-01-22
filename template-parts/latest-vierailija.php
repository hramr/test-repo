<?php
/**
 * Template part for displaying latest posts in blogit -> vierailija
 * Show photos of faces as "article image"
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>

				<div class="half">
				<?php the_post_thumbnail(); ?>
					
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="wrapLatestContent">
				<?php } ?>

				<div class="post-meta">
				    <p class="teksti"><?php the_time('j.n.Y') ?></p>
				</div>

				<a href="<?php the_permalink() ?>">
					<h2>foolz<?php the_title(); ?></h2>				
				</a>
				
				<?php if ( has_post_thumbnail() ) { ?>
					</div>
				<?php } ?>

				</div>
		
			<?php endwhile;?>