<?php /** @var CActiveDataProvider $news */ ?>
<?php $this->widget(
    'zii.widgets.CListView',
    [
        'dataProvider' => $news,
        'itemView' => 'partials/_oneNews', // представление для одной записи
        'ajaxUpdate' => false, // отключаем ajax поведение
        'emptyText' => Yii::t('main', 'К сожалению в данном разделе новстей еще нет'),
        'summaryText' => "",
        'emptyTagName' => 'div',
        'enablePagination' => false,
        'viewData' => [
            'page' => isset($page) ? $page : 1,
        ],
        'htmlOptions' => [
            'class' => 'row collapse news-in-accordion'
        ],
    ]
);