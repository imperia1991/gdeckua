<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'updateAboutForm',
    'type' => 'horizontal',
    ));
?>

<div class="row">
    <?php echo $form->textAreaRow($model, 'about_us', array('class'=>'span8', 'rows'=>5, 'value' => $model->about_us ? StringHelper::br2nl($model->about_us) : '')); ?>
</div>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>
</div>

<?php $this->endWidget(); ?>
