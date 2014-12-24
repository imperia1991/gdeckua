<div class="row">
    <h4>Добавление категории афишы</h4>
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

    <h4>Добавление категории для новости</h4>
    <?php echo $form->textFieldRow($categoryModel, 'title_ru', ['style' => 'margin-bottom:0']); ?>
    <?php echo $form->textFieldRow($categoryModel, 'title_uk', ['style' => 'margin-bottom:0']); ?>
    <?php echo $form->checkboxRow($categoryModel, 'is_affisha', ['style' => 'margin-bottom:0']); ?>
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