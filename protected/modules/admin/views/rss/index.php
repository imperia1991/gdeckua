<?php
/** @var RssSites $rssSitesModel */
?>

<div class="row">
    <h4>Список Rss сайтов</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/rss/create', 'label'=> 'Добавить сайт')); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $rssSitesModel->search(),
            'emptyText' => 'Новости не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $rssSitesModel,
            'columns' => [
                'title',
                [
                    'name' => 'url',
                    'sortable' => false,
                ],
                [
                    'name' => 'created_at',
                    'filter' => false,
                ],
                [
                    'name' => 'is_deleted',
                    'filter' => $rssSitesModel->getIsDeletes(),
                    'value' => '$data->getIsDeletes(false)'
                ],
                [
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'htmlOptions' => array('style' => 'width: 50px'),
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
        )
    ); ?>
</div>