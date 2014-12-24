<?php
/** @var CActiveDataProvider $photos */
?>
<!--<div class="js-masonry" id="panelPhotoCity" data-masonry-options='{ "itemSelector": ".item" }'>-->
<div class="" id="panelPhotoCity">
    <?php $this->renderPartial(
        'partials/_photoView',
        [
            'photos' => $photos,
        ]
    ) ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#panelPhotoCity").freetile({
            selector: '.item',
            containerResize: false
        });
    });
</script>
<?php if ($photos->getTotalItemCount() > $photos->getPagination()->pageSize): ?>
<div id="showPhotos" class="large-12 medium-6 columns show-other-news">
    <img id="loading" style="display: none" src="/img/loading.gif" alt="" />
    <a id="showMore" href="javascript:void(0);"><?php echo Yii::t('main', 'Показать еще фотографии'); ?></a>
</div>
<script type="text/javascript">
    /*<![CDATA[*/
    (function($)
    {
        // скрываем стандартный навигатор
//            $('.paginator').hide();

        // запоминаем текущую страницу и их максимальное количество
        var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
        var pageCount = parseInt('<?php echo (int)$photos->pagination->pageCount; ?>');

        var loadingFlag = false;

        $('#showMore').on('click', function()
        {
            // защита от повторных нажатий
            if (!loadingFlag)
            {
                // выставляем блокировку
                loadingFlag = true;

                // отображаем анимацию загрузки
                $('#showMore').hide();
                $('#loading').show();

                $.ajax({
                    type: 'post',
                    url: location.href,
                    data: {
                        // передаём номер нужной страницы методом POST
                        'page': page + 1
                    },
                    success: function(data)
                    {
                        // увеличиваем номер текущей страницы и снимаем блокировку
                        page++;
                        loadingFlag = false;

                        // прячем анимацию загрузки
                        $('#loading').hide();
                        $('#showMore').show();

                        // вставляем полученные записи после имеющихся в наш блок
                        $('#panelPhotoCity').append(data);
                        $('#panelPhotoCity').freetile({
                            selector: '.item'
                        });

                        $(".gallery").colorbox({
                            slideshow: false,
                            rel: 'slideshow',
                            current: "{current}/{total}"
                        });

                        // если достигли максимальной страницы, то прячем кнопку
                        if (page >= pageCount)
                            $('#showPhotos').hide();

                        var n = $(document).height();
                        $('html, body').animate({ scrollTop: n }, 1000);
                    },
                    done: function()
                    {
                        $('#loading').hide();
                        $('#showMore').show();
                    }
                });
            }
            return false;
        })
    })(jQuery);
    /*]]>*/
</script>

<?php endif; ?>
