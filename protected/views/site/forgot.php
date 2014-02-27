<?php $this->pageTitle = Yii::t('main', $login ? 'Авторизация' : 'Регистрация'); ?>
<?php $isLogin = isset($login) && $login ? 'active' : ''; ?>
<?php $isRegister = isset($register) && $register ? 'active' : ''; ?>

<style type="text/css">
    ul.login-register li {
        width: auto !important;
    }
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
                    <li class="active"><a href="#forgot" style="font-size:27px;"><?php echo Yii::t('main', 'Восстановление пароля'); ?></a></li>
                </ul>
                <!-- /.nav -->

                <div class="tab-content">
                    <div class="tab-pane active" id="forgot">
                        <?php
						$form = $this->beginWidget('CActiveForm', array(
							'id' => 'forgot-form',
							'enableAjaxValidation' => false,
							'clientOptions' => array(
                                'enableClientValidation' => false,
								'validateOnSubmit' => false,
							),
							'focus' => array($this->modelUser, 'email'),
							));
						?>
                            <?php echo $form->error($this->modelUser, 'email');?>
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">
                                    <?php echo Yii::t('main', 'Введите e-mail'); ?>
                                    <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>">*</span>
                                </label>

                                <div class="controls">
                                    <?php echo $form->textField($this->modelUser, 'email', array('id' => 'inputEmail'))?>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->

                            <div class="form-actions">
                                <?php echo CHtml::submitButton(Yii::t('main', 'Восстановить'), array('name' => "submit", 'class' => 'btn btn-primary')); ?>
                                <?php echo CHtml::link(Yii::t('main', 'Войти'), Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/login') ,array('class' => 'btn btn-primary', 'style' => 'float:right')); ?>
                            </div>
                            <!-- /.form-actions -->
                        <?php $this->endWidget(); ?>
                    </div>
                    <!-- /.tab-pane -->

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