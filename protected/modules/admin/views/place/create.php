<script type="text/javascript">
var placeMap;
var placeCenter = [<?php echo $model->lat ? $model->lat : 49.439172 ?>,<?php echo $model->lng ? $model->lng : 32.059268 ?>];
var placemark;
var country = "<?php is_object($model->country) ? $model->country->title_ru : ''; ?>";
var region = "<?php is_object($model->region) ? $model->region->title_ru : ''; ?>";
var city = "<?php is_object($model->city) ? $model->city->title_ru : ''; ?>";
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/place.js', CClientScript::POS_BEGIN);
?>
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
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'addPlaceForm',
    'type'=>'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<div class="row">
    <h4>Добавление места</h4>
</div>

<div class="row">
    <?php echo $form->textFieldRow($model, 'title_ru'); ?>
    <?php echo $form->textFieldRow($model, 'title_uk'); ?>
    <?php echo $form->textAreaRow($model, 'description', array('class' => 'span8', 'rows' => 5)); ?>
    <div class="control-group ">
        <label for="Places_title_uk" class="control-label required">Теги (через запятую) <span class="required">*</span></label>
        <div class="controls">
            <?php
                $this->widget('application.extensions.PTags.PTags', array(
                    'id' => 'PlaceTags',
                    'value' => $model->tags->tags,
                    'options' => array(
                        'editable' => true,
                        'remover' => true,
                    )
                ));
            ?>
            <?php $form->error($model, ''); ?>
        </div>
    </div>
    <?php echo $form->textFieldRow($model, 'address', array('id' => 'address')); ?>
    <?php echo $form->textFieldRow($model, 'lat', array('id' => 'placeLat', 'readonly' => 'readonly')); ?>
    <?php echo $form->textFieldRow($model, 'lng', array('id' => 'placeLng', 'readonly' => 'readonly')); ?>
</div>
<div id="placeMap" class="row" style="height:400px;">

</div>
<?php /*if (isset($model->photos)): ?>
<div class="row">
    <?php foreach ($model->photos as $photo): ?>
        <a href="<?php echo '/' . Yii::app()->params['files']['photos'] . $photo->size_big ?>" class="lightbox photo_<?php echo $photo->id ?>" style="margin: 0 10px;" rel="group">
            <img width="80" height="80" src="<?php echo '/' . Yii::app()->params['files']['photos'] . $photo->size_middle ?>" alt="">
        </a>
        <a href="javascript:void(0)" rel="<?php echo $photo->id ?>" style="disply:block;vertical-align:top;margin: 0 -5px 0 -10px;" class="deletePhoto photo_<?php echo $photo->id ?>"">
            <img src="/images/elements/uploader/deleteFile.png" alt="">
        </a>
    <?php endforeach; ?>
</div>
<?php endif; */?>
<div class="row">
    <?php
        $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'uploadPhoto',
                    'config' => array(
                        'action' => Yii::app()->createUrl('/admin/place/upload'),
                        'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                        'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                        'multiple' => true,
                        'template' => '
                            <div class="qq-uploader" style="padding-left: 90px">
                                <div class="qq-upload-drop-area"></span></div>
                                <div class="qq-upload-button btn" style="width: 164px;margin-bottom:25px;"><a href="javascript:void(0)">Загрузить фотографии</a></div>
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
                                                $("#uploadPhoto").append(
                                                        "<img class=\"delClass\" src=\"/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "\" width=\"280\" height=\"180\" data-filename=\"" + responseJSON.filename + "\" />"
                                                    );
                                                $("#uploadPhoto").append(
                                                        "<a id=\"image_" + responseJSON.filename + "\" href=\"javascript:void(0)\" onclick=\"photo.deletePreviewUpload(this);\" data-filename=\"" + responseJSON.filename + "\" rel=\"" + responseJSON.filename + "\" class=\"delClass\" style=\"margin:0 5px 0 5px; vertical-align:top;\"><img src=\"/img/deleteFile.png\" /></a>"
                                                    );
                                                $("#uploadPhoto").append(
                                                         "<input name=\"Photos[]\" type=\"hidden\" value=\"" + responseJSON.filename + "\" data-filename=\"" + responseJSON.filename + "\" class=\"delClass\"/>"
                                                    );
                                            }
                                        }'
                    )
                )
        );
    ?>
    <?php echo $form->error($model, 'photo'); ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/place', 'label'=>'Отмена')); ?>
</div>

<?php $this->endWidget(); ?>