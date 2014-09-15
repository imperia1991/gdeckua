<?php
/** @var Users $modelUserUser */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Авторизация')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns  left-sector-add-object afisha-section">
            <ul class="tabs webcams" data-tab>
                <li class="tab-title active photo">
                    <a href="#panel2-1"><?php echo Yii::t('main', 'Войти') ?></a>
                </li>
                <li class="tab-title event">
                    <a href="#panel2-2"><?php echo Yii::t('main', 'Новый пользователь') ?></a>
                </li>
            </ul>
            <div class="tabs-content">
                <div class="content active row" id="panel2-1">
                    <div class="row collapse">
                        <?php $form = $this->beginWidget(
                            'CActiveForm',
                            [
                                'id' => 'login-form',
                                'enableAjaxValidation' => false,
                                'htmlOptions' => [],
                            ]
                        ); ?>
                        <div class="row collapse">
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
                                    <?php echo $form->textField($modelUser, 'password', []); ?>
                                    <?php echo $form->error($modelUser, 'password', ['class' => 'error']); ?>
                                </div>
                            </div>

                            <div class="row capcha-block">
                                <div class="large-12 columns">
                                    <?php echo CHtml::submitButton(Yii::t('main', 'Войти'), ['class' => 'button']); ?>
                                </div>
                            </div>
                        </div>
                        <?php $this->endWidget('login-form'); ?>
                    </div>
                </div>
                <div class="content row" id="panel2-2">
                </div>
                <div class="content row" id="panel2-3">
                </div>
            </div>
        </div>

        <!-- RIGHT SECTION NEWS -->
        <?php $this->renderPartial('/partials/_previewNews'); ?>
        <!-- RIGHT SECTION NEWS -->


    </div>
</div>