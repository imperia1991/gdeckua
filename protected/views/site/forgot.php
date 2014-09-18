<?php
/** @var Users $modelUserForgot */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Востановление пароля')
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
                    <div class="row collapse auth" style="margin-top: 10px;">
                        <div class="row collapse">
                            <div class="large-12 columns name-field">
                                <label><?php echo Yii::t('main', 'Введите Ваш E-Mail под которым Вы зарегистрированы на сайте'); ?></label>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-12 columns name-field">
                                <?php echo $form->textField($modelUserForgot, 'email', []); ?>
                                <?php echo $form->error($modelUserForgot, 'email', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row capcha-block" style="margin-top: 10px;">
                            <div class="large-12 columns">
                                <?php echo CHtml::submitButton(Yii::t('main', 'Восстановить'), ['class' => 'button']); ?>
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