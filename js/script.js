$(document).ready(function(){    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 250) {
            $('.back-top').fadeIn();
        } else {
            $('.back-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('.back-top').on('click', function () {
        $('body,html').animate({scrollTop: 0}, 800);
        return false;
    });
    
    $(".call-popup").on('click', function(e){
        if($($(this).attr('href')).hasClass('popup-active')){            
            $('.popup').hide();
            $(".popup").removeClass('popup-active');
            return;
        }
        $(".popup").hide();
        $(".popup").removeClass('popup-active');
        
        $($(this).attr('href')).show();
        $($(this).attr('href')).addClass('popup-active');
        var offset = $(this).offset();        
        var left = offset.left < 480 ? 165 : 137;

        $(".popup").css({"left": offset.left-left + 'px'});        
    });
    $(".close-popup").on('click', function(e){        
        $('.popup').hide();
        $(".popup").removeClass('popup-active');
    });
        
    $(".left-sidebar ul li a img").hover(
        function() {
            $(this).parent().find('i').css({'display': 'block'});        
        }, function() {
             $(".enlarge").css({'display': 'none'});        
        }        
    );
    $(".left-sidebar ul li").on('click', function(){
        $(".left-sidebar ul li").removeClass('item-active');
        $(this).addClass('item-active');        
    });
    
        
    $("#search-content").mCustomScrollbar();    
    var customScrollbar=$("#search-content").find(".mCSB_scrollTools");
    customScrollbar.css({"opacity":0});
    $("#search-content").mCustomScrollbar("update");
    customScrollbar.animate({opacity:1},"slow");
});