
<p>Здравствуйте.</p>
<p>Это письмо отправлено вам с сайта <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>.
    Вы получили его, потому что инициировали процедуру восстановления пароля на сайте <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>.</p>
<p>Ваши регистрационные данные:</p>
<p>
    E-mail: <?php echo $user->email; ?><br/>
    Мобильный телефон: <?php echo $user->phone; ?><br/>
    Новый пароль: <?php echo $newPassword; ?>
</p>
<p>Если у Вас возникли какие-либо вопросы по нашему сервису, обратитесь к администрации сайта <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>:
    <a href="mailto:<?php echo Yii::app()->params['supportEmail']; ?>"><?php echo Yii::app()->params['supportEmail']; ?></a>.</p>
<p>
С уважением,<br/>
Администрация сайта <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>
</p>