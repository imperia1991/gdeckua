<?php
/** @var CategoryBoards $categoriesModel */
?>
<div class="row">
    <h4>Список категорий для объявлений</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/categoryBoards/create', 'label'=> 'Добавить категорию']); ?>
</div>
<div class="row">
    <?php
    $this->widget(
        'ext.SilcomTreeGridView.SilcomTreeGridView',
        [
            'id' => 'your-grid-id',
            'ajaxUpdate' => false,
            'treeViewOptions' => [
                'initialState' => 'collapsed',
                'expandable' => true,
            ],
            'parentColumn' => 'parent_id',
            'dataProvider' => $categoriesModel->search(),
            'columns' => [
                'id',
                'title_ru',
                [
                    'class' => 'CButtonColumn',
                    'template' => '{update}{delete}',
                    'buttons' => [],
                ],
            ]
        ]
    );
    ?>
</div>