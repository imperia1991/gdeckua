<?php
/** @var Posters $postersModel */
/** @var CategoryPosters $categoriesModel */
?>
<div class="row">
    <h4>Список афиш</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/posters/create', 'label'=> 'Добавить афишу']); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'type' => 'striped bordered condensed',
            'dataProvider' => $postersModel->search(),
            'emptyText' => 'Новости не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $postersModel,
            'columns' => [
                [
                    'name' => 'photo',
                    'value' => function ($data, $row) {
                            echo CHtml::image('/' . Yii::app()->params['admin']['files']['photoPoster'] . $data->photo, '', ['width' => 60, 'height' => 60]);
                        },
                    'htmlOptions' => [
                        'width' => '70px'
                    ]
                ],
                'title',
                [
                    'name' => 'category_poster_id',
                    'value' => function ($data, $row) {
                            /** @var Posters $data */
                            if (is_object($data->categoryPoster)) {
                                echo $data->categoryPoster->title_ru;
                            }
                        },
                    'filter' => $categoriesModel->getCategories(),
                ],
                [
                    'name' => 'created_at',
                    'filter' => false,
                ],
                [
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'htmlOptions' => ['style' => 'width: 50px'],
                ],
            ],
            'pager' => [
                'header' => '',
                'cssFile' => false,
                'maxButtonCount' => 10,
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'disabled',
                'firstPageLabel' => '<<',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
            ],
            'pagerCssClass' => 'pagination pagination-centered',
        ]
    ); ?>
</div>