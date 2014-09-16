<?php
/** @var Users $modelUser */
/** @var Users $modelUserRegister */
/** @var Users $modelUserForgot */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Регистрация')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns  left-sector-add-object afisha-section">
            <div class="content row" id="register">
                <div class="row collapse">
                    <?php $form = $this->beginWidget(
                        'CActiveForm',
                        [
                            'id' => 'register-form',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => [],
                        ]
                    ); ?>
                    <div class="row collapse auth">
                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Имя'); ?> <span>*</span></p>
                            </div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($modelUserRegister, 'name', []); ?>
                                <?php echo $form->error($modelUserRegister, 'name', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'E-Mail'); ?> <span>*</span></p>
                            </div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($modelUserRegister, 'email', []); ?>
                                <?php echo $form->error($modelUserRegister, 'email', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Пароль'); ?> <span>*</span></p>
                            </div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->passwordField($modelUserRegister, 'password', []); ?>
                                <?php echo $form->error($modelUserRegister, 'password', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Повторите пароль'); ?> <span>*</span></p>
                            </div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->passwordField($modelUserRegister, 'passwordRepeat', []); ?>
                                <?php echo $form->error($modelUserRegister, 'passwordRepeat', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row capcha-block">
                            <div class="large-12 columns">
                                <div class="small-12 columns">
                                    <? if (CCaptcha::checkRequirements()): ?>
                                        <?php $this->widget(
                                            'CCaptcha',
                                            [
                                                'buttonLabel' => Yii::t('main', 'Обновить'),
                                                'showRefreshButton' => true,
                                                'buttonOptions' => [
                                                    'class' => 'add-object-captcha-button'
                                                ],
                                                'clickableImage' => true
                                            ]
                                        ); ?>
                                    <? endif ?>
                                </div>
                                <br><br>

                                <div class="name-field" style="margin-bottom: 10px;">
                                    <p><?php echo Yii::t('main', 'Введите код с картинки'); ?> <span>*</span></p>
                                    <?php echo $form->textField($modelUserRegister, 'verifyCode', []); ?>
                                    <label class="error"><?php echo $form->error(
                                            $modelUserRegister,
                                            'verifyCode',
                                            ['class' => 'error']
                                        ); ?></label>
                                </div>
                                <?php echo CHtml::submitButton(Yii::t('main', 'Зарегистрироваться'), ['class' => 'button']); ?>
                            </div>
                        </div>
                    </div>
                    <?php $this->endWidget('register-form'); ?>
                </div>
            </div>
            <div class="content row" id="panel2-3">
            </div>
        </div>

        <!-- RIGHT SECTION NEWS -->
        <?php $this->renderPartial('/partials/_previewNews'); ?>
        <!-- RIGHT SECTION NEWS -->

    </div>
</div>