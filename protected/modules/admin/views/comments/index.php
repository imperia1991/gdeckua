<?php if ($model->id): ?>
<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'addCommentForm',
//            'type' => 'inline',
            'htmlOptions' => array('class' => 'well'),
        )
    ); ?>

    <h4>Редактирование комментария</h4>
    <?php echo $form->textFieldRow($model, 'name', array('style' => 'margin-bottom:0')); ?>
    <?php echo $form->textFieldRow($model, 'message', array('style' => 'margin-bottom:0')); ?>
    <br/><br/>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Сохранить')
    ); ?>
    <?php $this->endWidget(); ?>
</div>
<?php endif; ?>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $model->searchAdmin(),
            'emptyText' => 'Категории не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'name',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->name);
                        }
                ),
                array(
                    'name' => 'message',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->message);
                        }
                ),
                array(
                    'name' => 'place_id',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->place->title_ru);
                        },
//                    'filter' => $model->getParentsCategories(),
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