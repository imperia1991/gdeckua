var news = {
    toggleWatermark: function() {
        $('#isWatermark').on('click', function(){
//            console.log();
            $.get('/admin/news/toggleWatermark', {data: ($(this).attr('checked') ? 1 : 0)}, function(response){

            });
        });
    }
};

$(document).ready(function () {
    news.toggleWatermark();
});