<?php /** @var CActiveDataProvider $news */ ?>
<?php $this->widget(
    'zii.widgets.CListView',
    [
        'dataProvider'     => $meetings,
        'itemView'         => 'partials/_oneMeeting', // представление для одной записи
        'ajaxUpdate'       => false, // отключаем ajax поведение
        'emptyText'        => Yii::t('main', 'К сожалению в данном разделе новостей еще нет'),
        'summaryText'      => "",
        'emptyTagName'     => 'ul',
        'enablePagination' => false,
        'itemsTagName'     => 'ul',
        'htmlOptions'      => [
            'class' => 'news_list'
        ],
        'viewData'         => [
            'page' => isset($page) ? $page : 1,
        ],
    ]
);