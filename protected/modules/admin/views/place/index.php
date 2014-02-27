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
//            array(
//                'name' => '',
//                'header' => '',
//                'type' => 'raw',
//                'filter' => false,
////                'value' => Yii::app()->params['imagesPath'] . '/' . '$data->photo_s' . '?r=' . mt_rand(0, 10000),
//                'value' => function ($data, $raw)
//                           {
////                                echo CHtml::image(Yii::app()->params['imagesPath'] . '/' . $data->photo_s . '?r=' . mt_rand(0, 10000));
//                           },
//                'htmlOptions' => array('style' => 'width: 5%')
//            ),
            'title_ru',
            'title_uk',
            array(
                'name' => 'description',
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
            'created_at',
            'updated_at',
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