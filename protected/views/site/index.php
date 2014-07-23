<?php
/** @var CActiveDataProvider $dataProvider */
?>
<?php
$this->pageTitle = $model->search ? CHtml::encode($model->search) : Yii::t('main', 'Введите, что ищете');
?>

<?php
$currentPage = $dataProvider->getPagination()->currentPage + 1;
?>

<!-- NAVIGATION TOP BAR -->
<div class="large-12 columns navigation-top">
    <p>
        <a href="/"><?php echo Yii::t('main', 'Главная'); ?></a> >
        <?php echo Yii::t('main', 'Поиск'); ?>:
        <?php echo CHtml::encode($model->search); ?>
        (<?php echo Yii::t('main', 'найдено {n} объект|найдено {n} объекта|найдено {n} объектов', [$dataProvider->getTotalItemCount()]); ?>) </p>
    <hr>
</div>
<!-- NAVIGATION TOP BAR -->


<div class="large-12 columns">
    <div class="row collapse">
        <div class="large-4 medium-12 small-12 columns">
            <div class="row collapse mCustomScrollbar">
<!-- LEFT SECTION -->
                <div class="large-12 columns left-section scroll-pane">
                    <div class="row collapse">
                        <?php foreach ($dataProvider->getData() as $data): ?>
                            <?php $this->renderPartial('partials/_item', ['data' => $data]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>


<!-- CENTRAL MAP -->
        <div class="large-6 small-12 columns central-content">
            <div class="map-section">
                <img src="/img/map.png">
            </div>
        </div>

<!-- CENTRAL MAP -->

<!-- RIGHT SECTION NEWS -->
        <div class="large-2 small-12 columns right-section-cont">

            <!-- news block -->
            <div class="right-section">
                <h4>Новости</h4>

                <div class="news-box row">
                    <div class="row collapse">
                        <div class="large-12 medium-3 small-12 columns oglavlenie">
                            <div class="row collapse">
                                <div class="large-4 medium-4 small-2 columns">
                                    <img src="/img/news-img.png">
                                </div>
                                <div class="large-8 medium-8 small-10 columns">
                                    <p>29.05.2014 15:38</p>
                                    <h4>Сегодня
                                        состоялись
                                        выборы в мэры</h4>
                                </div>
                            </div>
                        </div>
                        <div class="large-12 columns medium-9 small-12 description">
                            <p>Всепришли на выборы что бы
                                поддержать своего кандидата
                                на пост главы города......</p>
                            <a align="center" href="#">прочитать статью полностью</a>
                        </div>

                    </div>
                </div>

            </div>
            <!-- news block -->

            <!-- read more news -->
            <div class="row collapse show-news">
                <div class="large-12 columns">
                    <p><a href="#">Читать все новости</a></p>
                </div>
            </div>
            <!-- read more news -->


            <!-- right section reklama -->
            <div class="row collapse reklama-news-box">
                <div class="large-12 medium-12 small-12 columns">
                    <div><a href="#"><img src="/img/reklama.png"></a></div>
                </div>
            </div>
            <!-- right section reklama -->


        </div>
<!-- RIGHT SECTION NEWS -->

    </div>
</div>
<div class="pagination-centered large-12 columns" >
<?php
    $this->widget('CLinkPager', [
        'pages' => $dataProvider->getPagination(),
//                'cssFile'=>Yii::app()->baseUrl."/css/pagination.css",
        'header' => '',
        'selectedPageCssClass' => 'current',
        'footer' => '',
        'internalPageCssClass' => '',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'previousPageCssClass' => 'arrow',
        'htmlOptions' => ['class' => 'pagination'],
        'firstPageCssClass' => 'arrow',
        'firstPageLabel' => Yii::t('main', 'Первая'),
        'lastPageCssClass' => 'last',
        'lastPageLabel' => Yii::t('main', 'Последняя'),
        'nextPageCssClass' => 'arrow',
        'maxButtonCount' => 11
    ]);
?>
</div>

<!--</div>-->
<!--<div class="container">-->
<!--    <div class="content">-->
<!--        <div id="placeMap" class="map-wrap">-->
<!--            --><?php
//                $this->renderPartial('partials/_map', [
//                    'dataProvider' => $dataProvider,
//                    'model' => $model,
//                    'selectDistrict' => $selectDistrict,
//                ]);
//
?>
<!--        </div>-->
<!--    </div>-->
<!--    <div class="line"></div>-->
<!--    <div class="pagination">-->
<!--            --><?php
//            $this->widget('CLinkPager', [
//                'pages' => $dataProvider->getPagination(),
////                'cssFile'=>Yii::app()->baseUrl."/css/pagination.css",
//                'header' => '',
//                'selectedPageCssClass' => 'active',
//                'footer' => '',
//                'internalPageCssClass' => '',
//                'prevPageLabel' => '<',
//                'nextPageLabel' => '>',
//                'previousPageCssClass' => 'prev',
//                'htmlOptions' => array('class' => ''),
//                'firstPageCssClass' => 'first',
//                'firstPageLabel' => '<<',
//                'lastPageCssClass' => 'last',
//                'lastPageLabel' => '>>',
//                'nextPageCssClass' => 'next',
//                'maxButtonCount' => 11
//            ]);
//
?>
<!--    </div>-->
<!--    <div class="line"></div>-->
<!--    --><?php //$this->renderPartial('/partials/_ads'); ?>
<!--    <div class="line"></div>-->
<!--    <div class="container-text">-->
<!--        --><?php //$this->renderPartial('/partials/_find_' . Yii::app()->getLanguage()); ?>
<!--    </div>-->
<!--</div><!-- .container-->-->
<!--<div class="left-sidebar">-->
<!--    <div id="search-content">-->
<!--        <ul class="places">-->
<!---->
<!--        </ul>-->
<!--    </div>-->
<!--</div><!-- .left-sidebar -->-->

<script type="text/javascript">
    jQuery('a.gallery').colorbox();
</script>

