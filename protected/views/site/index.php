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
        <?php echo $this->rendderPartial('/partials/_news'); ?>
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

