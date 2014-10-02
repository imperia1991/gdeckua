<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'addCommentForm',
            'action' => Yii::app()->createUrl('/admin/develop/makeAlias'),
            'htmlOptions' => array('class' => 'well'),
        )
    ); ?>

    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Создать алиасы')
    ); ?>
    <?php $this->endWidget(); ?>

</div>

<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'addCommentForm',
            'action' => Yii::app()->createUrl('/admin/develop/updateTags'),
            'htmlOptions' => array('class' => 'well'),
        )
    ); ?>

    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Обновить теги')
    ); ?>
    <?php $this->endWidget(); ?>

</div>