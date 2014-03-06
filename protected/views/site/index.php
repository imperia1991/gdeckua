<?php
$this->pageTitle = $model->search ? $model->search : Yii::t('main', 'Введите название, например "Кафе Крещатик"');
?>
<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'searchForm',
    'action' => '/',
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