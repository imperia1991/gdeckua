<!--[if lt IE 7]>
<style type='text/css'>
    #simplemodal-container a.modalCloseImg {
        background: none;
        right: -14px;
        width: 22px;
        height: 26px;
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='img/x.png', sizingMethod='scale');
    }
</style>
<![endif]-->
<?php
/** @var Users $modelUser */
$modelUser = $this->modelUser;
?>
<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-12 medium-9 small-12 columns left-sector-add-object">
            <div class="row collapse">
                <div id="login" class="row collapse">
                    <form>
                    <div class="row collapse">
                        <div class="large-3 columns"><p>E_Mail</p></div>
                        <div class="large-9 columns name-field">
                            <input type="text" required pattern="[a-zA-Z]+" required pattern="[а-яА-Я]+">
                            <label class="error">Ошибка</label>
                        </div>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--        <div class="input-form-footer">-->
<!--                <div class="name-field">-->
<!--                    --><?php //echo $form->error($modelUser, 'errorMessage', ['class' => 'error']); ?>
<!--                </div>-->
<!---->
<!--                <div class="name-field">-->
<!--                    --><?php //echo $form->textField($modelUser, 'email', [
//                            'placeholder' => Yii::t('main', 'E_Mail'),
//                        ]); ?>
<!--                    --><?php //echo $form->error($modelUser, 'email', ['class' => 'error']); ?>
<!--                </div>-->
<!---->
<!--                <div class="name-field">-->
<!--                    --><?php //echo $form->passwordField($modelUser, 'password', [
//                            'placeholder' => Yii::t('main', 'Пароль'),
//                        ]); ?>
<!--                    --><?php //echo $form->error($modelUser, 'password', ['class' => 'error']); ?>
<!--                </div>-->
<!--            <div class="row">-->
<!--                <div class="large-12 columns">-->
<!--                    <div class="name-field row">-->
<!--                        <div class="large-12 columns">-->
<!--                            --><?php //echo CHtml::submitButton(Yii::t('main', 'Войти'), ['class' => 'button']); ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        --><?php //$this->endWidget('login-form'); ?>
</div>