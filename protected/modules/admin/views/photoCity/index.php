<?php
/** @var PhotoCity $photoCityModel */
?>
<div class="row">
    <h4>Список фотографий города / мероприятий</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/photoCity/add', 'label'=> 'Добавить']); ?>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', [
            'type'=>'striped bordered condensed',
            'dataProvider'=>$photoCityModel->search(),
            'emptyText' => 'Места не найдены',
            'template'=>'{pager}{summary}{items}{pager}',
            'filter' => $photoCityModel,
            'columns'=>[
                'id',
                [
                    'name' => 'photo',
                    'value' => function ($data, $row) {
                            echo CHtml::image('/' . Yii::app()->params['admin']['files']['photoCity'] . $data->photo, '', ['width' => 60, 'height' => 60]);
                        },
                    'htmlOptions' => [
                        'width' => '70px'
                    ],
                    'filter' => false,
                ],
               'title',
               'author',
                'site',
                [
                    'name' => 'created_at',
                    'filter' => false,
                ],
                [
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'htmlOptions'=>['style'=>'width: 50px'],
                ],
            ],
            'pager' => [
                'header'=>'',
                'cssFile'=>false,
                'maxButtonCount'=>10,
                'selectedPageCssClass'=>'active',
                'hiddenPageCssClass'=>'disabled',
                'firstPageLabel' => '<<',
                'prevPageLabel'  => '<',
                'nextPageLabel'  => '>',
                'lastPageLabel'  => '>>',
            ],
            'pagerCssClass'=>'pagination pagination-centered',
        ]); ?>
</div>