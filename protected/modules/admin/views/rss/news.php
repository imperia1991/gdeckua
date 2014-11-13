<?php
/** @var RssContent $rssContentModel */
?>

<div class="row">
    <h4>Список новостей из Rss сайтов</h4>
</div>

<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $rssContentModel->search(),
            'emptyText' => 'Новости не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $rssContentModel,
            'columns' => [
                'id',
                'title_news',
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
                    'filter' => $rssContentModel->getIsDeletes(),
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