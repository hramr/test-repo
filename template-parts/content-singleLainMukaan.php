<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */
global $post_id;
$postType = get_post_type();
$obj = get_post_type_object( $postType );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php //category for regular posts
			$categories = get_the_category(); ?>

			<p class="category_name" style="display:inline-block;">
				<?php
				if ( get_post_type() == 'post') {
					echo $categoryName;
				} else {
					echo $obj->labels->singular_name;
				} ?>
			</p>

			<div clas="kredit">
				<p class="teksti"><?php the_time('j.n.Y') ?></p>

						<?php
							$key = 'kirjoittaja';
							$themeta = get_post_meta($post->ID, $key, TRUE);
							if($themeta != '') {
								echo "<p class='teksti'>&nbsp;|&nbsp;Teksti: " . $themeta . "&nbsp;</p>";
							}
						?>
						<?php
							$key = 'kuvaaja';
							$themeta = get_post_meta($post->ID, $key, TRUE);
							if($themeta != '') {
								echo "<p class='foto'>| Kuvat: " . $themeta . "</p>";
							}
						?>

			</div>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header>

		<div class="">
			<?php	the_excerpt(); ?>			
		</div>

		<?php if ( has_post_thumbnail()) : ?>
		  <div class="featuredImage">
				<?php the_post_thumbnail(); ?>
				<?php
				$caption = ''; 
				$caption = get_post(get_post_thumbnail_id())->post_excerpt;
					if ($caption != '') {
						echo '<div class="caption">';
						echo $caption;
						echo '</div>';
					}
				?>					
			</div>
	 <?php endif; ?>

	<div class="entry-content">

		<?php	the_content(); ?>

		<div class="some-gear">
			<div class="jaa">Jaa artikkeli</div>
      <a class="blank" rel="nofollow" target="_blank" title="facebook" href="http://www.facebook.com/share.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>&title=<?php print(urlencode(get_the_title()));?>&p[images][0]">
        <i class="fa fa-facebook-square" aria-hidden="true"></i>
      </a>
      <a class="blank" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>&title=<?php wp_title(); ?>">
        <i class="fa fa-linkedin-square" aria-hidden="true"></i>
      </a>
      <a class="blank" href="http://twitter.com/home?status=<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>+<?php wp_title(); ?>" title="twitter" rel="nofollow" target="_blank">
       <i class="fa fa-twitter-square" aria-hidden="true"></i>
      </a>
	  </div>

	 <div class="liitto">	
		<h2>Tarvitsetko lakineuvontaa?</h2>
		<p>Liiton jäsenenä saat <a href="http://www.yhteiskunta-ala.fi/edut-ja-palvelut/edunvalvonta-ja-palvelussuhdeneuvonta/">lakineuvontaa</a> sekä työhön että yksityiselämään liittyvissä oikeudellisissa asioissa. 
		Hyödynnä myös virtuaalilakimiehen palveluja muun muassa esimiestyön ja liiketoiminnan lakikysymyksissä.
		</p>
	</div>

	</div>


	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						esc_html__( 'Muokkaa %s', 'ura-lehti' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer>
	<?php endif; ?>

</article>
