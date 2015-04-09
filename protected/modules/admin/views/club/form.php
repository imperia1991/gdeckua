<?php
/** @var NewsChaska $clubModel */

//Yii::app()->clientScript->registerScriptFile('/js/jquery-migrate-1.2.1.js', CClientScript::POS_BEGIN);

$lang = Yii::app()->getLanguage();
if ($lang == 'uk') {
	$lang = 'ua';
}
?>

<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
	'id'                     => 'addMeetingForm',
	'type'                   => 'horizontal',
	'htmlOptions'            => ['enctype' => 'multipart/form-data'],
	'enableAjaxValidation'   => false,
	'enableClientValidation' => false,
	'clientOptions'          => [
		'validateOnSubmit' => false,
		'validateOnChange' => false,
	],
	'focus'                  => ($clubModel->hasErrors()) ? '.error:first' : [$clubModel, 'title'],
]); ?>

	<div class="row">
		<?php echo $form->dropDownListRow($clubModel, 'status', $clubModel->getStatuses()); ?>
		<?php echo $form->textFieldRow($clubModel, 'title', [
			'style' => 'width:90%'
		]); ?>
	</div>
	<div class="row">
		<label><?php echo Yii::t('admin', 'Краткое описание'); ?> <span class="required">*</span></label>
		<?php
		$attribute = 'short_text';
		$this->widget('ImperaviRedactorWidget', [
			'model'     => $clubModel,
			'attribute' => 'short_text',
			// Redactor options
			'options'   => [
				'lang'               => $lang,
				'minHeight'          => 200,
				'imageGetJson'       => Yii::app()->createAbsoluteUrl('/admin/club/imageGetJson'),
				'imageUpload'        => Yii::app()->createAbsoluteUrl('/admin/club/imageUpload'),
				'clipboardUploadUrl' => Yii::app()->createAbsoluteUrl('/admin/club/imageUpload'),
				'counterCallback' => "function(data)
                {
	                console.log('Words: ' + data.words);
	                console.log('Characters: ' + data.characters);
	                console.log('Characters w/o spaces: ' + (data.characters - data.spaces));
                }"
			],
			'plugins'   => [
				'fontsize'     => [
					'js' => ['fontsize.js',],
				],
				'video'     => [
					'js' => ['video.js',],
				],
				'counter'     => [
					'js' => ['counter.js',],
				],
			],
		]);
		?>
	</div>
	<div class="row">
		<?php echo $form->error($clubModel, 'short_text'); ?>
	</div>
	<div class="row" style="margin-bottom: 30px;">
		<label><?php echo Yii::t('admin', 'Полный текст'); ?> <span class="required">*</span></label>
		<?php
		$this->widget('ext.EAjaxUpload.EAjaxUpload', [
				'id'     => 'uploadPhotos',
				'config' => [
					'action'            => Yii::app()->createUrl('/admin/club/uploadPhotos'),
					'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
					'sizeLimit'         => Yii::app()->params['admin']['images']['sizeLimit'],
					'multiple'          => true,
					'template'          => '
	                <div class="qq-uploader">
	                    <div class="qq-upload-drop-area"></span></div>
	                    <div class="qq-upload-button btn" style="width: 208px;"><a href="javascript:void(0)" class="buttonL bGreyish">' . Yii::t('admin', 'Добавить фотографии в редактор') . '</a></div>
	                    <span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
	                    <ul class="qq-upload-list" style="display: none;"></ul>
	                </div>',
					'messages'          => [
						'typeError'    => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
						'sizeError'    => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
						'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
						'emptyError'   => "{file} пуст, пожалуйста, выберите другой файл.",
						'noFilesError' => "Файлы для загрузки не выбраны.",
						'onLeave'      => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
					],
					'text'              => [
						'failUpload'         => 'загрузка не удалась',
						'dragZone'           => 'Перетащите файл для загрузки',
						'cancelButton'       => 'Отмена',
						'waitingForResponse' => 'Обработка...'
					],
					'onComplete'        => 'js:function(id, fileName, responseJSON){
                                if (responseJSON.success)
                                {
                                    //alert("Фотографии добавлены на сервер")
                                    $("#meetingText").append("<p><img src=\"" + responseJSON.filePath  + "\" /></p>");
                                }
                            }'
				]
			]
		);
		?>
	</div>
	<div class="row">
		<?php
		$this->widget('ext.tinymce.TinyMce', [
			'id'              => 'meetingText',
			'model'           => $clubModel,
			'attribute'       => 'text',
			'compressorRoute' => '/admin/tinyMce/compressor',
			'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
			'htmlOptions'     => [
				'rows' => 30,
			],
			'settings'        => [
				'language' => Yii::app()->getLanguage()
			]
		]);
		?>
	</div>
	<div class="row">
		<?php echo $form->error($clubModel, 'text'); ?>
	</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', [
			'buttonType' => 'submit',
			'type'       => 'primary',
			'label'      => $clubModel->isNewRecord ? Yii::t('admin', 'Добавить') : Yii::t('admin', 'Сохранить')
		]); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', [
			'buttonType' => 'link',
			'url'        => '/admin/meeting',
			'label'      => Yii::t('admin', 'Отмена')
		]); ?>
	</div>

<?php $this->endWidget();