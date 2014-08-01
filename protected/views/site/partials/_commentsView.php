<?php $this->widget(
    'zii.widgets.CListView',
    [
        'dataProvider' => $dataProvider,
        'itemView' => '/site/partials/_comment', // представление для одной записи
        'ajaxUpdate' => true, // отключаем ajax поведение
        'emptyText' => Yii::t('main', 'Комментарии еще не добавлены'),
        'summaryText' => "",
        'emptyTagName' => 'div',
        'enablePagination' => false,
        'htmlOptions' => [
            'class' => 'row collapse comment-block'
        ],
//            'template'=>'{summary} {sorter} {items} <hr> {pager}',
        // ключи, которые были описаны $sort->attributes
        // если не описывать $sort->attributes, можно использовать атрибуты модели
        // настройки CSort перекрывают настройки sortableAttributes
//            'pager'=>[
//                'class'=>'CLinkPager',
//                'header'=>false,
////                'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
//                'htmlOptions'=>['class'=>'pager'],
//            ],
    ]
);