<?php
/** @var CategoryBoards $categoriesModel */
/** @var CActiveDataProvider $dataProvider */
$dataProvider = $categoriesModel->search();
?>
<div class="row">
    <h4>Список категорий для объявлений</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/categoryBoards/create', 'label'=> 'Добавить категорию']); ?>
</div>
<div class="row">
    <?php if (count($dataProvider->getData())): ?>
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
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'title_ru',
                    'title_uk',
                    [
                        'name' => 'photo',
                        'value' => function($data, $row) {
                                /** @var CategoryBoards $data */
                                echo $data->getPhotoWidget();
                            }
                    ],
                    [
                        'class' => 'CButtonColumn',
                        'template' => '{update}{delete}',
                        'buttons' => [],
                    ],
                ]
            ]
        );
        ?>
    <?php else: ?>
        <label>Категории не добавлены</label>
    <?php endif; ?>
</div>