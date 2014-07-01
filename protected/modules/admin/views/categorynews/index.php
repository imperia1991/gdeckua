<?php
/** @var CategoryNews $categoriesModel */
?>
<div class="row">
    <h4>Список категорий для новостей</h4>
</div>
<div class="row">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/categoryNews/create', 'label'=> 'Добавить категорию')); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $categoriesModel->search(),
            'emptyText' => 'Новости не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $categoriesModel,
            'columns' => array(
                array(
                    'name' => 'title_ru',
                    'header' => 'Название (русский)',
                    'value' => function ($data, $row) {
                            /** @var News $data */
                            echo CHtml::encode($data->title_ru);
                        }
                ),
                array(
                    'name' => 'title_uk',
                    'header' => 'Название (украинский)',
                    'value' => function ($data, $row) {
                            /** @var News $data */
                            echo CHtml::encode($data->title_uk);
                        }
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