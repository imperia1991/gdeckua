<?php
/** @var Users $model */
?>

<p>Уважаемый пользователь <?php echo $model->name; ?>!</p>

<p>Это письмо отправлено вам с сайта <a href="http://www.gde.ck.ua">Где в Черкассах</a>. Вы получили его, потому что инициировали процедуру
    восстановления пароля на сайте <a href="http://www.gde.ck.ua">Где в Черкассах</a>.</p>
<p>Ваш новый пароль: <?php echo $model->passwordRepeat; ?></p>

<p>
    Если у Вас возникли какие-либо вопросы или предложения по работе нашего сайта,
    обратитесь к администрации сайта <a href="http://www.gde.ck.ua">Где в Черкассах</a>: <a href="mailto:support@gde.ck.ua">support@gde.ck.ua</a>
</p>

<p>С уважением,<br/>
    Администрация сайта <a href="http://www.gde.ck.ua">Где в Черкассах</a>
</p>
