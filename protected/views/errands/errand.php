<style type="text/css">
    .login-register .tabs li a {
        font-size: 18px !important;
    }
</style>
<div id="main">
    <h1 class="page-header"><?php echo Yii::t('main', 'Добавление объявления'); ?></h1>
    <div class="login-register">
        <div class="row">
            <div class="span4">
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
                <ul class="tabs nav nav-tabs">
                    <li><a href="#login"><?php echo Yii::t('main', 'Есть аккаунт'); ?></a></li>
                    <li class="active"><a href="#register"><?php echo Yii::t('main', 'Новый пользователь'); ?></a></li>
                </ul>
                <!-- /.nav -->
                <div class="tab-content">
                    <div class="tab-pane" id="login">
                        <div class="control-group">
                            <label class="control-label" for="inputLoginLogin">
                                <?php echo Yii::t('main', 'Мобильный телефон'); ?>
                                <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                            </label>

                            <div class="controls">
                                <?php echo $form->textField($this->modelUser, 'phone', array('id' => 'inputLoginLogin')) ?>
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
                                <?php echo $form->passwordField($this->modelUser, 'password', array('id' => 'inputLoginPassword')) ?>
                            </div>
                            <!-- /.controls -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane active" id="register">
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
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.span4-->

            <div class="span4">
                <ul class="tabs nav nav-tabs">
                    <li class="active"><a href="#promo"><?php echo Yii::t('main', 'Объявление'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="promo">
                        <p>
                            <?php echo CHtml::encode(Yii::t('main', 'Все поля обозначенные звездочкой обязательны для заполнения')); ?> (<span class="form-required">*</span>)
                        </p>
                        <div class="name control-group">
                            <label class="control-label">
                                <?php echo CHtml::encode(Yii::t('main', 'Название')); ?>
                                <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                            </label>
                            <div class="controls">
                                <?php echo $form->textField($model, 'title'); ?>
                                <?php echo $form->error($model, 'title'); ?>
                            </div><!-- /.controls -->
                        </div><!-- /.control-group -->

                        <div class="email control-group">
                            <label class="control-label" for="inputContactEmail">
                                <?php echo Yii::t('main', 'Категория'); ?>
                                <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                            </label>
                            <div class="controls">
                                <?php
                                echo CHtml::activeDropDownList($model, 'category_id', $categories, array('empty' => Yii::t('main', 'Выберите каталог'), 'class' => ''), array());
                                ?>
                            </div><!-- /.controls -->
                        </div><!-- /.control-group -->

                        <div class="control-group">
                            <label class="control-label" for="inputContactMessage">
                                <?php echo Yii::t('main', 'Описание'); ?>
                                <span class="form-required" title="<?php echo CHtml::encode(Yii::t('main', 'Это поле обязательно для ввода')); ?>.">*</span>
                            </label>

                            <div class="controls">
                                <textarea id="inputContactMessage"></textarea>
                            </div><!-- /.controls -->
                        </div><!-- /.control-group -->

                        <div class="form-actions">
                            <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), array('name' => "submit", 'class' => 'btn btn-primary arrow-right')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget('login-form'); ?>
            <?php $this->renderPartial('/partials/_rightSidebar'); ?>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.login-register -->
</div>