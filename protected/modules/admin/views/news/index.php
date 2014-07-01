<?php
/** @var News $newsModel */
/** @var CategoryNews $categoriesModel */
?>
<div class="row">
    <h4>Список новостей</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/news/createCategory', 'label'=> 'Добавить категорию')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/news/createNews', 'label'=> 'Добавить новость')); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $newsModel->search(),
            'emptyText' => 'Новости не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $newsModel,
            'columns' => array(
                array(
                    'name' => 'title',
                    'header' => 'Название',
                    'value' => function ($data, $row) {
                            /** @var News $data */
                            echo CHtml::encode($data->title);
                        }
                ),
                array(
                    'name' => 'category_news_id',
                    'value' => function ($data, $row) {
                            /** @var News $data */
                            if (is_object($data->categoryNews)) {
                                echo CHtml::encode($data->categoryNews->title_ru);
                            }
                        },
                    'filter' => $categoriesModel->getCategories(),
                ),
                array(
                    'name' => 'created_at',
                    'filter' => false,
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
                    'htmlOptions' => array('style' => 'width: 50px'),
                ),
            ),
            'pager' => array(
                'header' => '',
                'cssFile' => false,
                'maxButtonCount' => 10,
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'disabled',
                'firstPageLabel' => '<<',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
            ),
            'pagerCssClass' => 'pagination pagination-centered',
        )
    ); ?>
</div>