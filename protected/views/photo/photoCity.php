<?php
/** @var PhotoCity $photoCityModel */
?>

<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Добавить фотографию')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 small-12 columns left-sector-add-foto">
            <div class="row collapse">
                <div class="large-12 columns add-information">
                    <p><?php echo Yii::t('main', 'Вы можете добавлять только по одной фотографии'); ?></p>
                    <hr>
                </div>
                <?php $form = $this->beginWidget(
                    'CActiveForm',
                    [
                        'id' => 'photoCity-model-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => ['enctype' => 'multipart/form-data'],
                    ]
                ); ?>
                <div class="row collapse">

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Название') ?>: <span>*</span></p></div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($photoCityModel, 'title', []); ?>
                                <?php echo $form->error($photoCityModel, 'title', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Автор') ?>: <span>*</span></p></div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($photoCityModel, 'author', []); ?>
                                <?php echo $form->error($photoCityModel, 'author', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Тип') ?>: <span>*</span></p></div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->dropDownList($photoCityModel, 'type', $photoCityModel->getTypes(), []); ?>
                                <?php echo $form->error($photoCityModel, 'type', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <hr>

                </div>

                <div class="row collapse">
                    <div class="large-7 columns added-images">

                        <input type="submit" value="Загрузить фото" class="add-foto-btn">

                        <div class="row collapse">
                            <div class="large-3 small-6 columns">
                                <div class="object-img-box"><!-- Image Add --></div>
                                <p><a href="#"><img src="img/delete.png"> Удалить</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="large-5 columns capcha-block">
                        <div class="row">

                            <div>
                                <? if (CCaptcha::checkRequirements()): ?>
                                    <?php $this->widget(
                                        'CCaptcha',
                                        [
                                            'buttonLabel' => Yii::t('main', 'Обновить'),
                                            'showRefreshButton' => true,
                                            'buttonOptions' => [
                                                'class' => 'add-object-captcha-button'
                                            ],
//                                    'buttonType' => 'button',
                                            'clickableImage' => true
                                        ]
                                    ); ?>
                                <? endif ?>
                            </div>

                            <div class="name-field">
                                <p><?php echo Yii::t('main', 'Введите код с картинки'); ?> <span>*</span></p>
                                <?php echo $form->textField($photoCityModel, 'verifyCode', []); ?>
                                <label class="error"><?php echo $form->error(
                                        $photoCityModel,
                                        'verifyCode',
                                        ['class' => 'error']
                                    ); ?></label>
                            </div>

                            <?php echo CHtml::submitButton(Yii::t('main', 'Добавить фотографию'), ['class' => 'button']); ?>

                        </div>
                    </div>
                </div>
                <?php $this->endWidget('photoCity-model-form'); ?>
                <hr>

            </div>
        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>

    </div>
</div>