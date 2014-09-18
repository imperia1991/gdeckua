<?php
/** @var Users $model */
?>

<p>Шановний користувач <?php echo $model->name; ?>!</p>

<p>Цей лист надіслано вам з сайту <a href="http://www.gde.ck.ua">Де в Черкасах</a>. Ви отримали його, томущо ініціювали процедуру
   відновлення пароля на сайті <a href="http://www.gde.ck.ua">Де в Черкасах</a>.</p>
<p>Ваший новий пароль: <?php echo $model->passwordRepeat; ?></p>

<p>
   Якщо у Вас виникли будь-які питання чи пропозиції по роботі нашого сайту,
   зверніться до адміністрації сайту <a href="http://www.gde.ck.ua">Де в Черкасах</a>: <a href="mailto:support@gde.ck.ua">support@gde.ck.ua</a>
</p>

<p>З повагою,<br/>
   Адміністрація сайту <a href="http://www.gde.ck.ua">Де в Черкасах</a>
</p>
