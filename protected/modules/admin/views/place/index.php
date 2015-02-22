<div class="row">
    <h4>Список мест</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/place/create', 'label'=> 'Добавить']); ?>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', [
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Места не найдены',
        'template'=>'{pager}{summary}{items}{pager}',
        'filter' => $model,
        'columns'=>[
            'id',
            [
                'name' => 'photo',
                'value' => function ($data, $row) {
                        if (isset($data->photos[0])) {
                            echo CHtml::image('/' . Yii::app()->params['admin']['files']['imagesS'] . $data->photos[0]->title, '', ['width' => 60, 'height' => 60]);
                        }
                    },
                'filter' => $model->isPhoto(),
                'htmlOptions' => [
                    'width' => '70px'
                ]
            ],
            [
                'name' => 'title_ru',
                'header' => 'Название (русский)'
            ],
            [
                'name' => 'title_uk',
                'header' => 'Название (украинский)'
            ],
            [
                'name' => 'districtId',
                'value' => '$data->getDistrict()',
                'filter' => $districts,
            ],
            [
                'name' => 'address_ru',
                'header' => 'Адресс (русский)',
                'filter' => false,
                'sortable' => false,
            ],
            [
                'name' => 'address_uk',
                'header' => 'Адресс (украинский)',
                'filter' => $model->getEmptyAddress(),
                'sortable' => false,
            ],
            [
                'name' => 'lat',
                'filter' => false,
            ],
            [
                'name' => 'lng',
                'filter' => false,
            ],
            [
                'name' => 'created_at',
                'filter' => false,
            ],
            [
                'name' => 'is_deleted',
                'filter' => $model->getIsDeletes(),
                'value' => '$data->getIsDeletes(false)'
            ],
            [
                'name' => 'category_id',
                'filter' => $model->getCategories(),
                'value' => '$data->getCategory($data->id)',
                'sortable' => false,
            ],
            [
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}{delete}',
                'htmlOptions'=>array('style'=>'width: 50px'),
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