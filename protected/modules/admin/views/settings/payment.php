<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'updatePaymentForm',
    'type' => 'horizontal',
    ));
?>

<div class="row">
    <h4>Доставка и оплата</h4>
</div>
<div class="row">
    <p>Введите текст:</p>
    <?php
    $this->widget('application.extensions.ckeditor.CKEditor', array(
        'name' => 'payment',
        'value' => $model->payment,
        'editorTemplate' => 'advanced',
        'toolbar' => array(
            array('Font', 'FontSize', '-', 'Bold', 'Italic', 'Underline')
        ),
    ));
    ?>
</div>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>
</div>

<?php $this->endWidget(); ?>
