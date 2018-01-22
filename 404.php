<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ura
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
			<div class="left-404">
				<img class="img-404" src="<?php echo get_template_directory_uri() ?>/images/404.jpg" alt="Uralehti 404">
			</div>
			<div class="right-404">
			
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Voi ei!', 'ura-lehti' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Sivua ei löytynyt. Kokeile hakutoimintoamme tai siirry etusivulle', 'ura-lehti' ); ?></p>

					<?php
						get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );

						// Only show the widget if site has multiple categories.
						if ( ura_lehti_categorized_blog() ) :
					?>
					
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Juttujen aiheet', 'ura-lehti' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div>

					<?php
						endif;

						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'ura-lehti' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div>
				</div>
			</section>

		</main>
	</div>

<?php
get_footer();
