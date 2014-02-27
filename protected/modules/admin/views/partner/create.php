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
</style>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'addPartnerForm',
    'type'=>'horizontal',
)); ?>

<div class="row">
    <h4>Добавление партнера</h4>
</div>

<div class="row">
    <?php echo $form->textFieldRow($model, 'title'); ?>
    <?php echo $form->textAreaRow($model, 'description', array('class'=>'span8', 'rows'=>5)); ?>
    <?php echo $form->textFieldRow($model, 'url'); ?>
</div>

<div class="row" style="text-align: center;">
    <img id="partnerPhoto" alt="" src="<?php echo $model->logo_b ? Yii::app()->params['imagesPartnersPath'] . $model->logo_b . '?r=' . mt_rand(0, 10000) : '' ?>" />
    <input id="uploadPartnerPhoto" name="Partners[logo]" type="hidden" value=""/>
    <?php
        $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'uploadPhoto',
                    'config' => array(
                        'action' => Yii::app()->createUrl('/admin/partner/upload'),
                        'allowedExtensions' => Yii::app()->params['admin']['partners']['allowedExtensions'],
                        'sizeLimit' => Yii::app()->params['admin']['partners']['sizeLimit'],
                        'multiple' => true,
                        'template' => '
                            <div class="qq-uploader" style="padding-left: 90px">
                                <div class="qq-upload-drop-area"></span></div>
                                <div class="qq-upload-button btn" style="width: 164px;"><a href="javascript:void(0)">Загрузить фотографию</a></div>
                                <span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
                                <ul class="qq-upload-list"></ul>
                            </div>',
                        'messages' => array(
                            'typeError'    => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
                            'sizeError'    => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
                            'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
                            'emptyError'   => "{file} пуст, пожалуйста, выберите другой файл.",
                            'noFilesError' => "Файлы для загрузки не выбраны.",
                            'onLeave'      => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
                        ),
                        'text' => array(
                            'failUpload'   => 'Загрузка не удалась',
                            'dragZone'     => 'Перетащите файл для загрузки',
                            'cancelButton' => 'Отмена',
                            'waitingForResponse' => 'Обработка...'
                        ),
                        'onComplete' => 'js:function(id, fileName, responseJSON){
                                            if (responseJSON.success)
                                            {
                                                $("#partnerPhoto").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                                $("#uploadPartnerPhoto").val(responseJSON.filename);
                                            }
                                        }'
                    )
                )
        );
    ?>
    <?php echo $form->error($model, 'logo'); ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/partner', 'label'=>'Отмена')); ?>
</div>

<?php $this->endWidget(); ?>