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

<div class="large-12 columns navigation-top">
    <p><a href="/"><?php echo Yii::t('main', 'Главная') ?></a> > <?php echo Yii::t('main', 'Добавить объект'); ?> </p>
    <hr>
</div>
<div class="large-12 columns">
<div class="row collapse">

<div class="large-10 small-12 columns left-sector-add-object">
    <div class="row collapse">
        <div class="large-12 columns add-information">
            <?php $this->renderPartial('partials/_addDescription_' . Yii::app()->getLanguage()); ?>
            <hr>
        </div>
        <?php $form = $this->beginWidget(
            'CActiveForm',
            [
                'id' => 'place-model-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => ['enctype' => 'multipart/form-data'],
            ]
        ); ?>
        <div class="row collapse">
                <div class="row collapse">
                    <div class="large-3 columns"><p><?php echo Yii::t('main', 'Название'); ?> <span>*</span></p></div>
                    <div class="large-9 columns name-field">
                        <?php echo $form->textField($model, $title, []); ?>
                        <?php echo $form->error($model, $title, ['class' => 'error']); ?>
                    </div>
                </div>

                <div class="row collapse">
                    <div class="large-3 columns"><p><?php echo Yii::t('main', 'Район'); ?> <span>*</span></p></div>
                    <div class="large-9 columns name-field">
                        <?php echo $form->dropDownList($model, 'district_id', $districts, []); ?>
                        <?php echo $form->error($model, 'district_id', ['class' => 'error']); ?>
                    </div>
                </div>

                <div class="row collapse">
                    <div class="large-3 columns"><p><?php echo Yii::t('main', 'Адрес'); ?> <span>*</span></p></div>
                    <div class="large-9 columns name-field">
                        <?php echo $form->textField($model, $address, []); ?>
                        <?php echo $form->error($model, $address, ['class' => 'error']); ?>
                    </div>
                </div>

                <div class="row collapse">
                    <div class="large-3 columns"><p><?php echo Yii::t('main', 'Краткое описание'); ?> <span>*</span></p></div>
                    <div class="large-9 columns name-field">
                        <?php echo $form->textArea($model, $description, ['row' => 10]); ?>
                        <?php echo $form->error($model, $description, ['class' => 'error']); ?>
                    </div>
                </div>

            </form>

            <hr>

        </div>
        <div class="large-12 columns added-images">
            <?php
            $this->widget(
                'ext.EAjaxUpload.EAjaxUpload',
                [
                    'id' => 'uploadPhoto',
                    'config' => [
                        'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/upload'),
                        'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                        'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                        'multiple' => true,
                        'template' => '
                                    <div class="qq-uploader">
                                        <div class="qq-upload-drop-area"></span></div>
                                        <div class="qq-upload-button">
                                        <input type="submit" value="' . Yii::t(
                                            'main',
                                            'Загрузить фотографии (не более трех)'
                                        ) . '" class="add-foto-btn">
                                        </div>
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
                                                        $("#uploadPhoto").append(
                                                                "<div class=\"add-photo-item delClass\" data-filename=\"" + responseJSON.filename + "\">" +
                                                                    "<img class=\"delClass\" src=\"/' . Yii::app(
                            )->params['admin']['files']['tmp'] . '" + responseJSON.filename + "\" width=\"195\" height=\"170\" data-filename=\"" + responseJSON.filename + "\" />" +
                                                                     "<a id=\"image_" + responseJSON.filename + "\" href=\"javascript:void(0)\" onclick=\"photo.deletePreviewUpload(this);\" rel=\"" + responseJSON.filename + "\" class=\"remove-photo\"><i></i> ' . Yii::t(
                                'main',
                                'Удалить'
                            ) . '</a>" +
                                                                "</div>"
                                                            );

                                                        $("#uploadPhoto").append(
                                                                 "<input name=\"Photos[]\" type=\"hidden\" value=\"" + responseJSON.filename + "\" data-filename=\"" + responseJSON.filename + "\" class=\"delClass\"/>"
                                                            );

                                                        $("#errorPhotos").html("");
                                                    }
                                                }'
                    ]
                ]
            );
            ?>

            <div class="row collapse">
                <div class="large-3 small-6 columns">
                    <div class="object-img-box"><!-- Image Add --></div>
                    <p><a href="#"><img src="img/delete.png"> Удалить</a></p>
                </div>
                <div class="large-3 small-6 columns">
                    <div class="object-img-box"><!-- Image Add --></div>
                    <p><a href="#"><img src="img/delete.png"> Удалить</a></p>
                </div>
                <div class="large-3 small-6 columns">
                    <div class="object-img-box"><!-- Image Add --></div>
                    <p><a href="#"><img src="img/delete.png"> Удалить</a></p>
                </div>
                <div class="large-3 small-6 columns">
                    <div class="object-img-box"><!-- Image Add --></div>
                    <p><a href="#"><img src="img/delete.png"> Удалить</a></p>
                </div>
            </div>
            <hr>
        </div>
        <div class="row capcha-block">
            <div class="large-12 columns">
                <div class="small-12 columns"><img src="img/capcha.png"></div>
                <br><br>
                    <div class="name-field">
                        <p>Введите код с картинки <span>*</span></p>
                        <input type="text" required pattern="[a-zA-Z]+" required pattern="[а-яА-Я]+">
                        <label class="error">Ошибка</label>
                    </div>
                <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), ['class' => 'button']); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<?php echo $this->renderPartial('/partials/_previewNews'); ?>


</div>
</div>
<input id="deleteUrl" type="hidden"
       value="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/deletePreviewUpload') ?>"/>





        <span class="error-block">
                <?php echo $form->error($model, 'images', array('class' => 'error', 'id' => 'errorPhotos')); ?>
            </span>
    </div>

    <div id="uploadPhoto" class="add-photo-wrap">
        <?php if (count(Yii::app()->session['images'])): ?>
            <?php $images = Yii::app()->session['images'] ?>
            <?php foreach ($images as $image): ?>
                <div class="add-photo-item delClass" data-filename="<?php echo $image; ?>">
                    <img src="/<?php echo Yii::app()->params['admin']['files']['tmp'] . $image; ?>" width="195"
                         height="170"/>
                    <a id="image_<?php echo $image; ?>" href="javascript:void(0);"
                       onclick="photo.deletePreviewUpload(this);" rel="<?php echo $image; ?>"
                       class="remove-photo"><i></i> <?php echo Yii::t('main', 'Удалить'); ?></a>
                    <input name="Photos[]" type="hidden" value="<?php echo $image; ?>"/>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="line"></div>
    <div class="center">
        <? if (CCaptcha::checkRequirements()): ?>
            <?php $this->widget('CCaptcha', array('buttonLabel' => Yii::t('main', 'Обновить'))); ?>
        <? endif ?>
        <div class="form-item" style="margin-top: 0;">
            <label class="label block"><?php echo Yii::t('main', 'Введите код с картинки'); ?> <span>*</span></label>

            <div class="item-wrap" style="display: inline-block;">
                <?php echo $form->textField($model, 'verifyCode', array('class' => 'small')); ?>
                <span class="error-block">
                        <?php echo $form->error($model, 'verifyCode', array('class' => 'error')); ?>
                    </span>
            </div>
        </div>
        <div class="line"></div>

    </div>