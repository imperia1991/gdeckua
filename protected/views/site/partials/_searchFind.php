<?php
/** @var Places $items */
/** @var CPagination $pages */
?>
<?php
$currentPage = $pages->currentPage + 1;
?>
<?php
$this->breadcrumbs = [
//    '' => Yii::t('main', 'Поиск') . ': ' . CHtml::encode($model->search) . ' (' . Yii::t('main', 'найдено {n} объект|найдено {n} объекта|найдено {n} объектов', [$dataProvider->getTotalItemCount()]) . ')'
    '' => Yii::t('main', 'Поиск') . ': ' . $model->search
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">
        <div id="findedPlaces" class="large-4 medium-4 small-12 columns">
            <div class="row collapse">
                <!-- LEFT SECTION -->
                <div class="large-12 columns left-section scroll-pane">
                    <div class="row collapse places">
                        <?php foreach ($items as $data): ?>
                            <?php $this->renderPartial('partials/_item', ['data' => $data]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- CENTRAL MAP -->
        <div class="large-6 medium-5 small-12 columns central-content">
            <div id="placeMap" class="map-section">
                <?php
                /*$this->renderPartial('partials/_map', [
                        'items' => $items,
                        'model' => $model,
                        'selectDistrict' => $this->selectDistrict,
                    ]);*/

                ?>
            </div>
        </div>

        <!-- CENTRAL MAP -->

        <!-- RIGHT SECTION NEWS -->
        <?php echo $this->renderPartial('/partials/_previewNews'); ?>
        <!-- RIGHT SECTION NEWS -->

    </div>
</div>
<div class="pagination-centered large-12 columns" >
    <?php
    $this->widget('CLinkPager', [
            'pages' => $pages,
//                'cssFile'=>Yii::app()->baseUrl."/css/pagination.css",
            'header' => '',
            'selectedPageCssClass' => 'current',
            'footer' => '',
            'internalPageCssClass' => '',
            'prevPageLabel' => '<',
            'nextPageLabel' => '>',
            'previousPageCssClass' => 'arrow',
            'htmlOptions' => ['class' => 'pagination'],
            'firstPageCssClass' => 'first',
            'firstPageLabel' => Yii::t('main', 'Первая'),
            'lastPageCssClass' => 'last',
            'lastPageLabel' => Yii::t('main', 'Последняя'),
            'nextPageCssClass' => 'arrow',
            'hiddenPageCssClass' => 'unavailable',
            'maxButtonCount' => 11
        ]);
    ?>
</div>

<?php if ($pages->getItemCount() == (Yii::app()->params['pageSize'])): ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#placeMap').height($('#findedPlaces').height());
    });
</script>
<?php endif; ?>
<script type="text/javascript">
    jQuery('a.gallery').colorbox();
</script>