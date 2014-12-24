<?php /** @var CActiveDataProvider $rss */ ?>
<div class="row collapse news-in-accordion1" >
    <?php $this->widget(
        'zii.widgets.CListView',
        [
            'dataProvider' => $rss,
            'itemView' => 'partials/_oneRss', // представление для одной записи
            'ajaxUpdate' => false, // отключаем ajax поведение
            'emptyText' => Yii::t('main', 'К сожалению в данном разделе новостей еще нет'),
            'summaryText' => "",
            'emptyTagName' => 'div',
            'enablePagination' => false,
            'viewData' => [
                'page' => isset($page) ? $page : 1,
            ],
        ]
    );
    ?>
</div>