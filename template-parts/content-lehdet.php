<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		
	<?php
	$args=array('post_type' => 'lehdet', 'posts_per_page' => -1 );
	?>

	<?php $the_query = new WP_Query($args); ?>
	
		<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

			<div class="lehti">

					<h2><?php the_title(); ?></h2>

				<?php the_post_thumbnail(); ?>
				
				<?php the_content(); ?>

			</div>
		<?php endwhile;?>

</div>
</article>
