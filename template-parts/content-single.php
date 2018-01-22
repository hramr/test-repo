<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */
global $post_id;
//this for cpt
$postType = get_post_type();
$obj = get_post_type_object( $postType );

//this for post_type_post
$category = get_the_category();
$categoryName = $category[0]->cat_name;
$categoryId = $category[0]->cat_ID;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php //category for regular posts
			$categories = get_the_category(); ?>

			<p class="category_name" style="display:none;">
				<?php
				if ( get_post_type() == 'post') {
					echo $categoryName;
				} else {
					echo $obj->labels->singular_name;
				} ?>
			</p>

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

		<?php if ( has_post_thumbnail()) { ?>
		<?php
			$post_id = get_the_ID();
			$key = '_youtube_src';
			$themeta = get_post_meta($post->ID, $key, TRUE);
		?>
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		?>
		<?php if (empty($themeta)) { ?>
			<div class="featuredImage">
				<?php the_post_thumbnail('full'); ?>
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
		<?php } else { ?>
			<div onclick="trackOutboundLink('<?php echo the_permalink(); ?>'); return false;"  class="youtube" style="background-position: 0;background-image: url('<?php echo $thumb['0'];?>');" id="<?php echo $themeta; ?>"  data-params="modestbranding=1&showinfo=0&controls=1&vq=hd720">
				<div class="play"></div>
			</div>
		<?php } } ?>

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

	<?php if ( !is_mobile()) :  ?>

	<div class="latest">

		<h1><?php
			if ($postType == 'post') {
				echo $categoryName;
			}	else {
				echo $obj->labels->singular_name;
			}
			?>
		</h1>

		<?php
		$post_id = get_the_ID();
		$args=array('post__not_in'=> array($post_id),'post_type' => $postType, 'cat'=> $categoryId,'posts_per_page' => 10 );
		?>

		<?php $the_query = new WP_Query($args); ?>

			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

				<div class="half masoner">

				<?php if ($postType !== 'nimitykset') {
					the_post_thumbnail('medium');
				} ?>

				<?php if ( has_post_thumbnail() ) { ?>
					<div class="wrapLatestContent">
				<?php } ?>

				<div class="post-meta">
				    <p class="teksti"><?php the_time('j.n.Y') ?></p>
				</div>

				<a href="<?php the_permalink() ?>">
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
				</a>
				<?php if ( has_post_thumbnail() ) { ?>
				</div>
				<?php } ?>

				</div>

			<?php endwhile;?>

			<?php if ($postType !== 'post') { ?>
				<div class="aW">
					<?php
					echo '<a href="/' . $postType . '"><div class="loadMore">Lisää</div></a>';
					?>
				</div>
			<?php } ?>

	</div>

<?php endif; ?>

</article>
