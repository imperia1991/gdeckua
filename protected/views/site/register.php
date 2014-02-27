<?php $this->pageTitle = Yii::t('main', 'Регистрация'); ?>

<style type="text/css">
    ul.login-register li a {
        font-size: 27px !important;
    }
</style>
<div id="main">
    <h1 class="page-header"><?php echo Yii::t('main', 'Регистрация'); ?></h1>
    <div class="login-register">
        <div class="row">
            <div class="span4">
                <ul class="tabs nav nav-tabs login-register">
                    <li class="active"><a href="#register"><?php echo Yii::t('main', 'Регистрация'); ?></a></li>
                </ul>
                <!-- /.nav -->

                <div class="tab-content">
                    <div class="tab-pane active" id="register">
                        <?php
						$form = $this->beginWidget('CActiveForm', array(
							'id' => 'register-form',
							'enableAjaxValidation' => false,
							'clientOptions' => array(
                                'enableClientValidation' => false,
								'validateOnSubmit' => false,
							),
							'focus' => array($this->modelUser, 'name'),
							));
						?>
                            <div class="control-group">
                                <label class="control-label">
                                    <?php echo CHtml::encode(Yii::t('main', 'Имя')); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->textField($this->modelUser, 'name') ?>
                                    <?php echo $form->error($this->modelUser, 'name') ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label">
                                    <?php echo CHtml::encode(Yii::t('main', 'E-mail')); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->textField($this->modelUser, 'email') ?>
                                    <?php echo $form->error($this->modelUser, 'email') ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label">
                                    <?php echo CHtml::encode(Yii::t('main', 'Мобильный телефон')); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->textField($this->modelUser, 'phone') ?>
                                    <?php echo $form->error($this->modelUser, 'phone') ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label">
                                    <?php echo CHtml::encode(Yii::t('main', 'Пароль')); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->passwordField($this->modelUser, 'password') ?>
                                    <?php echo $form->error($this->modelUser, 'password') ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="inputRegisterRetype">
                                    <?php echo CHtml::encode(Yii::t('main', 'Повторите пароль')); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->passwordField($this->modelUser, 'passwordRepeat') ?>
                                    <?php echo $form->error($this->modelUser, 'passwordRepeat') ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label">
                                    <?php echo CHtml::encode(Yii::t('main', 'Введите символы с картинки')); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php $this->widget('CCaptcha'); ?>
                                    <?php echo $form->textField($this->modelUser, 'verifyCode'); ?>
                                    <?php echo $form->error($this->modelUser, 'verifyCode'); ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <div class="controls">
                                    <label class="checkbox" for="agree">
                                        <?php echo $form->checkBox($this->modelUser, 'agree', array('id' => 'agree')); ?>
                                        <?php echo CHtml::encode(Yii::t('main', 'Я согласен с условиями пользовательского соглашения')); ?>
                                        <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                    </label>
                                    <?php echo $form->error($this->modelUser, 'agree'); ?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="form-actions">
                                <?php echo CHtml::submitButton(Yii::t('main', 'Зарегистрироваться'), array('name' => "submit", 'class' => 'btn btn-primary arrow-right')); ?>
                            </div>
                            <!-- /.form-actions -->
                        <?php $this->endWidget('register-form'); ?>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.span4-->

            <?php $this->renderPartial('/partials/_explanation'); ?>
        </div>
        <!-- /.row -->
    </div><!-- /.login-register -->
</div>