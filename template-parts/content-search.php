<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array ('masoner','third') ); ?>>
	<!--
	<?php if( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php endif; ?>
	-->
	
	<header class="entry-header">
	<div class="entry-meta">						
			<p class="teksti"><?php the_time('j.n.Y') ?></p>			
		</div>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php $categories = get_the_category(); ?>

		<?php if ( 'post' === get_post_type() ) : ?>			
			<p class="category_name" style="display:inline-block;">
				<?php echo esc_html( $categories[0]->name ); ?>
			</p>
		<?php elseif ('lainmukaan' === get_post_type()) : ?>						

		<p class="category_name" style="display:inline-block;">Lain mukaan</p>

		<?php else : ?>			

		<?php //category for blogit post_type
	    $cat = new WPSEO_Primary_Term('blokaus', get_the_ID());
			$cat = $cat->get_primary_term();
			$catName = get_cat_name($cat);			
		?>

		<p class="category_name" style="display:inline-block;">
		<?php echo $catName; ?>
		</p>
		
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		
	</footer>
</article>