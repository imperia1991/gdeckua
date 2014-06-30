<?php
$this->pageTitle = $model->search ? $model->search : Yii::t('main', 'Введите, например "Кафе Крещатик"');
?>

<?php $this->renderPartial('/partials/_welcome_' . Yii::app()->language); ?>

<div class="search-block">
<?php
$this->renderPartial('/partials/_search', array(
    'dataProvider' => $dataProvider,
    'currentPage' => ($dataProvider->getPagination()->currentPage + 1),
    'model' => $model,
    'selectDistrict' => $selectDistrict,
    'districts' => $districts,
    'checkedString' => $checkedString
));

$currentPage = ($dataProvider->getPagination()->currentPage + 1);
?>
</div>
<div class="container">
    <div class="content">
        <div id="placeMap" class="map-wrap">
            <?php
                $this->renderPartial('partials/_map', array(
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'selectDistrict' => $selectDistrict,
                ));
            ?>
        </div>
    </div>
    <div class="line"></div>
    <div class="pagination">
            <?php
            $this->widget('CLinkPager', array(
                'pages' => $dataProvider->getPagination(),
//                'cssFile'=>Yii::app()->baseUrl."/css/pagination.css",
                'header' => '',
                'selectedPageCssClass' => 'active',
                'footer' => '',
                'internalPageCssClass' => '',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'previousPageCssClass' => 'prev',
                'htmlOptions' => array('class' => ''),
                'firstPageCssClass' => 'first',
                'firstPageLabel' => '<<',
                'lastPageCssClass' => 'last',
                'lastPageLabel' => '>>',
                'nextPageCssClass' => 'next',
                'maxButtonCount' => 11
            ));
            ?>
    </div>
    <div class="line"></div>
    <?php $this->renderPartial('/partials/_ads'); ?>
    <div class="line"></div>
    <div class="container-text">
        <?php $this->renderPartial('/partials/_find_' . Yii::app()->getLanguage()); ?>
    </div>
</div><!-- .container-->
<div class="left-sidebar">
    <div id="search-content">
        <ul class="places">

            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
//                'cssFile'=>Yii::app()->baseUrl."/css/search-list.css",
                'itemView' => 'partials/_item', // представление для одной записи
                'ajaxUpdate' => false, // отключаем ajax поведение
                'emptyText' => 'Места не найдены.',
                'summaryText' => "",
                'itemsTagName' => 'ul',
                'enablePagination' => false,
            ));
            ?>
        </ul>
    </div>
</div><!-- .left-sidebar -->

