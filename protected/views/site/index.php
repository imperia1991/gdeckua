<?php
$this->pageTitle = $model->search ? $model->search : Yii::t('main', 'Введите название, например "Кафе Крещатик"');
?>
<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'searchForm',
    'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?page=' . ($dataProvider->getPagination()->currentPage + 1)),
    'method' => 'GET',
    'htmlOptions' => array(),
//    'enableAjaxValidation' => true,
//    'enableClientValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//        'validateOnChange' => true,
//    ),
    ));
?>

<?php

echo $form->textField($model, 'search', array(
    'name' => 'search',
    'placeholder' => Yii::t('main', 'Введите название, например "Кафе Крещатик"'),
));
?>

<?php echo CHtml::submitButton(Yii::t('main', 'Найти'), array('name' => '')); ?>

<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'partials/_item', // представление для одной записи
    'ajaxUpdate'=>false, // отключаем ajax поведение
    'emptyText'=>'Места не найдены.',
    'summaryText'=>"",
//    'template'=>'{summary} {sorter} {items} <hr> {pager}',
//    'sorterHeader'=>'Сортировать по:',
    // ключи, которые были описаны $sort->attributes
    // если не описывать $sort->attributes, можно использовать атрибуты модели
    // настройки CSort перекрывают настройки sortableAttributes
//    'sortableAttributes'=>array('title', 'price'),
    'enablePagination'=>false,
)); ?>

<?php $this->widget('CLinkPager',array(
    'pages'=>$dataProvider->getPagination(),
    'header'               => '',
    'selectedPageCssClass' => 'nav-active',
    'footer'               => '',
    'internalPageCssClass' => '',
    'prevPageLabel'        => '<',
    'nextPageLabel'        => '>',
    'previousPageCssClass' => 'nav-left',
    'htmlOptions'          => array('class' => ''),
    'firstPageCssClass'    => 'display-none',
    'firstPageLabel'       => '<<',
    'lastPageCssClass'     => 'nav-right',
    'lastPageLabel'        => '>>',
    'nextPageCssClass'     => 'display-none',
)); ?>
