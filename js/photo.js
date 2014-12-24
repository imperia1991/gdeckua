var $container;
$(document).ready(function() {
    $container = $('#panel2-1 .list-view');
    // Инициализация
    $container.masonry({
        itemSelector: '.item'
    });
});