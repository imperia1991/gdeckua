<?php
$this->pageTitle = Yii::t('main', 'Добавить блог');

$this->breadcrumbs = [
	'user/blog' => Yii::t('main', 'Мои блоги'),
	''     => Yii::t('main', 'Добавление блога')
];

/**@var Blog $modelBlog */

$errors = $modelBlog->getErrors();
?>

<div class="page_content news clearfix">
	<div class="news_main muser">
		<div class="news_cathegories">
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/user/blog'); ?>"
			   class="cathegories_item">
				<?php echo Yii::t('main', 'Мои блоги'); ?>
			</a>
		</div>
		<div class="add_object">
			<?php $form = $this->beginWidget(
				'CActiveForm',
				[
					'id'                   => 'add-blog-model-form',
					'enableAjaxValidation' => false,
					'htmlOptions'          => ['enctype' => 'multipart/form-data'],
				]
			); ?>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'Название'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php echo $form->textField($modelBlog, 'title', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['title'])): ?>
						<span class="input_error"><?php echo $errors['title'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_bottom clearfix">
				<?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), [
					'class' => 'submit'
				]); ?>
			</div>
			<?php $this->endWidget('private-info-model-form'); ?>
		</div>
	</div>
</div>