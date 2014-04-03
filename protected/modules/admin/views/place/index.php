<div class="row">
    <h4>Список мест</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/place/create', 'label'=> 'Добавить')); ?>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Места не найдены',
        'template'=>'{pager}{summary}{items}{pager}',
        'filter' => $model,
        'columns'=>array(
            'id',
            'title_ru',
            'title_uk',
            array(
                'name' => 'districtId',
                'value' => '$data->getDistrict()',
                'filter' => $districts,
            ),
            array(
                'name' => 'address_ru',
                'filter' => false,
                'sortable' => false,
            ),
            array(
                'name' => 'address_uk',
                'filter' => false,
                'sortable' => false,
            ),
            array(
                'name' => 'lat',
                'filter' => false,
            ),
            array(
                'name' => 'lng',
                'filter' => false,
            ),
            array(
                'name' => 'created_at',
                'filter' => false,
            ),
            array(
                'name' => 'updated_at',
                'filter' => false,
            ),
            array(
                'name' => 'is_deleted',
                'filter' => $model->getIsDeletes(),
                'value' => '$data->getIsDeletes(false)'
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}{delete}',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
        'pager' => array(
            'header'=>'',
            'cssFile'=>false,
            'maxButtonCount'=>10,
            'selectedPageCssClass'=>'active',
            'hiddenPageCssClass'=>'disabled',
            'firstPageLabel' => '<<',
            'prevPageLabel'  => '<',
            'nextPageLabel'  => '>',
            'lastPageLabel'  => '>>',
        ),
        'pagerCssClass'=>'pagination pagination-centered',
    )); ?>
</div>