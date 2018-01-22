<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ura
 */

?>

<!--blogit 34052874-->
<div class="quartLabel blogitEtu"><h2>Blogit</h2></div>
<div class="quartWrap qWblogs">
<div class="wrapBB">
    <img class="yAv" src="<?php echo get_template_directory_uri() ?>/images/blogin-header-82.jpg">
    <div class="dF">
    <?php
    //lets loop the latest post from 'puheenjohtajalta' & 'toiminnanjohtajalta' and pass termName to next loop
    $main = new WP_Query (array( 
        'post_type' => 'blogit', 
        'posts_per_page' => 1,
        'tax_query' => array(
        array(
            'taxonomy' => 'blokaus',
            'field'    => 'slug',
            'terms'    => array('puheenjohtajalta', 'toiminnanjohtajalta'),
            ),
        ),
        ));
    if( have_posts() ) :
        while( $main->have_posts() ) : $main->the_post();
            //get latest post ID            
            $id = get_the_ID();
            $taxonomy = 'blokaus';
            $terms = get_the_terms( $id, $taxonomy );
            foreach ($terms as $term) {
              $catForLatest = $term->name;              
            }            
        endwhile;
    endif;
    ?>

    <?php
        $cats = array( 'vierailija', 'paatoimittajalta', $catForLatest, 'nakokulma','korjaussarja');
        $exclude_posts = array();
        foreach( $cats as $cat )
        {
            // build query argument
            $query_args = array(
                'showposts' => 1,
                'post_type' => 'blogit',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
    			        array(
    			            'taxonomy' => 'blokaus',
    			            'field'    => 'slug',
    			            'terms'    => $cat,
    			        ),
    			    )
            );

            // exclude post that already have been fetched
            // this would be useful if multiple category is assigned for same post
            if( !empty($exclude_posts) )
                $query_args['post__not_in'] = $exclude_posts;

            // do query
            $query = new WP_Query( $query_args );
            
            if ( $query->have_posts() ) {

                while ( $query->have_posts() ) {
                    // set post global
                    $query->the_post();

                    // add current post id to exclusion array
                    $exclude_posts[] = get_the_ID();

                    ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class( ' blogaukset '); ?>>
    					<div class="post-entry">
    						<div class="wrapBlog">

    							<?php
                                $postx = get_field('valitsekirjoittaja');
    							$image_id = get_field('blogaajan_kuva',$postx);
                                $image_size = 'thumbnail';
                                $image_array = wp_get_attachment_image_src($image_id, $image_size);
                                $image_url = $image_array[0];
    							if( !empty($image) ): ?>
    								<a class="bloggerPhoto" href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" /></a>
    							<?php endif; ?>

    							<div class="wrapBlogFront">

    								<div class="category">
    									<p><?php
    				                        $cat = new WPSEO_Primary_Term('blokaus', get_the_ID());
    				    					$cat = $cat->get_primary_term();
    				    					$catName = get_cat_name($cat);
    				    					echo $catName;
    			    					?></p>
    								</div>

    								<div class="Titteli"><p><?php the_field('blogaajan_nimi',$postx); ?></p></div>

    				 				<div class="blogiPvm"><p><?php the_time('j.n.Y') ?></p></div>

    			 				</div>

    		 				</div>
    					</div>
    					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    				</div>
    				<?
            }
            }
            // Restore original Post Data
            wp_reset_postdata();
        }

    ?>
</div>
</div>
<div class="blogsPlus">
    <h2>Lisää blogeja</h2>
    <ul class="no-list">
    <?php $main = new WP_Query (array( 'post_type' => 'blogit', 'posts_per_page' => 6, 'post__not_in' => $exclude_posts ));
    if( have_posts() ) :
        while( $main->have_posts() ) : $main->the_post();
            // acf stuff
            $postx = get_field('valitsekirjoittaja');            
            ?>
        <div class="Titteli"><p><?php the_field('blogaajan_nimi',$postx); ?></p></div>
        <li>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </li>
    <?php endwhile; endif; ?>
    </ul>
</div>
</div>
