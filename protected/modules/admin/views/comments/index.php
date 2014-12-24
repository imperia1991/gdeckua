<?php if ($model->id): ?>
<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'id' => 'addCommentForm',
//            'type' => 'inline',
            'htmlOptions' => ['class' => 'well'],
        ]
    ); ?>

    <h4>Редактирование комментария</h4>
    <?php echo $form->textFieldRow($model, 'name', ['style' => 'margin-bottom:0']); ?>
    <?php echo $form->textArea($model, 'message', ['style' => 'margin-bottom:0', 'value' => $model->message]); ?>
    <br/><br/>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'submit', 'label' => 'Сохранить']
    ); ?>
    <?php $this->endWidget(); ?>
</div>
<?php endif; ?>
<div class="row">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'type' => 'striped bordered condensed',
            'dataProvider' => $model->searchAdmin(),
            'emptyText' => 'Категории не найдены',
            'template' => '{pager}{summary}{items}{pager}',
            'filter' => $model,
            'columns' => [
                [
                    'name' => 'name',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->name);
                        }
                ],
                [
                    'name' => 'message',
                    'value' => function ($data, $row) {
                            echo CHtml::encode($data->message);
                        }
                ],
                [
                    'name' => 'place_id',
                    'value' => function ($data, $row) {
                            echo $data->place->title_ru;
                        },
//                    'filter' => $model->getParentsCategories(),
                ],
                [
                    'name' => 'created_at',
                    'filter' => false,
                ],
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