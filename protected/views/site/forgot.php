<?php
/** @var Users $modelUserForgot */

$this->breadcrumbs = [
    '' => Yii::t('main', 'Востановление пароля')
];

$errors = $modelUserForgot->getErrors();
?>

<div class="page_content form_page clearfix">
	<div class="add_object">
		<?php $form = $this->beginWidget(
			'CActiveForm',
			[
				'id'                   => 'forgot-form',
				'enableAjaxValidation' => false,
			]
		); ?>
		<div class="form_input_wrap">
			<div class="input_wrap ">
				<?php echo Yii::t('main', 'Введите Ваш E-Mail под которым Вы зарегистрированы на сайте'); ?>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t( 'main', 'E-Mail' ); ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo $form->textField($modelUserForgot, 'email', [
					'class' => 'input'
				]); ?>
				<?php if ( isset( $errors['email'] )): ?>
					<span class="input_error"><?php echo $errors['email'][0]; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="form_input_bottom clearfix">
			<?php echo CHtml::submitButton(Yii::t('main', 'Восстановить'), ['class' => 'submit']); ?>
		</div>
		<?php $this->endWidget( 'forgot-form' ); ?>
	</div>

</div>
