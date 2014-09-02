<?php
/** @var Banners $bannerModel */
/** @var Categories $categoriesModel */
?>
<div class="row">
    <h4>Список банеров</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/banners/create', 'label'=> 'Добавить банер']); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'type' => 'striped bordered condensed',
            'dataProvider' => $bannerModel->search(),
            'emptyText' => 'Банеры не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $bannerModel,
            'columns' => [
                'id',
                [
                    'name' => 'photo',
                    'value' => function ($data, $row) {
                            if ($data->photo) {
                                echo CHtml::image('/' . Yii::app()->params['admin']['files']['banners'] . $data->photo, '', ['width' => 60, 'height' => 60]);
                            }
                        },
                    'htmlOptions' => [
                        'width' => '70px'
                    ]
                ],
                'title',
                [
                    'name' => 'categoriesStore',
                    'value' => function ($data, $row) {
                            $data->getCategoriesStore();
                        },
                    'filter' => $categoriesModel->getCategories(),
                ],
                'counter',
                [
                    'name' => 'is_right_column',
                    'value' => function($data, $row) {
                            echo $data->getPosition();
                            echo '<pre>';
                            print_r($data->getCurrentPosition());
                            echo '</pre>';
                        },
                    'filter' => CHtml::dropDownList('Banners[is_right_column]', $bannerModel->getCurrentPosition(), $bannerModel->getPositions()),
                ],
                [
                    'name' => 'is_showing',
                    'value' => function($data, $row) {
                            echo $data->getStatus();
                        },
                    'filter' => CHtml::dropDownList('Banners[is_showing]', $bannerModel->getCurrentStatus(), $bannerModel->getStatuses())
                ],
                'orderby',
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