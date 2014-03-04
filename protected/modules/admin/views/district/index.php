<div class="row">
    <h4>Список районов</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/district/create', 'label'=> 'Добавить')); ?>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Районы не найдены',
        'template'=>'{pager}{summary}{items}{pager}',
        'filter' => $model,
        'columns'=>array(
            'id',
            'title_ru',
            'title_uk',
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