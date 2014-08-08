<?php
/** @var Comments $comment */
?>
<div class="large-12 columns comments">
    <?php echo $caption; ?>
</div>
<div class="row collapse input-form-new">
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
<div id="commentsView" class="row collapse comment-block">
<?php $this->renderPartial('/partials/_commentsView', [
        'dataProvider' => $dataProvider,
        'model' => $model
    ]) ?>
</div>
<?php if ($dataProvider->getTotalItemCount() > $dataProvider->getPagination()->pageSize): ?>

<br>
<div id="showComments" class="row collapse">
    <div class="show-other-news">
        <img id="loading" style="display: none" src="/img/loading.gif" alt="" />
        <a id="showMore" href="javascript:void(0)"><?php echo Yii::t('main', 'Показать больше комментариев') ?></a>
    </div>
</div>

    <script type="text/javascript">
        /*<![CDATA[*/
        (function($)
        {
            // скрываем стандартный навигатор
//            $('.paginator').hide();

            // запоминаем текущую страницу и их максимальное количество
            var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
            var pageCount = parseInt('<?php echo (int)$dataProvider->pagination->pageCount; ?>');

            var loadingFlag = false;

            $('#showMore').on('click', function()
            {
                // защита от повторных нажатий
                if (!loadingFlag)
                {
                    // выставляем блокировку
                    loadingFlag = true;

                    // отображаем анимацию загрузки
                    $('#showMore').hide();
                    $('#loading').show();

                    $.ajax({
                        type: 'post',
                        url: '<?php echo $url; ?>',
                        data: {
                            // передаём номер нужной страницы методом POST
                            'page': page + 1,
                            'id': <?php echo $model->id ?>
                        },
                        success: function(data)
                        {
                            // увеличиваем номер текущей страницы и снимаем блокировку
                            page++;
                            loadingFlag = false;

                            // прячем анимацию загрузки
                            $('#loading').hide();
                            $('#showMore').show();

                            // вставляем полученные записи после имеющихся в наш блок
                            $('#commentsView').append(data);

                            // если достигли максимальной страницы, то прячем кнопку
                            if (page >= pageCount)
                                $('#showComments').hide();

                            var n = $(document).height();
                            $('html, body').animate({ scrollTop: n }, 1000);
                        },
                        done: function()
                        {
                            $('#loading').hide();
                            $('#showMore').show();
                        }
                    });
                }
                return false;
            })
        })(jQuery);
        /*]]>*/
    </script>

<?php endif; ?>