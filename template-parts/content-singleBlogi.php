<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */
global $post_id;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php //category for blogit post_type
	    $cat = new WPSEO_Primary_Term('blokaus', get_the_ID());
			$cat = $cat->get_primary_term();
			$catName = get_cat_name($cat);			
		?>

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
	<?php
	else: ?>
		<img src="http://uralehti.fi/wp-content/themes/ura-lehti/images/blogin-header-82.jpg">
	<?php endif; ?>

	<p class="category_name" style="display:inline-block;">
		<?php echo $catName; ?>
	</p>

	<?php // acf fields
			$postx = get_field('valitsekirjoittaja');
			$image = get_field('blogaajan_kuva', $postx);
			$img_src = wp_get_attachment_image_url( $image['id'], 'medium' );
			$img_srcset = wp_get_attachment_image_srcset( $image['id'], 'medium' );
			$bN = get_field('blogaajan_nimi', $postx);
			$bE = get_field('blogaajan_esittely', $postx);
	?>		

	<div clas="kredit">
		<p class="teksti"><?php the_time('j.n.Y') ?></p>
			<?php $themeta = get_field('blogaajan_nimi', $postx); ?>
			<?php echo "<p class='teksti'>&nbsp;" . $themeta . "&nbsp;</p>"; ?>
	</div>

	<div class="entry-content">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<?php	the_content(); ?>

			<?php
			if ( !empty($image) && !empty($bN) && !empty($bE) ) :
			?>

			<div class="bloggerInfo">			
				<div class="bloggerLeft">
					<?php							
						if( !empty($image) ): ?>
							<img src="<?php echo esc_url( $img_src ); ?>"
							width = "<?php echo $image['sizes']['Stripe-width']; ?>"
							height = "<?php echo $image['sizes']['Stripe-height']; ?>"
							srcset="<?php echo esc_attr( $img_srcset ); ?>"
							sizes="(max-width: 100vw) 480px" alt="<?php echo $image['alt']; ?>">
						<?php endif; ?>
				</div>
				<div class="bloggerRight">
					<h4><?php echo $bN; ?></h4>
					<p><?php echo $bE; ?></p>
				</div>
			</div>

			<?php endif; ?>			

			<?php

			if(get_the_tag_list()) {
			    echo get_the_tag_list('<ul class="blogitTags"><li>','</li><li>','</li></ul>');
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			?>

		<?php /*
			$posts = get_field('valitsekirjoittaja');
				if (!empty($posts)) :
					$kirjNimi = $posts->post_title;
					$kirjKuvaus = $posts->post_content;					
			?>

				<div class="bloggerInfo acf2">			
					<div class="bloggerLeft">
						<?php
						echo get_the_post_thumbnail( $posts->ID );
						?>
					</div>
					<div class="bloggerRight">
						<h4><?php echo $kirjNimi; ?></h4>
						<p><?php echo $kirjKuvaus; ?></p>
					</div>
				</div>

			<?php 
			endif; wp_reset_postdata(); */?>
		
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

	<div class="latest">

		<?php
		//this for cpt
		$postType = get_post_type();
		$obj = get_post_type_object( $postType );
		?>

		<h1>
		<?php
			//echo $obj->labels->singular_name;	
			echo $catName;
		?>
		</h1>

		<?php
		$post_id = get_the_ID();
		$args=array(
			'post__not_in'=> array($post_id),
			'post_type' => 'blogit', 
			'tax_query' => array(
        array(
            'taxonomy' => 'blokaus',
            'field'    => 'slug',
            'terms'    => $catName,
        ),
    ),
			'posts_per_page' => 10 );
		?>

		<?php $the_query = new WP_Query($args); ?>
		
		<?php while ($the_query -> have_posts()) : $the_query -> the_post();	?>

		 		<?php if ( get_post_type() == 'blogit' && $catName == 'Vierailija'  ) :
		 		?><div class="blogGuest"> <?
					$image = get_field('blogaajan_kuva');
					$img_src = wp_get_attachment_image_url( $image['id'], 'medium' );
					$img_srcset = wp_get_attachment_image_srcset( $image['id'], 'medium' );
							if( !empty($image) ): ?>
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo esc_url( $img_src ); ?>"
									width = "<?php echo $image['sizes']['Stripe-width']; ?>"
									height = "<?php echo $image['sizes']['Stripe-height']; ?>"
									srcset="<?php echo esc_attr( $img_srcset ); ?>"
									sizes="(max-width: 100vw) 480px" alt="<?php echo $image['alt']; ?>">
								</a>
							<?php endif; ?>

						<?php else :

						?><div class="half"> <?

							the_post_thumbnail();

							endif;?>
					
					<?php if ( has_post_thumbnail() || get_post_type() == 'blogit' ) { ?>
						<div class="wrapLatestContent">
							<div class="post-meta">
					   		<p class="teksti"><?php the_time('j.n.Y') ?></p>
							</div>																
							<a href="<?php the_permalink() ?>">
								<h2><?php the_title(); ?></h2>				
							</a>
									<?php
									// get post by post id
								  $post = get_post( $post->ID );

								  // get post type by post
								  $post_type = $post->post_type;

								  // get post type taxonomies
								  $taxonomies = get_object_taxonomies( $post_type, 'blokaus' );
								  
								  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

								    // get the terms related to post
								    $terms = get_the_terms( $post->ID, $taxonomy_slug );								    								   

								    if ( !empty( $terms ) && $catName !== 'Päätoimittajalta' && $catName !== 'Toiminnanjohtajalta' ) {
								      if ($taxonomy->label == 'Blogaukset') {
								        foreach ( $terms as $term ) {
								          echo '<p class="category_name"><a href="' . get_term_link( $term->slug, $taxonomy_slug ) .'"> '. $term->name. '</a></p>';
								        }
								    	} 
								    }
								  }
									?>
					<?php } ?>

					</div>
					</div>

		
			<?php endwhile;?>		

		</div>

</article>
