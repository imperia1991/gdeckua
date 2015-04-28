<?php
$this->pageTitle = Yii::t('main', 'Изменить пароль');

$this->breadcrumbs = [
	'muser' => Yii::t('main', 'Мой кабинет'),
	'' => Yii::t('main', 'Изменить пароль')
];


/**@var ChangePasswordForm $modelChangePasswordForm */

$errors = $modelChangePasswordForm->getErrors();
?>
<div class="page_content news clearfix">
	<div class="news_main muser">
		<div class="news_cathegories">
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Личная информация'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/email'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Изменить E-Mail'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/blog'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Мои блоги'); ?>
			</a>
		</div>
		<div class="add_object">
			<?php $form = $this->beginWidget(
				'CActiveForm',
				[
					'id'                   => 'change-password-model-form',
					'enableAjaxValidation' => false,
				]
			); ?>
			<div class="form_input_wrap">
				<div class="form_input_label" style="font-size: 20px">
					<?php echo Yii::t('main', 'Ваш текущий пароль'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php echo $form->passwordField($modelChangePasswordForm, 'password', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['password'])): ?>
						<span class="input_error"><?php echo $errors['password'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label" style="font-size: 20px">
					<?php echo Yii::t('main', 'Ваш новый пароль'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php echo $form->passwordField($modelChangePasswordForm, 'newPassword', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['newPassword'])): ?>
						<span class="input_error"><?php echo $errors['newPassword'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label" style="font-size: 18px">
					<?php echo Yii::t('main', 'Повторите новый пароль'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php echo $form->passwordField($modelChangePasswordForm, 'newPasswordRepeat', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['newPasswordRepeat'])): ?>
						<span class="input_error"><?php echo $errors['newPasswordRepeat'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_bottom clearfix">
				<?php echo CHtml::submitButton(Yii::t('main', 'Изменить'), [
					'class' => 'submit'
				]); ?>
			</div>
			<?php $this->endWidget('change-email-model-form'); ?>
		</div>
	</div>
</div>

