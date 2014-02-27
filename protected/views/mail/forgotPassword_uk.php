
<p>Здрастуйте.</p>
<p>Цей лист надіслано вам з сайту <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>.
    Ви отримали його, тому що ініціювали процедуру відновлення пароля на сайті <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>.</p>
<p>Ваші реєстраційні дані:</p>
<p>
    E-mail: <?php echo $user->email; ?><br/>
    Мобільний телефон: <?php echo $user->phone; ?><br/>
    Новий пароль: <?php echo $newPassword; ?>
</p>
<p>Якщо у Вас виникли запитання по нашому сервісу, зверніться до адміністрації сайту <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>:
    <a href="mailto:<?php echo Yii::app()->params['supportEmail']; ?>"><?php echo Yii::app()->params['supportEmail']; ?></a>.</p>
<p>
З Повагою,<br/>
Адміністрація сайту <a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->serverName; ?></a>
</p>