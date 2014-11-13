<?php
/** @var RssSites $rssSitesModel */
?>

<div class="row">
    <h4>Добавление Rss сайта</h4>
</div>
<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'id' => 'addRssSitesForm',
//            'type' => 'inline',
            'htmlOptions' => ['class' => 'well'],
        ]
    ); ?>

    <?php echo $form->textFieldRow($rssSitesModel, 'url', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->textFieldRow($rssSitesModel, 'title', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->checkboxRow($rssSitesModel, 'is_deleted', ['style' => 'margin-bottom:0']); ?>
    <br/><br/>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'submit', 'label' => $rssSitesModel->isNewRecord ? 'Добавить' : 'Сохранить']
    ); ?>

    <?php $this->endWidget(); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'link', 'label' => 'Отмена', 'url' => Yii::app()->createUrl('/admin/rss')]
    ); ?>
</div>