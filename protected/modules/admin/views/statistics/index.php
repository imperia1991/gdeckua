<div class="row">
    <h4>Что ищут люди?</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Слова не найдены',
        'template'=>'{pager}{summary}{items}{pager}',
        'filter' => $model,
        'columns'=>array(
            'words',
            array(
                'name' => 'created_at',
                'filter' => false,
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