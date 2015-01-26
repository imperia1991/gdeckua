<?php
/** @var CActiveDataProvider $posters */
/** @var CategoryPosters $currentCategory */
?>

<?php if ($currentCategory->is_affisha): ?>
    <div id="panelItems">
        <?php $this->renderPartial(
            'partials/_affishesItems',
            [
                'posters' => $posters,
                'currentCategory' => $currentCategory
            ]
        ); ?>
    </div>
<?php else: ?>
    <div id="panelItems" style="height: auto">
        <?php $this->renderPartial(
            'partials/_otherItems',
            [
                'posters' => $posters,
                'currentCategory' => $currentCategory
            ]
        ); ?>
    </div>
<?php endif; ?>

<?php if ($posters->getTotalItemCount() > $posters->getPagination()->pageSize): ?>
    <div id="showItems" class="large-12 columns show-other-news">
        <img id="loading" style="display: none" src="/img/loading.gif" alt="" />
        <a id="showMore" href="javascript:void(0);" class="more_news button"><?php echo Yii::t('main', 'Показать еще'); ?></a>
    </div>
    <script type="text/javascript">
        /*<![CDATA[*/
        (function($)
        {
            var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
            var pageCount = parseInt('<?php echo (int)$posters->pagination->pageCount; ?>');

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
                            'page': page + 1,
                            'alias': "<?php echo $currentCategory->alias; ?>"
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
                            $('#panelItems').append(data);
                            if ($('#panelItems .photo_item').length) {
                                $('#panelItems').freetile({
                                    selector: '.photo_item'
                                });
                            }

                            // если достигли максимальной страницы, то прячем кнопку
                            if (page >= pageCount)
                                $('#showItems').hide();

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
