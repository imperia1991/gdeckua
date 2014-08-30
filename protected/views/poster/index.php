<?php
/** @var Posters[] $posters */
/** @var CategoryPosters[] $categories */
/** @var CategoryPosters $currentCategory */
/** @var string $currentCategoryAlias */
?>
<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.freetile.js');
//Yii::app()->clientScript->registerScriptFile('/js/photo.js', CClientScript::POS_BEGIN);
?>

<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Афишы')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">
        <div class="large-10 medium-9 small-12 columns afisha-section">
            <ul class="tabs">
                <?php foreach ($categories as $key => $category): ?>
                    <li class="tab-title <?php if ($currentCategory->alias == $category->alias): ?>active<?php endif; ?>">
                        <?php $title = 'title_' . Yii::app()->getLanguage(); ?>
                        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/poster/' . $category->alias); ?>"><?php echo $category->{$title}; ?></a>
                    </li>
                <?php endforeach; ?>
<!--                <li class="tab-title year right">-->
<!--                    <select name="Posters[year]">-->
<!--                        <option>2012 год</option>-->
<!--                        <option>2013 год</option>-->
<!--                        <option>2014 год</option>-->
<!--                    </select>-->
<!--                </li>-->
            </ul>

            <?php /*
            <div class="row collapse mounth-pagination">
                <div class="large-12 columns">
                    <div align="left" class="large-4 medium-4 small-4 columns"><img src="/img/arrow-left.png"> <a href="#">Июнь</a></div>
                    <div align="center" class="large-4 medium-4 small-4 columns">Июль</div>
                    <div align="right" class="large-4 medium-4 small-4 columns"><a href="#">Август</a> <img src="/img/arrow-right.png">
                    </div>
                </div>
            </div>
            */ ?>

            <div class="tabs-content">
                <?php $this->renderPartial('partials/_affishes', [
                        'posters' => $posters,
                        'currentCategory' => $currentCategory
                    ]); ?>

                <?php if ($posters->getTotalItemCount() > $posters->getPagination()->pageSize): ?>
                    <div id="showItems" class="large-12 columns show-other-news">
                        <img id="loading" style="display: none" src="/img/loading.gif" alt="" />
                        <a id="showMore" href="javascript:void(0);"><?php echo Yii::t('main', 'Показать еще'); ?></a>
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
                                            'alias': "<?php echo $category->alias; ?>"
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
                                            if ($('#panelItems .item').length) {
                                                $('#panelItems').freetile({
                                                    selector: '.item'
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
            </div>
        </div>

        <!-- RIGHT SECTION NEWS -->
        <?php $this->renderPartial('/partials/_previewNews'); ?>
        <!-- RIGHT SECTION NEWS -->

    </div>
</div>
