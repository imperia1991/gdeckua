<style type="text/css">
    .qq-upload-list {
        display: none;
        visibility: hidden;
    }
    #furniturePhoto {
        max-width: 950px;
        max-height: 466px;
    }
    #uploadPhoto {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .ui-ptags-tag-text {

    }
</style>
<?php
/** @var PhotoCity $photoCityModel */
?>
<div class="row">
    <h4><?php echo $photoCityModel->isNewRecord ? 'Добавление фото города / мероприятия' : 'Редактирование фото города / мероприятия'; ?></h4>
</div>
<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'photoCity-model-form',
        'type'=>'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => ['enctype' => 'multipart/form-data'],
    ]
); ?>
<div class="row">
            <?php echo $form->textFieldRow($photoCityModel, 'title', []); ?>
            <?php echo $form->textFieldRow($photoCityModel, 'author', []); ?>
            <?php echo $form->dropDownListRow($photoCityModel, 'type', $photoCityModel->getTypes(), []); ?>
            <?php echo $form->textFieldRow($photoCityModel, 'site', []); ?>
</div>
<div class="row">
    <?php
    $this->widget(
        'ext.EAjaxUpload.EAjaxUpload',
        [
            'id' => 'uploadPhoto',
            'config' => [
                'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo/upload'),
                'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                'multiple' => false,
                'template' => '
                            <div class="qq-uploader" style="padding-left: 90px">
                                <div class="qq-upload-drop-area"></span></div>
                                <div class="qq-upload-button btn" style="width: 164px;margin-bottom:25px;"><a href="javascript:void(0)">Загрузить фотографию</a></div>
                                <span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
                                <ul class="qq-upload-list"></ul>
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
                    'failUpload' => 'Загрузка не удалась',
                    'dragZone' => 'Перетащите файл для загрузки',
                    'cancelButton' => 'Отмена',
                    'waitingForResponse' => 'Обработка...'
                ],
                'onComplete' => 'js:function(id, fileName, responseJSON){
                                    if (responseJSON.success)
                                    {
                                        $("#photoCity").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                        $("#uploadInputPhotoCity").val(responseJSON.filename);
                                    }
                                }'
            ]
        ]
    );
    ?>
    <?php echo $form->error($photoCityModel, 'photo', ['class' => 'error']); ?>
</div>
<div class="row">
    <?php
    $photoCity = isset(Yii::app()->session['photoCity'])
        ? '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['photoCity']
        : (!empty($photoCityModel->photo) ? '/' . Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo : '');
    $photoCityName = isset(Yii::app()->session['photoCity']) ? Yii::app()->session['photoCity'] : $photoCityModel->photo;
    ?>
    <img id="photoCity" src="<?php echo $photoCity; ?>" />
    <input id="uploadInputPhotoCity" name="PhotoCity[photo]" type="hidden" value="<?php echo $photoCityName; ?>"/>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'submit', 'type'=>'primary', 'label'=>$photoCityModel->isNewRecord ? 'Добавить' : 'Сохранить']); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/photoCity', 'label'=>'Отмена']); ?>
</div>
<?php $this->endWidget('photoCity-model-form'); ?>