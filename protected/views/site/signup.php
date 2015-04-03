<?php
/** @var Users $modelUserRegister */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Регистрация')
];

$errors = $modelUserRegister->getErrors();
?>

<div class="page_content form_page clearfix">
	<div class="add_object">
		<?php $form = $this->beginWidget(
			'CActiveForm',
			[
				'id'                   => 'register-form',
				'enableAjaxValidation' => false,
			]
		); ?>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t( 'main', 'Имя' ); ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo $form->textField($modelUserRegister, 'name', [
					'class' => 'input'
				] ); ?>
				<?php if ( isset( $errors['name'] )): ?>
					<span class="input_error"><?php echo $errors['name'][0]; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t( 'main', 'E-Mail' ); ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo $form->textField($modelUserRegister, 'email', [
					'class' => 'input'
				] ); ?>
				<?php if ( isset( $errors['email'] )): ?>
					<span class="input_error"><?php echo $errors['email'][0]; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t( 'main', 'Пароль' ); ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo $form->passwordField($modelUserRegister, 'password', [
					'class' => 'input'
				] ); ?>
				<?php if ( isset( $errors['password'] )): ?>
					<span class="input_error"><?php echo $errors['password'][0]; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t( 'main', 'Повторите пароль' ); ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo $form->passwordField($modelUserRegister, 'passwordRepeat', [
					'class' => 'input'
				] ); ?>
				<?php if ( isset( $errors['passwordRepeat'] )): ?>
					<span class="input_error"><?php echo $errors['passwordRepeat'][0]; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="form_input_bottom clearfix">
			<div class="captcha_block">
				<div class="captcha_image">
					<? if ( CCaptcha::checkRequirements() ): ?>
						<?php $this->widget( 'CCaptcha', [
							'buttonLabel'       => Yii::t( 'main', 'Обновить' ),
							'showRefreshButton' => true,
							'buttonOptions'     => [
								'class' => 'captcha_refresh'
							],
							'clickableImage'    => true
						] ); ?>
					<? endif ?>
				</div>
				<?php echo $form->textField($modelUserRegister, 'verifyCode', [
					'class'       => 'input captcha_input',
					'placeholder' => Yii::t( 'main', 'Введите код с картинки' ) . ' *'
				] ); ?>
				<?php if (isset($errors['verifyCode'])): ?>
					<span class="error"><?php echo $errors['verifyCode'][0]; ?></span>
				<?php endif; ?>
			</div>
			<?php echo CHtml::submitButton(Yii::t('main', 'Зарегистрироваться'), ['class' => 'submit']); ?>
		</div>
		<?php $this->endWidget('register-form' ); ?>
	</div>

</div>