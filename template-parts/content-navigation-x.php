<!--Preheader menu-->

<div id="navbar">

<div class="main-nav block block-menu block-none clearfix animate">
        <div class="content">
            <ul class="menu">
                <div class="menu-wrap">
                    <div class="wrap-fixed relative">
                        <div class="inline-block w100">                      
                            <?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) );  ?>  
                            <?php wp_nav_menu( array( 'theme_location' => 'menu-2' ) ); ?>
                            <div id="brg-1" class="block block-block clearfix animate hideOnMobile hideOnTablet" style="position: absolute;right: 0; bottom: 13px;">                    
                                <div class="content burger">
                                    <div class="site-menu open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>                    
                            </div>                            
                        </div>
                    </div>
                </div>
            </ul>
        </div>
   </div>
</div>