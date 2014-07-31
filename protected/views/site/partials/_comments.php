<?php
/** @var Comments $comment */
?>
<div class="large-12 columns comments">
    <?php echo CHtml::encode(Yii::t('main', 'Комментарии к объекту')); ?>
</div>
<div class="row collapse input-form">
    <?php $form = $this->beginWidget(
            'CActiveForm',
            [
                'id' => 'comment-model-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => [
                    'class' => 'row collapse'
                ],
            ]
        ); ?>
        <div class="large-7 columns">
            <?php echo $form->textArea($comment, 'message', ['placeholder' => Yii::t('main', 'Напишите Ваш комментарий') . "...", 'value' => StringHelper::br2nl($comment->message)]); ?>
            <?php echo $form->error($comment, 'message', ['class' => 'error']); ?>
        </div>
        <div class="large-5 columns">
            <div class="row collapse" style="padding-left: 5px !important;">
                <div class="large-12 columns">
                    <?php echo $form->textField($comment, 'name', ['placeholder' => CHtml::encode(Yii::t('main', 'Ваше Имя'))]); ?>
                    <?php echo $form->error($comment, 'name', ['class' => 'error']); ?>
                </div>
                <div class="large-6 columns">
                    <? if (CCaptcha::checkRequirements()): ?>
                        <?php $this->widget('CCaptcha', [
                                'buttonLabel' => Yii::t('main', 'Обновить'),
                                'showRefreshButton' => true,
                                'buttonOptions' => [
                                    'class' => 'button tiny marginTop13'
                                ],
                                'buttonType' => 'button',
                                'clickableImage' => true
                            ]); ?>
                    <? endif ?>
                </div>
                <div class="large-6 columns">
                    <?php echo $form->textField($comment, 'verifyCode', ['placeholder' => Yii::t('main', 'Введите код')]); ?>
                    <?php echo $form->error($comment, 'verifyCode', ['class' => 'error']); ?>
                </div>
                <div class="large-12 columns">
                    <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), ['class' => 'button small']); ?>
                </div>
            </div>
        </div>
    <?php $this->endWidget(); ?>

</div>

<?php
/** @var CActiveDataProvider $dataProvider */
$dataProvider = $comment->search($model->id);
?>
<?php $this->widget('zii.widgets.CListView', [
        'dataProvider'=>$dataProvider,
        'itemView'=>'partials/_comment', // представление для одной записи
        'ajaxUpdate'=>true, // отключаем ajax поведение
        'emptyText' => Yii::t('main', 'Комментарии еще не добавлены'),
        'summaryText'=>"",
        'emptyTagName' => 'div',
        'htmlOptions' => [
            'class' => 'row collapse comment-block'
        ],
//            'template'=>'{summary} {sorter} {items} <hr> {pager}',
        // ключи, которые были описаны $sort->attributes
        // если не описывать $sort->attributes, можно использовать атрибуты модели
        // настройки CSort перекрывают настройки sortableAttributes
//            'pager'=>[
//                'class'=>'CLinkPager',
//                'header'=>false,
////                'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
//                'htmlOptions'=>['class'=>'pager'],
//            ],
    ]); ?>
<?php if ($dataProvider->getTotalItemCount()): ?>
<br>
<div class="row collapse">
    <div class="show-other-news">
        <a href="#">Показать больше комментариев</a>
    </div>
</div>
<?php endif;