<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'updateContactsForm',
    'type'=>'horizontal',
)); ?>

<div class="row">
    <h4>Изменение настроек</h4>
</div>
<div class="row">
    <?php echo $form->textFieldRow($model, 'email'); ?>
    <?php echo $form->passwordFieldRow($model, 'password', array('value' => '')); ?>
    <?php echo $form->textFieldRow($model, 'address'); ?>
    <?php echo $form->textFieldRow($model, 'mobile'); ?>
    <?php echo $form->textFieldRow($model, 'phones'); ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label' => 'Сохранить')); ?>
</div>

<?php $this->endWidget(); ?>