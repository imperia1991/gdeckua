<div class="pop_up " id="enter_pop_up">
	<div class="pop_up_title">
		<span class="enter_icon"></span>
		<div class="pop_up_title_wrap">Вход в личный кабинет</div>
		<a href="#" class="pop_up_close"></a>
	</div>
	<div class="pop_up_content">
		<div class="input_wrap email_input">
			<input type="text" class="input error" placeholder="Введите Ваш логин (E-mail)">
			<span class="input_error">Ошибка</span>
		</div>
		<div class="input_wrap pass_input">
			<input type="text" class="input password" placeholder="Введите Ваш пароль">
		</div>
		<div class="pop_up_bottom clearfix">
			<a href="#" class="forget">Забыли пароль?</a>
			<input type="submit" value="Вход" class="submit">
		</div>
	</div>
</div>
<div class="pop_up " id="registr_pop_up">
	<div class="pop_up_title">
		<span class="registr_icon"></span>
		<div class="pop_up_title_wrap">Регистрация нового пользователя</div>
		<a href="#" class="pop_up_close"></a>
	</div>
	<div class="pop_up_content">
		<div class="input_wrap email_input">
			<input type="text" class="input error" placeholder="Введите Ваш логин (E-mail)">
			<span class="input_error">Ошибка</span>
		</div>
		<div class="input_wrap pass_input">
			<input type="text" class="input password" placeholder="Введите Ваш пароль">
		</div>
		<div class="input_wrap pass_input">
			<input type="text" class="input password" placeholder="Подтвердите Ваш пароль">
		</div>
		<div class="input_wrap captcha_block clearfix">
			<div class="captcha_image">
				<img src="images/data/captcha.jpg" alt="">
				<a href="#" class="captcha_refresh">Обновить</a>
			</div>
			<input type="text" class="input captcha_input" placeholder="Введите код с картинки">
		</div>
		<div class="check active">
			Я согласен с Условиями Пользовательского соглашения и  Политики конфиденциальности
			<input type="checkbox" value="accept" />
		</div>
		<div class="pop_up_bottom clearfix">
			<input type="submit" value="Зарегистрироваться" class="submit">
		</div>
	</div>
</div>

<?php
$feedback = $this->feedback;
?>
<div class="pop_up" id="feedback">
	<div class="pop_up_title">
		<span class="feedback_icon"></span>
		<div class="pop_up_title_wrap"> <?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></div>
		<a href="#" class="pop_up_close"></a>
	</div>
	<?php $form = $this->beginWidget('CActiveForm',
		[
			'id' => 'feedback-form',
			'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/feedback'),
			'enableAjaxValidation' => false,
			'htmlOptions' => [],
		]); ?>
	<div class="pop_up_content">
		<div class="input_wrap">
			<?php echo $form->textField($feedback, 'name', [
				'placeholder' => Yii::t('main', 'Введите Ваши имя и фамилию'),
				'id' => 'name',
				'class' => 'input',
			]);
			?>
			<span id="error_name" class="input_error"></span>
		</div>
		<div class="input_wrap">
			<?php echo $form->textField($feedback, 'email', [
				'placeholder' => Yii::t('main', 'Введите Ваш E-mail'),
				'id' => 'email',
				'class' => 'input',
			]);
			?>
			<span id="error_email" class="input_error"></span>
		</div>
		<div class="input_wrap">
			<?php echo $form->textArea($feedback, 'message', [
				'placeholder' => Yii::t('main', 'Введите текст сообщения'),
				'id' => 'message',
				'class' => 'input',
//				'row' => 15
			]);
			?>
			<span id="error_message" class="input_error"></span>
		</div>
		<div class="input_wrap captcha_block clearfix">
			<div class="captcha_image">
				<?if(CCaptcha::checkRequirements()):?>
					<?php $this->widget('CCaptcha', ['buttonLabel' => Yii::t('main', 'Обновить'),
					                                 'showRefreshButton' => true,
					                                 'buttonOptions' => [
						                                 'class' => 'captcha_refresh'
					                                 ],
					                                 'clickableImage' => true
					]); ?>
				<?endif?>
			</div>
			<?php echo $form->textField($feedback, 'verifyCode', [
				'placeholder' => Yii::t('main', 'Введите код с картинки'),
				'id' => 'verifyCode',
				'rows' => 7,
				'class' => 'input captcha_input'
			]);
			?>
			<span id="error_verifyCode" class="input_error"></span>
		</div>
		<div class="pop_up_bottom clearfix">
			<img id="loadingFeedback" style="float: right; display: none" src="/images/loading.gif" alt=""/>
			<?php echo CHtml::submitButton(Yii::t('main', 'Отправить'), ['class' => 'submit']); ?>
		</div>
	</div>
	<?php $this->endWidget('feedback'); ?>
</div>