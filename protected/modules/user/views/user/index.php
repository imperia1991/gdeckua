<?php
$this->pageTitle = Yii::t('main', 'Личная информация');

$this->breadcrumbs = [
	'user' => Yii::t('main', 'Мой кабинет'),
	''      => Yii::t('main', 'Личная информация')
];

/**@var PrivateInfoForm $modelPrivateInfoForm */

$errors = $modelPrivateInfoForm->getErrors();
?>
<div class="page_content news clearfix">
	<div class="news_main muser">
		<div class="news_cathegories">
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/user/email'); ?>"
			   class="cathegories_item">
				<?php echo Yii::t('main', 'Изменить E-Mail'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/user/password'); ?>"
			   class="cathegories_item">
				<?php echo Yii::t('main', 'Изменить пароль'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/user/blog'); ?>"
			   class="cathegories_item">
				<?php echo Yii::t('main', 'Мои блоги'); ?>
			</a>
		</div>
		<div class="add_object">
			<?php $form = $this->beginWidget(
				'CActiveForm',
				[
					'id'                   => 'private-info-model-form',
					'enableAjaxValidation' => false,
					'htmlOptions'          => ['enctype' => 'multipart/form-data'],
				]
			); ?>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'ФИО'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php echo $form->textField($modelPrivateInfoForm, 'full_name', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['full_name'])): ?>
						<span class="input_error"><?php echo $errors['full_name'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'Мобильный телефон'); ?> <span class="nes">*</span>
				</div>
				<div class="input_wrap ">
					<?php
					$this->widget('CMaskedTextField', [
						'model' => $modelPrivateInfoForm,
						'attribute' => 'phone',
						'mask' => '999 999 9999',
						'placeholder' => '*',
						'htmlOptions' => [
							'class' => 'input'
						]
					]);
					?>
					<?php if (isset($errors['phone'])): ?>
						<span class="input_error"><?php echo $errors['phone'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'Дополнительный телефон'); ?>
				</div>
				<div class="input_wrap ">
					<?php
					$this->widget('CMaskedTextField', [
						'model' => $modelPrivateInfoForm,
						'attribute' => 'phone_add',
						'mask' => '999999?9999',
						'placeholder' => '*',
						'htmlOptions' => [
							'class' => 'input'
						]
					]);
					?>
					<?php if (isset($errors['phone_add'])): ?>
						<span class="input_error"><?php echo $errors['phone_add'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'Сайт'); ?>
				</div>
				<div class="input_wrap ">
					<?php echo $form->textField($modelPrivateInfoForm, 'site', [
						'class' => 'input'
					]); ?>
					<?php if (isset($errors['site'])): ?>
						<span class="input_error"><?php echo $errors['site'][0]; ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="form_input_wrap photos">
				<?php
				$template = $this->renderPartial('partials/_uploadPhotoTemplate', [], true);
				$this->widget(
					'ext.EAjaxUpload.EAjaxUpload',
					[
						'id' => 'uploadPhoto',
						'config' => [
							'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/user/user/upload'),
							'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
							'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
							'multiple' => true,
							'template' => $template,
							'messages' => [
								'typeError' => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
								'sizeError' => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
								'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
								'emptyError' => "{file} пуст, пожалуйста, выберите другой файл.",
								'noFilesError' => "Файлы для загрузки не выбраны.",
								'onLeave' => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
							],
							'text' => [
								'failUpload' => 'Загрузка не удалась',
								'dragZone' => 'Перетащите файл для загрузки',
								'cancelButton' => 'Отмена',
								'waitingForResponse' => 'Обработка...'
							],
							'onComplete' => 'js:function(id, fileName, responseJSON){
                                                        if (responseJSON.success)
                                                        {
                                                        	$("#uploadPhotoImg").attr("src", "" + responseJSON.filename + "");
                                                        	$("#uploadPhotoInput").val(responseJSON.filename);
                                                        }
                                                    }'
						]
					]
				);
				?>
				<div style="width: 100%; text-align: center; margin-top: 10px;">
					<?php if (!empty(Yii::app()->session['photoUser'])): ?>
						<img id="uploadPhotoImg" src="<?php echo Yii::app()->session['photoUser']; ?>" width="150" height="150" />
					<?php elseif (!empty($modelPrivateInfoForm->photo)): ?>
						<img id="uploadPhotoImg" src="/<?php echo $modelPrivateInfoForm->photo; ?>" style="max-width: 150px; max-height: 150px" />
					<?php else: ?>
						<img id="uploadPhotoImg" src="/images/user.png" width="150" height="150" />
					<?php endif; ?>
					<input id="uploadPhotoInput" name="PrivateInfoForm[photo]" type="hidden" value="<?php echo $modelPrivateInfoForm->photo ?>" />
				</div>
			</div>
			<div class="form_input_bottom clearfix">
				<?php echo CHtml::submitButton(Yii::t('main', 'Обновить'), [
					'class' => 'submit'
				]); ?>
			</div>
			<?php $this->endWidget('private-info-model-form'); ?>
		</div>
	</div>
</div>

