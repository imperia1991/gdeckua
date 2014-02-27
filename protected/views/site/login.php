<?php $this->pageTitle = Yii::t('main', 'Авторизация'); ?>

<style type="text/css">
    ul.login-register li a {
        font-size: 27px !important;
    }
</style>
<div id="main">
    <h1 class="page-header"><?php echo Yii::t('main', 'Авторизация'); ?></h1>
    <div class="login-register">
        <div class="row">
            <div class="span4">
                <ul class="tabs nav nav-tabs login-register">
                    <li class="active"><a href="#login"><?php echo Yii::t('main', 'Войти'); ?></a></li>
                </ul>
                <!-- /.nav -->

                <div class="tab-content">
                    <div class="tab-pane active" id="login">
                        <?php
						$form = $this->beginWidget('CActiveForm', array(
							'id' => 'login-form',
							'enableAjaxValidation' => false,
							'clientOptions' => array(
                                'enableClientValidation' => false,
								'validateOnSubmit' => false,
							),
							'focus' => array($this->modelUser, 'phone'),
							));
						?>
                            <?php echo $form->error($this->modelUser, 'errorMessage');?>
                            <div class="control-group">
                                <label class="control-label" for="inputLoginLogin">
                                    <?php echo Yii::t('main', 'Мобильный телефон'); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->textField($this->modelUser, 'phone', array('id' => 'inputLoginLogin'))?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="inputLoginPassword">
                                    <?php echo Yii::t('main', 'Пароль'); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->passwordField($this->modelUser, 'password', array('id' => 'inputLoginPassword'))?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="form-actions">
                                <?php echo CHtml::submitButton(Yii::t('main', 'Войти'), array('name' => "submit", 'class' => 'btn btn-primary arrow-right')); ?>
                                <?php echo CHtml::link(Yii::t('main', 'Забыли пароль?'), Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/forgot') ,array('class' => 'btn btn-primary', 'style' => 'float:right')); ?>
                            </div>
                            <!-- /.form-actions -->
                        <?php $this->endWidget('login-form'); ?>
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