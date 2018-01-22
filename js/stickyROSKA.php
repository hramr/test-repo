<script type="text/javascript">

function sticky(){
    // Check the initial Position of the Sticky Header
    var stickyHeaderTop = $('#sticky').offset().top;
    //TODO make panel position absolute when it's panelBottom reaches footerTop
    var singlePanelW =  $('.singlePanel').width();
    $(window).scroll(function(){
        if( $(window).scrollTop() > stickyHeaderTop ) {
            $('#sticky').css({position: 'fixed', top: '20px', width: singlePanelW});
            $('#stickyalias').css('display', 'block');
        } else {
            $('#sticky').css({position: 'static', top: '0px'});
            $('#stickyalias').css('display', 'none');
        }
    });
};

window.onload = function(){
    <?php if ( is_single()){ ?>
        //sticky();
    <?php } ?>
}
</script>