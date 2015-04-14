<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'updateUser',
    'type' => 'horizontal',
)); ?>

<fieldset>

    <legend>Редактирование пользователя</legend>

    <?php echo $form->textFieldRow($model, 'name'); ?>
    <?php echo $form->textFieldRow($model, 'email'); ?>
    <?php echo $form->textFieldRow($model, 'logins', array('disabled'=>true)); ?>
    <?php echo $form->textFieldRow($model, 'last_login', array('disabled'=>true)); ?>
    <?php echo $form->textFieldRow($model, 'created_at', array('disabled'=>true)); ?>
    <?php echo $form->textFieldRow($model, 'updated_at', array('disabled'=>true)); ?>
    <?php echo $form->dropDownListRow($model->ruleUser, 'rule_id', $rules); ?>

</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => $this->createUrl('/admin/user'), 'label'=>'Отменить')); ?>
</div>

<?php $this->endWidget(); ?>
