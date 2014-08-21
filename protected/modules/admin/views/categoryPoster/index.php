<?php
/** @var CategoryNews $categoriesModel */
?>
<div class="row">
    <h4>Список категорий для новостей</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/categoryPoster/create', 'label'=> 'Добавить категорию']); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'type' => 'striped bordered condensed',
            'dataProvider' => $categoriesModel->search(),
            'emptyText' => 'Новости не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $categoriesModel,
            'columns' => [
                'title_ru',
                'title_uk',
                [
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'htmlOptions' => ['style' => 'width: 50px'],
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
        ]
    ); ?>
</div>