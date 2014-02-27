<div class="row">
    <h4>Список мебели</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/partner/create', 'label'=> 'Добавить')); ?>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Партнеры не найдены',
        'template'=>'{pager}{summary}{items}{pager}',
        'columns'=>array(
            array(
                'name' => 'logo',
                'header' => '',
                'type' => 'raw',
                'filter' => false,
                'value' => function ($data, $raw)
                           {
                                echo CHtml::image(Yii::app()->params['imagesPartnersPath'] . $data->logo_s . '?r=' . mt_rand(0, 10000));
                           },
                'htmlOptions' => array('style' => 'width: 5%')
            ),
            'title',
            'description',
            'url',
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