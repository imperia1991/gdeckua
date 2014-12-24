<?php
/** @var Users $modelUser */
/** @var Users $modelUserRegister */
/** @var Users $modelUserForgot */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Авторизация')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns  left-sector-add-object afisha-section">
            <div class="content active row" id="auth">
                <div class="row collapse" style="margin-top: 10px;">
                    <?php $form = $this->beginWidget(
                        'CActiveForm',
                        [
                            'id' => 'login-form',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => [],
                        ]
                    ); ?>
                    <div class="row collapse auth">
                        <div class="row collapse">
                            <div class="large-9 large-push-3 columns">
                                <?php echo $form->error($modelUser, 'errorMessage', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'E-Mail'); ?> <span>*</span></p>
                            </div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($modelUser, 'email', []); ?>
                                <?php echo $form->error($modelUser, 'email', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Пароль'); ?> <span>*</span></p>
                            </div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->passwordField($modelUser, 'password', []); ?>
                                <?php echo $form->error($modelUser, 'password', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-12 columns">
                                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/forgot') ?>"><?php echo Yii::t('main', 'Забыли пароль?'); ?></a>
                            </div>
                        </div>

                        <div class="row capcha-block" style="margin-top: 10px;">
                            <div class="large-12 columns">
                                <?php echo CHtml::submitButton(Yii::t('main', 'Войти'), ['class' => 'button']); ?>
                            </div>
                        </div>
                    </div>
                    <?php $this->endWidget('login-form'); ?>
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