<?php
$this->pageTitle = $model->search ? $model->search : Yii::t('main', 'Введите название, например "Кафе Крещатик"');
?>
<div class="search-block">
<?php
$this->renderPartial('/partials/_search', array(
    'dataProvider' => $dataProvider,
    'model' => $model,
));
?>
</div>
<div class="container">
    <div class="content">
        <div id="placeMap" class="map" style="height: 800px;">
            <?php
                $this->renderPartial('partials/_map', array(
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                ));
            ?>
        </div>
        <div class="content-ad">
            <img src="images/rek492x70.png" alt="">
        </div>

        <?php $this->renderPartial('/partials/_find_' . Yii::app()->language); ?>

        <div class="pagination">
            <?php
            $this->widget('CLinkPager', array(
                'pages' => $dataProvider->getPagination(),
                'cssFile'=>Yii::app()->theme->baseUrl."/css/pagination.css",
                'header' => '',
                'selectedPageCssClass' => 'active',
                'footer' => '',
                'internalPageCssClass' => '',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
    //            'previousPageCssClass' => 'nav-left',
                'htmlOptions' => array('class' => ''),
    //            'firstPageCssClass' => 'display-none',
                'firstPageLabel' => '<<',
    //            'lastPageCssClass' => 'nav-right',
                'lastPageLabel' => '>>',
    //            'nextPageCssClass' => 'display-none',
            ));
            ?>
        </div>
    </div>
</div><!-- .container-->
<div class="left-sidebar">
    <div id="search-content">
        <ul>
            
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'cssFile'=>Yii::app()->theme->baseUrl."/css/search-list.css",
                'itemView' => 'partials/_item', // представление для одной записи
                'ajaxUpdate' => false, // отключаем ajax поведение
                'emptyText' => 'Места не найдены.',
                'summaryText' => "",
                'itemsTagName'=>'ul',
    //    'template'=>'{summary} {sorter} {items} <hr> {pager}',
    //    'sorterHeader'=>'Сортировать по:',
                // ключи, которые были описаны $sort->attributes
                // если не описывать $sort->attributes, можно использовать атрибуты модели
                // настройки CSort перекрывают настройки sortableAttributes
    //    'sortableAttributes'=>array('title', 'price'),
                'enablePagination' => false,
            ));
            ?>
        </ul>
    </div>
<div class="left-sidebar-ad">
    <img src="images/rek305x70.png" alt="">
</div>
</div><!-- .left-sidebar -->

