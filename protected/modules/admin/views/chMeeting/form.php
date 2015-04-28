<?php
/** @var NewsChaska $meetingModel */

Yii::app()->clientScript->registerScriptFile('/js/jquery-migrate-1.2.1.js', CClientScript::POS_BEGIN);
?>

<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id'=>'addMeetingForm',
        'type'=>'horizontal',
        'htmlOptions' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'clientOptions' => [
            'validateOnSubmit' => false,
            'validateOnChange' => false,
        ],
        'focus' => ($meetingModel->hasErrors()) ? '.error:first' : [$meetingModel, 'title'],
    ]); ?>

<div class="row">
	<?php echo $form->dropDownListRow($meetingModel, 'status', $meetingModel->getStatuses()); ?>
    <?php echo $form->textFieldRow($meetingModel, 'title', [
            'style' => 'width:90%'
        ]); ?>
    <?php echo $form->textFieldRow($meetingModel, 'short_text', [
            'style' => 'width:90%'
        ]); ?>
</div>
<div class="row" style="margin-bottom: 30px;">
    <?php
    $this->widget('ext.EAjaxUpload.EAjaxUpload', [
            'id' => 'uploadPhotos',
            'config' => [
                'action' => Yii::app()->createUrl('/admin/chMeeting/uploadPhotos'),
                'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                'multiple' => true,
                'template' => '
	                <div class="qq-uploader">
	                    <div class="qq-upload-drop-area"></span></div>
	                    <div class="qq-upload-button btn" style="width: 208px;"><a href="javascript:void(0)" class="buttonL bGreyish">' . Yii::t('admin', 'Добавить фотографии в редактор') . '</a></div>
	                    <span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
	                    <ul class="qq-upload-list" style="display: none;"></ul>
	                </div>',
                'messages' => [
                    'typeError' => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
                    'sizeError' => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
                    'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
                    'emptyError' => "{file} пуст, пожалуйста, выберите другой файл.",
                    'noFilesError' => "Файлы для загрузки не выбраны.",
                    'onLeave' => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
                ],
                'text' => [
                    'failUpload' => 'загрузка не удалась',
                    'dragZone' => 'Перетащите файл для загрузки',
                    'cancelButton' => 'Отмена',
                    'waitingForResponse' => 'Обработка...'
                ],
                'onComplete' => 'js:function(id, fileName, responseJSON){
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
    <?php echo $form->error($meetingModel, 'text'); ?>
    <?php
    $this->widget('ext.tinymce.TinyMce', [
            'id' => 'meetingText',
            'model' => $meetingModel,
            'attribute' => 'text',
            'compressorRoute' => '/admin/tinyMce/compressor',
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'htmlOptions' => [
                'rows' => 30,
            ],
            'settings' => [
                'language' => Yii::app()->getLanguage()
            ]
        ]);
    ?>
</div>
<div class="row" style="margin-top: 30px;">
    <?php
    $meetingPhoto = '';
    $namePhoto = '';
    if (isset(Yii::app()->session['meetingImage'])) {
        $namePhoto = Yii::app()->session['meetingImage'];
	    $meetingPhoto = '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['meetingImage'] . '?r=' . rand(0, 10000);
    } elseif (!empty($meetingModel->photo)) {
        $namePhoto = $meetingModel->photo;
	    $meetingPhoto = '/' . Yii::app()->params['admin']['files']['ch'] . $meetingModel->photo . '?r=' . rand(0, 10000);
    }
    ?>

    <br/>
    <img id="meetingPhoto" width="71" height="60" alt="" src="<?php echo $meetingPhoto; ?>" style="margin-bottom: 20px;margin-top: 20px;" />
    <input id="uploadInputPhoto" name="NewsChaska[photo]" type="hidden" value="<?php echo $namePhoto; ?>"/>
    <?php
    $this->widget('ext.EAjaxUpload.EAjaxUpload', [
            'id' => 'uploadAvatar',
            'config' => [
                'action' => Yii::app()->createUrl('/admin/chMeeting/upload'),
                'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                'multiple' => false,
                'template' => '
					<div class="qq-uploader">
						<div class="qq-upload-drop-area"></span></div>
						<div class="qq-upload-button btn" style="width: 223px;"><a href="javascript:void(0)" class="buttonL bGreyish">' . Yii::t('admin', 'Добавить фотографию для анонса') . '</a></div>
						<span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
						<ul class="qq-upload-list" style="display: none;"></ul>
					</div>',
                'messages' => [
                    'typeError' => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
                    'sizeError' => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
                    'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
                    'emptyError' => "{file} пуст, пожалуйста, выберите другой файл.",
                    'noFilesError' => "Файлы для загрузки не выбраны.",
                    'onLeave' => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
                ],
                'text' => [
                    'failUpload' => 'загрузка не удалась',
                    'dragZone' => 'Перетащите файл для загрузки',
                    'cancelButton' => 'Отмена',
                    'waitingForResponse' => 'Обработка...'
                ],
                'onComplete' => 'js:function(id, fileName, responseJSON){
                                        if (responseJSON.success)
                                        {
                                            $("#meetingPhoto").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                            $("#uploadInputPhoto").val(responseJSON.filename);
                                        }
                                    }'
            ]
        ]
    );
    ?>
</div>
<div class="row">
    <?php echo $form->error($meetingModel, 'photo'); ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'submit', 'type'=>'primary', 'label'=>$meetingModel->isNewRecord ? Yii::t('admin', 'Добавить') : Yii::t('admin', 'Сохранить')]); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/chMeeting', 'label'=>Yii::t('admin', 'Отмена')]); ?>
</div>

<?php $this->endWidget();