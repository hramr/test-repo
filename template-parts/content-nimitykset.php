<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>

<!--nimitykset-->

<div class="quartLabel"><h2>Nimitykset</h2></div>
<div class="quartWrap quartNim">
		<?php $main = new WP_Query (array( 'post_type' => 'nimitykset', 'posts_per_page' => -4));
		 if( have_posts() ) :
			while( $main->have_posts() ) : $main->the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(  ); ?>>
					<div class="post-entry">
							<a class="taCM block" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>						
						<div class="Titteli">
		 					<?php
								$key = 'Titteli';
								$themeta = get_post_meta($post->ID, $key, TRUE);
								if($themeta != '') {
									echo '<p>' . $themeta . '</p>';
								}
							?>
		 				</div>
		 				<div class="Tyonantaja">
		 					<?php
								$key = 'Yritys';
								$themeta = get_post_meta($post->ID, $key, TRUE);
								if($themeta != '') {
									echo '<p>' . $themeta . '</p>';
								}
							?>
						<div class="pvmNimitys">
		 					<?php
								$key = 'pvm';
								$themeta = get_post_meta($post->ID, $key, TRUE);
								if($themeta != '') {
									echo '<p>' . $themeta . '</p>';
								}
							?>
		 				</div>
					</div>
					</div>
				</div>
			<?php endwhile; endif; ?>
				<div class="preNim">
				<img class="cIcon" src="<?php echo get_template_directory_uri() ?>/images/nimityksetB.png" alt="Ura-nimitykset">
				<h2>Kohti uusia uria?</h2>
				<a class="nButton" href="<?php echo esc_url( home_url( '/' ) ); ?>nimitysuutinen">Lähetä nimitysuutinen</a>
	</div>
</div>
