<?php
/** @var PhotoCity $photoCityModel */
?>

<?php
$this->pageTitle = Yii::t('main', 'Добавить фотографию');

$this->breadcrumbs = [
    '' => Yii::t('main', 'Добавить фотографию')
];
?>

<div class="page_content form_page clearfix">
    <div class="add_photo_text"><?php echo Yii::t('main', 'Вы можете добавлять только по одной фотографии'); ?></div>
    <div class="add_object">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            [
                'id' => 'photoCity-model-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => ['enctype' => 'multipart/form-data'],
            ]
        );

        $errors = $photoCityModel->getErrors();
        ?>
            <div class="form_input_wrap">
                <div class="form_input_label">
                    <?php echo Yii::t('main', 'Название') ?> <span class="nes">*</span>
                </div>
                <div class="input_wrap ">
                    <?php echo $form->textField($photoCityModel, 'title', [
                        'class' => 'input'
                    ]); ?>

                    <?php if (isset($errors['title'])): ?>
                        <span class="input_error"><?php echo $errors['title'][0]; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form_input_wrap">
                <div class="form_input_label">
                    <?php echo Yii::t('main', 'Автор') ?>   <span class="nes">*</span>
                </div>
                <div class="input_wrap">
                    <?php echo $form->textField($photoCityModel, 'author', [
                        'class' => 'input'
                    ]); ?>

                    <?php if (isset($errors['author'])): ?>
                        <span class="input_error"><?php echo $errors['author'][0]; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="add_photo_block clearfix">
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
                                            <button class="add_photo_button button">
                                            <img src="/images/icons/upload.png"  alt="">
                                            ' . Yii::t('main', 'Загрузить фото' ) . '
                                            </button>
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

                <?php
                $photoCity = isset(Yii::app()->session['photoCity'])
                    ? '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['photoCity']
                    : (!empty($photoCityModel->photo) ? Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo : '');
                $photoCityName = isset(Yii::app()->session['photoCity']) ? Yii::app()->session['photoCity'] : $photoCityModel->photo;
                ?>

                <div class="add_photo_image_wrap">
                    <img id="photoCity" <?php if ($photoCity): ?> src="<?php echo $photoCity; ?>" <?php endif; ?> />
                    <input id="uploadInputPhotoCity" name="PhotoCity[photo]" type="hidden" value="<?php echo $photoCityName; ?>"/>

                    <?php if (isset($errors['photo'])): ?>
                        <span class="input_error photo"><?php echo $errors['photo'][0]; ?></span>
                    <?php endif; ?>
                </div>

            </div>
            <div class="form_input_bottom clearfix">
                <div class="captcha_block">
                    <div class="captcha_image">
                        <? if (CCaptcha::checkRequirements()): ?>
                            <?php $this->widget(
                                'CCaptcha',
                                [
                                    'buttonLabel' => Yii::t('main', 'Обновить'),
                                    'showRefreshButton' => true,
                                    'buttonOptions' => [
                                        'class' => 'captcha_refresh'
                                    ],
                                    'clickableImage' => true
                                ]
                            ); ?>
                        <? endif ?>
                    </div>

                    <?php echo $form->textField($photoCityModel, 'verifyCode', [
                        'class' => 'input captcha_input',
                        'placeholder' => Yii::t('main', 'Введите код с картинки') . ' *'
                    ]); ?>

                    <?php if (isset($errors['verifyCode'])): ?>
                        <span class="input_error photo"><?php echo $errors['verifyCode'][0]; ?></span>
                    <?php endif; ?>
                </div>
                <?php echo CHtml::submitButton(Yii::t('main', 'Добавить'), ['class' => 'submit']); ?>
            </div>
        <?php $this->endWidget('photoCity-model-form'); ?>
    </div>
    <div class="add_photo_bottom">
        <?php $this->renderPartial('/partials/_photoCitySignature_' . Yii::app()->getLanguage()); ?>
    </div>

</div>