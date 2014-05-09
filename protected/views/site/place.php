<?php
Yii::app()->clientScript->registerScriptFile('/js/mainPlace.js', CClientScript::POS_BEGIN);
?>

<?php
$this->pageTitle = CHtml::encode(Yii::t('main', 'Добавить объект'));
$title = 'title_' . Yii::app()->getLanguage();
$district = 'district_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
?>
<div class="container">
    <div class="content">
    </div><!-- .content -->
    <?php $this->renderPartial('partials/_addDescription_' . Yii::app()->getLanguage()); ?>

    <div class="line"></div>
    <?php $form = $this->beginWidget('CActiveForm',
        array(
            'id' => 'place-model-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>
        <div class="form-item">
            <label class="label"><?php echo Yii::t('main', 'Название'); ?> <span>*</span></label>
            <div class="item-wrap">
                <?php echo $form->textField($model, $title, array()); ?>
                <span class="error-block">
                    <?php echo $form->error($model, $title, array('class' => 'error')); ?>
                </span>
            </div>
        </div>
        <div class="form-item">
            <label class="label"><?php echo Yii::t('main', 'Район'); ?> <span>*</span></label>
            <div class="item-wrap">
                <?php echo $form->dropDownList($model, 'district_id', $districts, array('style' => 'width:575px')); ?>
                <span class="error-block">
                    <?php echo $form->error($model, 'district_id', array('class' => 'error')); ?>
                </span>
            </div>
        </div>
        <div class="form-item">
            <label class="label"><?php echo Yii::t('main', 'Адрес'); ?> <span>*</span></label>
            <div class="item-wrap">
                <?php echo $form->textField($model, $address, array()); ?>
                <span class="error-block">
                    <?php echo $form->error($model, $address, array('class' => 'error')); ?>
                </span>
            </div>
        </div>
        <div class="form-item">
            <label class="label"><?php echo Yii::t('main', 'Краткое описание'); ?> <span>*</span></label>
            <div class="item-wrap">
                <?php echo $form->textArea($model, $description, array('row' => 10)); ?>
                <span class="error-block">
                    <?php echo $form->error($model, $description, array('class' => 'error')); ?>
                </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="item-wrap">
            <?php
                $this->widget('ext.EAjaxUpload.EAjaxUpload',
                        array(
                            'id' => 'uploadPhoto',
                            'config' => array(
                                'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/upload'),
                                'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                                'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                                'multiple' => true,
                                'template' => '
                                    <div class="qq-uploader">
                                        <div class="qq-upload-drop-area"></span></div>
                                        <div class="qq-upload-button">
                                        <a href="javascript:void(0)" class="add-photo"><i class="icon-photo"></i> ' . Yii::t('main', 'Загрузить фотографий (не более трех)') . ' <span>*</span></a>
                                        </div>
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
                                                                "<div class=\"add-photo-item delClass\" data-filename=\"" + responseJSON.filename + "\">" +
                                                                    "<img class=\"delClass\" src=\"/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "\" width=\"195\" height=\"170\" data-filename=\"" + responseJSON.filename + "\" />" +
                                                                     "<a id=\"image_" + responseJSON.filename + "\" href=\"javascript:void(0)\" onclick=\"photo.deletePreviewUpload(this);\" rel=\"" + responseJSON.filename + "\" class=\"remove-photo\"><i></i> ' . Yii::t('main', 'Удалить') . '</a>" +
                                                                "</div>"
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
            <span class="error-block">
                <?php echo $form->error($model, 'images', array('class' => 'error')); ?>
            </span>
        </div>

        <div id="uploadPhoto" class="add-photo-wrap">
            <?php if (count(Yii::app()->session['images'])): ?>
                <?php $images = Yii::app()->session['images'] ?>
                <?php foreach ($images as $image): ?>
                    <div class="add-photo-item delClass" data-filename="<?php echo $image; ?>">
                        <img src="/<?php echo Yii::app()->params['admin']['files']['tmp'] . $image; ?>" width="195" height="170" />
                        <a id="image_<?php echo $image; ?>" href="javascript:void(0);" onclick="photo.deletePreviewUpload(this);" rel="<?php echo $image; ?>" class="remove-photo"><i></i> <?php echo Yii::t('main', 'Удалить'); ?></a>
                        <input name="Photos[]" type="hidden" value="<?php echo $image; ?>" />
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="line"></div>
        <div class="center">
            <?if(CCaptcha::checkRequirements()):?>
                <?php $this->widget('CCaptcha', array('buttonLabel' => Yii::t('main', 'Обновить'))); ?>
            <?endif?>
            <div class="form-item" style="margin-top: 0;">
                <label class="label block"><?php echo Yii::t('main', 'Введите код с картинки'); ?> <span>*</span></label>
                <div class="item-wrap">
                    <?php echo $form->textField($model, 'verifyCode', array('class' => 'small')); ?>
                    <span class="error-block">
                        <?php echo $form->error($model, 'verifyCode', array('class' => 'error')); ?>
                    </span>
                </div>
            </div>
            <div class="line"></div>

            <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), array('class' => 'add-object')); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- .container-->
<div class="left-sidebar"></div><!-- .left-sidebar -->
<input id="deleteUrl" type="hidden" value="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/deletePreviewUpload') ?>" />

