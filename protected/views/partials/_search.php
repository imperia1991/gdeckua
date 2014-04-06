<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'searchForm',
    'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?page=' . $currentPage),
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
<label><?php echo Yii::t('main', 'Где в Черкассах') ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<?php

echo $form->textField($model, 'search', array(
    'name' => 'search',
    'placeholder' => Yii::t('main', 'Введите, например, кафе крещатик'),
));
?>

<?php echo CHtml::submitButton(Yii::t('main', 'Поиск'), array('name' => '')); ?>

<?php $this->endWidget(); ?>
