<h3>Авторизация</h3>
<?php

/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'inlineForm',
    'action' => '/admin/default/login',
    'type' => 'inline',
    'htmlOptions' => array('class' => 'well'),
    ));
?>

<?php echo $form->error($this->modelUser, 'errorMessage'); ?>

<?php echo $form->textFieldRow($this->modelUser, 'email', array('class' => '.input-large')); ?>
<?php echo $form->passwordFieldRow($this->modelUser, 'password', array('class' => '.input-large')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Войти')); ?>

<?php $this->endWidget(); ?>