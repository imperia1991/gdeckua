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
                    <div class="row collapse places">
                        <?php foreach ($dataProvider->getData() as $data): ?>
                            <?php $this->renderPartial('partials/_item', ['data' => $data]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>


<!-- CENTRAL MAP -->
        <div class="large-6 small-12 columns central-content">
            <div id="placeMap" class="map-section">
                <?php
                $this->renderPartial('partials/_map', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'selectDistrict' => $this->selectDistrict,
                ]);

                ?>
            </div>
        </div>

<!-- CENTRAL MAP -->

<!-- RIGHT SECTION NEWS -->
        <div class="large-2 small-12 columns right-section-cont">

            <!-- news block -->
            <div class="right-section">
                <h4><?php echo Yii::t('main', 'Новости'); ?></h4>

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
                            <a align="center" href="#"><?php echo Yii::t('main', 'прочитать статью полностью'); ?></a>
                        </div>

                    </div>
                </div>

            </div>
            <!-- news block -->

            <!-- read more news -->
            <div class="row collapse show-news">
                <div class="large-12 columns">
                    <p><a href="#"><?php echo Yii::t('main', 'Читать все новости'); ?></a></p>
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

<script type="text/javascript">
    jQuery('a.gallery').colorbox();
</script>

