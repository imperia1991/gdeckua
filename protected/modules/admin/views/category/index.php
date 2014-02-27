<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'addCategoryForm',
        'type' => 'inline',
        'htmlOptions' => array('class'=>'well'),
    )); ?>

    <h4>Добавление категории</h4>
    <?php echo $form->textFieldRow($model, 'title_ru', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->textFieldRow($model, 'title_uk', array('style' => 'margin-bottom:0')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=> $model->isNewRecord ? 'Добавить' : 'Сохранить')); ?>
    <?php if (!$model->isNewRecord): ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/category', 'label'=> 'Добавить')); ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Категории не найдены',
        'template'=>"{items}",
        'filter' => $model,
        'columns'=>array(
            'title_ru',
            array(
                'name' => 'title_uk',
                'value' => function($data, $row) {
                    echo CHtml::encode($data->title_uk);
                }
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}{delete}',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
    )); ?>
</div>