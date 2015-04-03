<?php
/** @var Users $modelUser */
/** @var Users $modelUserRegister */
/** @var Users $modelUserForgot */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Авторизация')
];
$errors = $modelUser->getErrors();
?>

<div class="page_content form_page clearfix">
	<div class="add_object">
		<?php $form = $this->beginWidget(
			'CActiveForm',
			[
				'id'                   => 'login-form',
				'enableAjaxValidation' => false,
			]
		); ?>
		<div class="form_input_wrap">
			<div class="input_wrap ">
				<a href="<?php echo '/' . Yii::app()->getLanguage() . '/forgot'; ?>"><?php echo Yii::t('main', 'Забыли пароль?'); ?></a>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="input_wrap ">
				<?php echo $form->error($modelUser, 'errorMessage', ['class' => 'error']); ?>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t( 'main', 'E-Mail' ); ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo $form->textField($modelUser, 'email', [
					'class' => 'input'
				]); ?>
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
				<?php echo $form->passwordField($modelUser, 'password', [
					'class' => 'input'
				]); ?>
				<?php if ( isset( $errors['password'] )): ?>
					<span class="input_error"><?php echo $errors['password'][0]; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="form_input_bottom clearfix">
			<?php echo CHtml::submitButton(Yii::t('main', 'Войти'), ['class' => 'submit']); ?>
		</div>
		<?php $this->endWidget( 'login-form' ); ?>
	</div>

</div>