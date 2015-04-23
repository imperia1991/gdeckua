<?php
$this->pageTitle = Yii::t('main', 'Изменить E-Mail');

$this->breadcrumbs = [
	'muser' => Yii::t('main', 'Мой кабинет'),
	'' => Yii::t('main', 'Изменить E-Mail'),
];

/**@var ChangeEmailForm $modelChangeEmailForm */

$errors = $modelChangeEmailForm->getErrors();
?>
<div class="page_content news clearfix">
	<div class="news_main muser">
		<div class="news_cathegories">
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Личная информация'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/password'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Изменить пароль'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/blog'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Мои блоги'); ?>
			</a>
		</div>
		<div class="add_object">
			<?php $form = $this->beginWidget(
				'CActiveForm',
				[
					'id'                   => 'change-email-model-form',
					'enableAjaxValidation' => false,
					'htmlOptions'          => ['enctype' => 'multipart/form-data'],
				]
			); ?>
			<div class="form_input_wrap">
				<div class="form_input_label" style="font-size: 20px">
					<?php echo Yii::t('main', 'Ваш текущий E-Mail'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php echo $form->textField($modelChangeEmailForm, 'email', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['email'])): ?>
						<span class="input_error"><?php echo $errors['email'][0]; ?></span>
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

