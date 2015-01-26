var news_slider;
var slider = false;
$(document).ready(function(){
   $('[placeholder]').focus(function() {   
    var input = $(this);
      if (input.val() == input.attr('placeholder')) {
        input.val('');
        input.removeClass('placeholder');
      }
      if ($(this).hasClass('password')) input.attr('type', 'password');
    }).blur(function() {
      var input = $(this);
      if (input.val() == '' || input.val() == input.attr('placeholder')) {
        input.addClass('placeholder');
        input.val(input.attr('placeholder'));
        if ($(this).hasClass('password')) input.attr('type', 'text')
      }
    }).blur().parents('form').submit(function() {
      $(this).find('[placeholder]').each(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
          input.val('');
        }
      })
    });

  $('.slct').click(function(){
    $('.drop').css('z-index', 49).slideUp(function(){$(this).css('z-index', 50)});
    $('.slct').removeClass('active');
    var dropBlock = $(this).parent().find('.drop');
    if( dropBlock.is(':hidden') ) {
      dropBlock.slideDown();
      $(this).addClass('active');;
      dropBlock.find('li').children('a').click(function(){
        var selectResult = $(this);
        $(this).parent().parent().parent().find('input').val(selectResult.attr('href'));
        $(this).parent().parent().parent().find('.slct').html(selectResult.html());
        dropBlock.slideUp(function(){
          selectResult.parent().parent().parent().find('.slct').removeClass('active');
        });
        return false;
      });
    } else {
      var c = $(this);      
      dropBlock.slideUp(function(){c.removeClass('active');});
    }
    return false;
  });

  $('*').not('.select, .select *').click(function(){
     $('.drop').slideUp(function(){$('.slct').removeClass('active');});

  })



  $('.right_block_go_top').click(function(){
    $('html, body').animate({scrollTop : 0});
    return false;
  })
  $('.right_block_go_bot').click(function(){
    $('html, body').animate({scrollTop : $('.container').height()});
    return false;
  })
  if ($(window).innerWidth()<960){
    $('.container').addClass('menu_closed');
    $('.content_advertise').show();
  }

  $('.menu_icon').click(function(){
    if ($('.container').hasClass('menu_closed')){      
      $('.content_advertise').slideUp(function(){
        $('.container').removeClass('menu_closed');
        setTimeout(function(){
          if (slider) news_slider.redrawSlider();
        }, 500)
      });
    }else{
      $('.container').addClass('menu_closed');
      setTimeout(function(){
        $('.content_advertise').slideDown();
        if (slider) news_slider.redrawSlider();
      }, 500)
    }
    return false;
  })

  $('.enter_pop_up_link').click(function(){
    $('.cover').show();
    $('#enter_pop_up').css('top', $(window).scrollTop()+50).show();
    return false;
  })
  $('.registr_pop_up_link').click(function(){
    $('.cover').show();
    $('#registr_pop_up').css('top', $(window).scrollTop()+50).show();
    return false;
  })
  $('.cover').click(function(){
    $('.pop_up, .cover').hide();
  })
  $('.pop_up_close').click(function(){
    $('.pop_up, .cover').hide();
    return false;
  })

  $('.check').click(function(){
    if( $(this).hasClass('active') ) {
      $(this).removeClass('active');
      $(this).find('input').removeAttr('checked');
    } else {
      $(this).addClass('active');
      $(this).find('input').attr('checked', true);
    }
  });
  $('.feedback_link').click(function(){
    $('.cover').show();
    $('#feedback').css('top', $(window).scrollTop()+50).show();
    return false;
  })
  $('.page_content').css('min-height', $('.sidebar_wrap').height()-$('header').height()-$('footer').height())

  $('.object_map').css('height', $('.object_big_photo').height()+$('.objects_previews').height()+14);
  setTimeout(function(){
    $('.object_photo_block h2,.object_adress h2').removeAttr('style').css('height', Math.max( $('.object_photo_block h2').height(),$('.object_adress h2').height()));
  
  },100)

  $('.main_news_list').each(function(){
    news_slider = $(this).bxSlider({
      pager: false,
      hideControlOnEnd: true
    })
    slider = true;
  })

  $("#panelPhotoCity").freetile({
    selector       : '.photo_item',
    containerResize: false
  });

  $(".colorbox").colorbox({
      slideshow: false,
      rel: 'slideshow',
      current: "{current}/{total}"
  });

  if ($('.webcam_list_item').length) {
    $('.webcam_list_item').on('click', function() {
      var dataWeb = $(this).data('web');
      $('.webcam_list_item.active').removeClass('active');
      $(this).addClass('active');
      $('.webcam_block').hide();
      $('#' + dataWeb).show();
    });
  }

})

$(window).scroll(function(){
  $('.right_block_go_bot').css({
    'position' : 'fixed',
    'left': $('.right_block').offset().left,
    'top': 30
  });
  $('.right_block_go_top').css({
    'position' : 'fixed',
    'left': $('.right_block').offset().left,
    'bottom': 250
  });

  if ($(window).scrollTop()>200){
    $('.right_block_go_bot').css({'opacity':0});
  }else{
    $('.right_block_go_bot').css({'opacity':1});  
  }
  if ($(window).scrollTop()>500){
    $('.right_block_go_top').css({'opacity':1});
  }else{   
    $('.right_block_go_top').css({'opacity':0});  
  }
  if ($(window).scrollTop()>$('.sidebar_wrap').height()){
    $('.mobile_go_top').addClass('active')
  }else{
    $('.mobile_go_top').removeClass('active')
  }
  

})

$(window).resize(function(){

/*  if ($(window).innerWidth()<960){
    $('.container').addClass('menu_closed');
    $('.content_advertise').show();
  }*/
  $('.object_map').css('height', $('.object_big_photo').height()+$('.objects_previews').height()+14);
  $('.object_photo_block h2,.object_adress h2').removeAttr('style').css('height', Math.max( $('.object_photo_block h2').height(),$('.object_adress h2').height()));
  $('.page_content').css('min-height', $('.sidebar_wrap').height()-$('header').height()-$('footer').height());
})