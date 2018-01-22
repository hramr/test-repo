<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ura
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '&#124;', true, 'right' ); ?></title>
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico">
<link rel="profile" href="http://gmpg.org/xfn/11">

<link href="https://fonts.googleapis.com/css?family=Palanquin:100,300,800" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<?php
if ( is_page( array('nimitysuutinen', 'juttuvinkki' )) ) {
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
    }

    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        wpcf7_enqueue_styles();
    }
}
?>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/jquery.masonry.min.js"></script>

<script src="https://use.fontawesome.com/ee02cf3a79.js"></script>
<?php wp_head(); ?>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create", "UA-3516697-9", {"cookieDomain":"auto"});ga("set", "anonymizeIp", true);ga("send", "pageview");
//--><!]]>
</script>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&amp;version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="page" class="site">
<div class="height-wrap">
		<div class="wrap-fixed">
			<div class="wrap-relative">
				<header id="masthead" class="site-header" role="banner">
					<div class="site-branding">
						<a class="logo logo-head" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri() ?>/images/ura.png" alt="Ura-lehti">
						</a>
						<!--Burger-->
							<div id="brg-1" class="block animate">
		            <div class="content burger">
		                <div class="site-menu">
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                </div>
		            </div>
							</div>

						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="searchHeader hideOnTabletPortrait">
					    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
					    <button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>

						<div class="floatRight mobMenufix">
							<ul class="menu-socials">
	                <li class="">
	                    <a class="" href="https://www.facebook.com/Yhteiskuntaala" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
	                </li>
	                <li class="">
	                    <a class="" href="https://twitter.com/Yhteiskuntaala" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
	                </li>
	                <li class="">
	                    <a class="" href="https://www.instagram.com/yhteiskuntaala/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
	                </li>
	                <li class="">
	                    <a class="" href="https://www.youtube.com/user/uralehti" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
	                </li>
	            </ul>
							<a class="logo konserni hideOnMobile" href="http://www.yhteiskunta-ala.fi/" target="_blank" rel="home">
								<img src="<?php echo get_template_directory_uri() ?>/images/liitonlogo.png" alt="Yhteiskunta-alan korkeakoulutetut ry">
							</a>
						</div>
					</div><!-- .site-branding -->
				</header><!-- #masthead -->
			</div>
		</div>
	</div>

    <?php get_template_part('template-parts/content', 'navigation-x'); ?>

	<div id="content" class="site-content">
