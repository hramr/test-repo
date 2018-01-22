<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ura
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
                    <div class="fBlock">
                        <div class="col-4">

                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="footer-logo" src="<?php echo get_template_directory_uri() ?>/images/ura.png"></a>

                            <ul class="footer-contact no-list">
                                <li>Mikonkatu 8 A, 00100 Helsinki</li>
                                <li><a href="callto:010 231 0350"><i class="icon-phone-outline"></i> 010 231 0350</a></li>
                                <li><a href="mailto:toimitus@yhteiskunta-ala.fi"><i class="icon-mail"></i> toimitus@yhteiskunta-ala.fi</a></li>
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>ota-yhteytta/"><i class="icon-info-large-outline"></i> Yhteystiedot</a></li>
                            </ul>

                        </div>

                        <div class="col-8">
                            <nav class="footernav icons">
                                <ul>
                                <li class="level-1 item-jasenyys parent">
                                    <ul>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>ammattilaiset">Ammattilaiset</a></li>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>ilmiot">Ilmiöt</a></li>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>edunvalvonta">Edunvalvonta</a></li>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>lainmukaan">Lain mukaan</a></li>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>tyokyky">Työkyky</a></li>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>nimitykset">Nimitykset</a></li>
                                    </ul>
                                </li>
                                <li class="level-1 parent">
                                    <ul>
                                        <li class="level-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>blogit">Blogit</a></li>
                                        <li class="level-2 "><a href="<?php echo esc_url( home_url( '/' ) ); ?>ota-yhteytta">Ota yhteyttä</a></li>
                                        <li class="level-2 "><a href="<?php echo esc_url( home_url( '/' ) ); ?>nimitysuutinen">Lähetä nimitysuutinen</a></li>
                                        <li class="level-2 "><a href="<?php echo esc_url( home_url( '/' ) ); ?>juttuvinkki">Lähetä juttuvinkki</a></li>
                                        <li class="level-2 "><a href="<?php echo esc_url( home_url( '/' ) ); ?>mediatiedot">Mediatiedot</a></li>
                                        <li class="level-2 "><a href="<?php echo esc_url( home_url( '/' ) ); ?>lehtiarkisto">Lehtiarkisto</a></li>
                                    </ul>
                                </li>
                                <a class="logo konserni hideOnMobile" href="http://www.yhteiskunta-ala.fi/" target="_blank" rel="home">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/liitonlogo.png" alt="Yhteiskunta-alan korkeakoulutetut ry">
                                </a>
                                <li class="level-1 item-ykavaikuttaa parent">Pikalinkit
                                    <?php wp_nav_menu( array( 'theme_location' => 'menu-2' ) ); ?>
                                </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="footer-tail fBlock">

                        <div class="floatLeft">
                            <p><a href="">©</a> 2017 URA-lehti</p>
                        </div>

                        <div class="floatRight">
                            <ul class="footer-some-links no-list">
                                <li><a href="https://www.facebook.com/Yhteiskuntaala/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/yhteiskunta-alan-korkeakoulutetut-ry" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="https://twitter.com/yhteiskuntaala" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/scripts.js"></script>

</body>
</html>
