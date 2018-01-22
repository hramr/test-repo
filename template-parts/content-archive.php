<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('third','masoner')); ?>>

<?php
$hideImage = array('blogit' , 'nimitykset');
if ( !in_array( get_post_type(), $hideImage) ) { ?>
<div class="archiveImage"><?php the_post_thumbnail('medium'); ?></div>
<?php } ?>
	<header class="entry-header">
		<div clas="kredit">
			<p class="teksti"><?php the_time('j.n.Y') ?></p>		
				<?php
				$postx = get_field('valitsekirjoittaja');
				$themeta = get_field('blogaajan_nimi',$postx); ?>
				<?php echo "<p class='teksti'>&nbsp;" . $themeta . "&nbsp;</p>"; ?>
		</div>
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
 ?>
	</header>

	<div class="entry-content">
		<?php
		if ( has_excerpt( $post->ID ) ) {
    	the_excerpt();
		} else {
			$content = get_the_content(); ?>
			<div class="excerptContainer">
				<p><?php echo wp_trim_words( $content , '20' ); ?></p>
			</div> 	
		<?php } ?>			
	</div>

	<footer class="entry-footer">
		<?php /* ura_lehti_entry_footer(); */?>
	</footer>
</article>