<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'addCategoryForm',
//            'type' => 'inline',
            'htmlOptions' => array('class' => 'well'),
        )
    ); ?>

    <h4>Добавление категории</h4>
    <?php echo $form->textFieldRow($model, 'title_ru', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->textFieldRow($model, 'title_uk', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->dropDownListRow($model, 'parent_id', $categories, array('empty' => 'Выберите родительскую категорию')); ?>
    <br/><br/>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить')
    ); ?>
    <?php if (!$model->isNewRecord): ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array('buttonType' => 'link', 'url' => '/admin/category', 'label' => 'Добавить')
        ); ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div>