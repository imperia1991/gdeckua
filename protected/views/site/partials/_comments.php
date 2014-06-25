<div class="container">
    <div class="content"></div>
    <!-- .content -->
    <div class="line"></div>
    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'comment-model-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(),
        )
    ); ?>

    <div class="form-item">
        <label class="label"><?php echo Yii::t('main', 'Имя'); ?> <span>*</span></label>

        <div class="item-wrap">
            <?php echo $form->textField($comment, 'name', array()); ?>
            <span class="error-block">
                    <?php echo $form->error($comment, 'name', array('class' => 'error')); ?>
            </span>
        </div>
    </div>
    <div class="form-item">
        <label class="label"><?php echo Yii::t('main', 'Сообщение'); ?> <span>*</span></label>

        <div class="item-wrap">
            <?php echo $form->textArea($comment, 'message', array('row' => 10, 'value' => StringHelper::br2nl($comment->message))); ?>
            <span class="error-block">
                <?php echo $form->error($comment, 'message', array('class' => 'error')); ?>
            </span>
        </div>
    </div>
    <div class="center">
        <? if (CCaptcha::checkRequirements()): ?>
            <?php $this->widget('CCaptcha', array('buttonLabel' => Yii::t('main', 'Обновить'))); ?>
        <? endif ?>
        <div class="form-item" style="margin-top: 0;">
            <label class="label block"><?php echo Yii::t('main', 'Введите код с картинки'); ?> <span>*</span></label>

            <div class="item-wrap" style="display: inline-block;">
                <?php echo $form->textField($comment, 'verifyCode', array('class' => 'small')); ?>
                <span class="error-block">
                        <?php echo $form->error($comment, 'verifyCode', array('class' => 'error')); ?>
                    </span>
            </div>
        </div>
        <div class="line"></div>

        <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), array('class' => 'add-object')); ?>
    </div>

    <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), array('class' => 'add-object')); ?>

    <?php $this->endWidget(); ?>

    <div class="line"></div>

    <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$comment->search($model->id),
            'itemView'=>'partials/_comment', // представление для одной записи
            'ajaxUpdate'=>false, // отключаем ajax поведение
            'emptyText'=>'Комментарии еще не добавлены',
            'summaryText'=>"{start}&mdash;{end} из {count}",
            'template'=>'{summary} {sorter} {items} <hr> {pager}',
            // ключи, которые были описаны $sort->attributes
            // если не описывать $sort->attributes, можно использовать атрибуты модели
            // настройки CSort перекрывают настройки sortableAttributes
            'pager'=>array(
                'class'=>'CLinkPager',
                'header'=>false,
//                'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
                'htmlOptions'=>array('class'=>'pager'),
            ),
        )); ?>

</div>