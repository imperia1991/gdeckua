<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'addCategoryForm',
//            'type' => 'inline',
            'htmlOptions' => array('class' => 'well'),
        )
    ); ?>

    <h4>Добавление категории</h4>
    <?php echo $form->textFieldRow($model, 'title_ru', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->textFieldRow($model, 'title_uk', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->dropDownListRow($model, 'parent_id', $categories, array('empty' => 'Выберите родительскую категорию')); ?>
    <br/><br/>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить')
    ); ?>
    <?php if (!$model->isNewRecord): ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array('buttonType' => 'link', 'url' => '/admin/category', 'label' => 'Добавить')
        ); ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $model->search(),
            'emptyText' => 'Категории не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'title_ru',
                    'header' => 'Категории (русский)',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->title_ru);
                        }
                ),
                array(
                    'name' => 'title_uk',
                    'header' => 'Категории (украинский)',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->title_uk);
                        }
                ),
                array(
                    'name' => 'parent_id',
                    'value' => function ($data, $row) {
                            if (is_object($data->parent)) {
                                echo CHtml::encode($data->parent->title_ru);
                            }
                        },
                    'filter' => $model->getParentsCategories(),
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