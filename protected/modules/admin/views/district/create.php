<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'addDistrictForm',
    'type'=>'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<div class="row">
    <h4>Добавление района</h4>
</div>

<div class="row">
    <?php echo $form->textFieldRow($model, 'title_ru'); ?>
    <?php echo $form->textFieldRow($model, 'title_uk'); ?>
</div>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/district', 'label'=>'Отмена')); ?>
</div>

<?php $this->endWidget(); ?>