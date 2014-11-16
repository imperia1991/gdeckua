<?php
/** @var RssSites $rssSitesModel */
?>

<div class="row">
    <h4>Список Rss сайтов</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/rss/create', 'label'=> 'Добавить сайт')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/rss/news', 'label'=> 'Новости с RSS')); ?>
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
            'rowCssClassExpression' => '
                ( $data->getIsRead() ? null : " error" )
            ',
            'columns' => [
                'title',
                [
                    'name' => 'site',
                    'sortable' => false,
                    'filter' => false,
                ],
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
                    'name' => 'message',
                    'sortable' => false,
                    'filter' => false,
                    'value' => function($data, $row) {
                        /**@var RssSites $data */
                        echo $data->getMessage();
                    }
                ],
                [
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'htmlOptions' => [
                        'style' => 'width: 50px'
                    ],
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