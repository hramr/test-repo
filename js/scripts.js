

window.onload = function(){
    resize();
}

function resize(){
	$( window ).resize(function(){        
        animateMenu();
		if (window.innerWidth >= 737) {            
        }
	});
}
	
$(document).ready(function() {

    $('.next a').live('click', function(e) {
        e.preventDefault();
        $(this).addClass('loading').html('<div class="loadMore2">Lataan</div>');
        $.ajax({
            type: "GET",
            url: $(this).attr('href') + '#trio2',
            dataType: "html",
            success: function(out) {
                result = $(out).find('.masoner');
                $result = $(result);
                nextlink = $(out).find('.next a').attr('href');
                youtubers();

                $('#trio2').append(result)/*.masonry('appended', $result)*/;
                
                $('.next a').removeClass('loading').html('<div class="loadMore">Lataa lisää</div>');

                if (nextlink != undefined) {
                    $('.next a').attr('href', nextlink);
                } else {
                    $('.navigation').remove();
                }
            }
        });

    });

	if (window.innerWidth >= 737) {
	   
	}
    if (window.innerWidth >= 1024) {
       
    }
});

/*functions*/

function navHTMP(){
    var navH = $('.height-wrap').height();
    $('ul.menu').css('padding-top', navH);
    var maxH = window.innerHeight;
    $('.scrollz').css('max-height', maxH - navH);
}

animateMenu();

function animateMenu() {

    var menuH = $('.menu').height();

    function handler1() {

        $("#menu-navbar").css('display', 'block');        
        $('.main-nav').stop().animate({
            height: menuH + 'px'
        }, 500);
         $('html,body').animate({'scrollTop' : 0},1000);        
        $("#brg-1 .site-menu").addClass('open');
        $('#brg-1 .site-menu').one("click", handler2);
    }

    function handler2() {
        $("#menu-navbar").css('display', 'none');
        $('.main-nav').stop().animate({
            height: 0 + 'px'
        }, 500);
        $('#brg-1 .site-menu').one("click", handler1);
        $("#brg-1 .site-menu").removeClass('open');
    }
    $("#brg-1 .site-menu").one("click", handler1);

}

// 

// define what happens once the image is loaded.
// get image size and define new image proportions
function youtubers() {
    var img = new Image();
    var imageSrc = 'https://uralehti.fi/wp-content/uploads/2017/02/0-1-x.jpg';
    var newHeight;

    img.onload = function() {
        var width = img.width;
        var height = img.height;
        var proportion = width/height;



            $(".youtube").each(function() {    
                var containerWidth = $(this).parent().width();    
                newHeight = containerWidth / proportion;

                $(this).css('height', newHeight+ 'px');
                $(this).css('width', 100+ '%');
                $('.youtube ifame').css('height', newHeight+ 'px');
                $('.youtube ifame').css('width', 100+ '%');
        
            $(document).delegate('.youtube', 'click', function() {
                var id = this.id;
                console.log('click' + id);
                // Create an iFrame with autoplay set to true
                var iframe_url = "https://www.youtube.com/embed/" + id + "?autoplay=1&autohide=1";
                if ($(this).data('params')) iframe_url+='&'+$(this).data('params');
        
                // The height and width of the iFrame should be the same as parent
                var iframe = $('<iframe/>', { 'allowfullscreen':"allowfullscreen",'frameborder': '0', 'src': iframe_url, 'width': $(this).width(), 'height': $(this).height() })
        
                // Replace the YouTube thumbnail with YouTube HTML5 Player
                $(this).replaceWith(iframe);
            });
        });
    }
    img.src = imageSrc; 
}

$(window).bind("load resize", function() {
    youtubers();
});

