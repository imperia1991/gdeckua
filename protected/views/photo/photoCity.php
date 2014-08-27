<?php
/** @var PhotoCity $photoCityModel */
?>

<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Добавить фотографию')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 small-12 medium-9 columns left-sector-add-foto">
            <div class="row collapse">
                <div class="large-12 columns add-information">
                    <p><?php echo Yii::t('main', 'Вы можете добавлять только по одной фотографии'); ?></p>
                    <hr>
                </div>
                <?php $form = $this->beginWidget(
                    'CActiveForm',
                    [
                        'id' => 'photoCity-model-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => ['enctype' => 'multipart/form-data'],
                    ]
                ); ?>
                <div class="row collapse">

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Название') ?>: <span>*</span></p></div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($photoCityModel, 'title', []); ?>
                                <?php echo $form->error($photoCityModel, 'title', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <div class="row collapse">
                            <div class="large-3 columns"><p><?php echo Yii::t('main', 'Автор') ?>: <span>*</span></p></div>
                            <div class="large-9 columns name-field">
                                <?php echo $form->textField($photoCityModel, 'author', []); ?>
                                <?php echo $form->error($photoCityModel, 'author', ['class' => 'error']); ?>
                            </div>
                        </div>

                        <hr>

                </div>

                <div class="row collapse">
                    <div class="large-7 columns added-images">

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
                                        <div class="qq-uploader" style="float:none">
                                            <div class="qq-upload-drop-area"></span></div>
                                            <div class="qq-upload-button">
                                            <input type="submit" class="add-foto-btn" value="' . Yii::t(
                                            'main',
                                            'Загрузить фото'
                                        ) . '" />
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
                                                            $("#photoCity").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                                            $("#uploadInputPhotoCity").val(responseJSON.filename);
                                                        }
                                                    }'
                                ]
                            ]
                        );
                        ?>
                        <?php echo $form->error($photoCityModel, 'photo', ['class' => 'error']); ?>
                        <?php
                        $photoCity = isset(Yii::app()->session['photoCity'])
                            ? '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['photoCity']
                            : (!empty($photoCityModel->photo) ? Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo : '');
                        $photoCityName = isset(Yii::app()->session['photoCity']) ? Yii::app()->session['photoCity'] : $photoCityModel->photo;
                        ?>
                        <div class="row collapse">
                            <div class="large-3 small-6 columns">
                                <div class="object-img-box">
                                    <img id="photoCity" <?php if ($photoCity): ?> src="<?php echo $photoCity; ?>" <?php endif; ?> />
                                    <input id="uploadInputPhotoCity" name="PhotoCity[photo]" type="hidden" value="<?php echo $photoCityName; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="large-5 columns capcha-block">
                        <div class="row">

                            <div>
                                <? if (CCaptcha::checkRequirements()): ?>
                                    <?php $this->widget(
                                        'CCaptcha',
                                        [
                                            'buttonLabel' => Yii::t('main', 'Обновить'),
                                            'showRefreshButton' => true,
                                            'buttonOptions' => [
                                                'class' => 'add-object-captcha-button'
                                            ],
//                                    'buttonType' => 'button',
                                            'clickableImage' => true
                                        ]
                                    ); ?>
                                <? endif ?>
                            </div>

                            <div class="name-field">
                                <p><?php echo Yii::t('main', 'Введите код с картинки'); ?> <span>*</span></p>
                                <?php echo $form->textField($photoCityModel, 'verifyCode', []); ?>
                                <label class="error"><?php echo $form->error(
                                        $photoCityModel,
                                        'verifyCode',
                                        ['class' => 'error']
                                    ); ?></label>
                            </div>

                            <?php echo CHtml::submitButton(Yii::t('main', 'Добавить фотографию'), ['class' => 'button']); ?>

                        </div>
                    </div>
                </div>
                <?php $this->endWidget('photoCity-model-form'); ?>
                <hr>

            </div>
        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>

    </div>
</div>