$(document).ready(function() {

        $('.works').isotope({
            itemSelector: '.work'
        });

        $('#filter a').click(function(){
		
            $('#filter a').removeClass('current');
            $(this).addClass('current');
            var selector = $(this).attr('data-filter');
			
            $('.works').isotope({
                filter: selector,
                animationOptions: {
                    duration: 1000,
                    easing: 'easeOutQuart',
                    queue: false
                }
            });
            return false;

        });

});