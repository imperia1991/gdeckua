<?php
/** @var CategoryBoards $categoryModel */
$tree = $categoryModel->getTree();
?>

<div class="row">
    <h4>Добавление категории объявления</h4>
</div>
<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'id' => 'addCategoryBoardForm',
//            'type' => 'inline',
            'htmlOptions' => ['class' => 'well'],
        ]
    ); ?>

    <?php echo $form->textFieldRow($categoryModel, 'title_ru', ['style' => 'margin-bottom:0']); ?>
    <?php echo $form->textFieldRow($categoryModel, 'title_uk', ['style' => 'margin-bottom:0']); ?>
    <br/><br/>
    <?php if (!empty($tree)): ?>
        <label>Выберите родительскую категорию</label><br/>
        <?php // http://wwwendt.de/tech/dynatree/doc/dynatree-doc.html#nodeOptions ?>
        <?php $this->widget(
            'ext.dynatree.DynaTree',
            [
                'attribute' => CHtml::activeName($categoryModel, 'parent_id'),
                'data' => $tree,
                'selection' => [$categoryModel->parent_id],
                'options' => [
                    'selectMode' => 1,
                    'minExpandLevel' => 3,
                    'autoCollapse' => true,
                    'noLink' => true
                ]
            ]
        ); ?>
        <br/><br/>
    <?php endif; ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'submit', 'label' => $categoryModel->isNewRecord ? 'Добавить' : 'Сохранить']
    ); ?>

    <?php $this->endWidget(); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'link', 'label' => 'Отмена', 'url' => Yii::app()->createUrl('/admin/categoryBoards')]
    ); ?>
</div>