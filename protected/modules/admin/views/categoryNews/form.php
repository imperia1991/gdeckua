<div class="row">
    <h4>Добавление категории новости</h4>
</div>
<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'id' => 'addCategoryNewsForm',
//            'type' => 'inline',
            'htmlOptions' => ['class' => 'well'],
        ]
    ); ?>

    <?php echo $form->textFieldRow($categoryModel, 'title_ru', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->textFieldRow($categoryModel, 'title_uk', array('style' => 'margin-bottom:0')); ?>
    <br/><br/>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'submit', 'label' => $categoryModel->isNewRecord ? 'Добавить' : 'Сохранить']
    ); ?>

    <?php $this->endWidget(); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'link', 'label' => 'Отмена', 'url' => Yii::app()->createUrl('/admin/categoryNews')]
    ); ?>
</div>