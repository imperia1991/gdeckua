<script type="text/javascript">
var placeMap;
var placeCenter = [<?php echo $model->lat ? $model->lat : 49.439172 ?>,<?php echo $model->lng ? $model->lng : 32.059268 ?>];
var placemark;
var country = "<?php echo is_object($model->country) ? $model->country->title_ru : ''; ?>";
var region = "<?php echo is_object($model->region) ? $model->region->title_ru : ''; ?>";
var city = "<?php echo is_object($model->city) ? $model->city->title_ru : ''; ?>";
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
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'focus' => ($model->hasErrors()) ? '.error:first' : array($model, 'title_ru'),
)); ?>

<div class="row">
    <h4>Добавление места</h4>
</div>

<div class="row">
    <?php echo $form->textFieldRow($model, 'title_ru'); ?>
    <?php echo $form->textFieldRow($model, 'title_uk'); ?>
    <?php echo $form->dropDownListRow($model, 'district_id', $districts, array('empty' => 'Выберите район')); ?>
    <?php echo $form->textAreaRow($model, 'description', array('class' => 'span8', 'rows' => 5, 'value' => StringHelper::br2nl($model->description))); ?>
    <div class="control-group ">
        <label for="Places_title_uk" class="control-label required">Теги (через запятую) <span class="required">*</span></label>
        <div class="controls">
            <?php
                $this->widget('application.extensions.PTags.PTags', array(
                    'id' => 'PlaceTags',
                    'value' => is_object($model->tags) ? $model->tags->tags : NULL,
                    'options' => array(
                        'editable' => true,
                        'remover' => true,
                    )
                ));
            ?>
            <?php $form->error($model, ''); ?>
        </div>
    </div>
    <?php echo $form->textFieldRow($model, 'address', array()); ?>
    <?php echo $form->textFieldRow($model, 'lat', array('readonly' => 'readonly')); ?>
    <?php echo $form->textFieldRow($model, 'lng', array('readonly' => 'readonly')); ?>
    <?php echo $form->dropDownListRow($model, 'is_deleted', $model->getIsDeletes()); ?>
</div>
<div id="placeMap" class="row" style="height:600px; width: 100%">

</div>
<?php if (isset($model->photos)): ?>
<div class="row" style="margin-top: 20px;">
    <?php foreach ($model->photos as $photo): ?>
        <img width="280" height="180" src="<?php echo '/' . Yii::app()->params['admin']['files']['images'] . $photo->title; ?>" alt="" class="photo_<?php echo $photo->id ?>" style="margin: 0 10px;">
        <a href="javascript:void(0)" rel="<?php echo $photo->id ?>" style="disply:block;vertical-align:top;margin: 0 -5px 0 -10px;" class="deletePhoto photo_<?php echo $photo->id; ?>">
            <img src="/img/deleteFile.png" alt="">
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
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