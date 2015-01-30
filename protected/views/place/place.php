<?php
/** @var Places $model */
/** @var Contacts $modelContacts */

Yii::app()->clientScript->registerScriptFile('/js/mainPlace.js', CClientScript::POS_BEGIN);
?>

<?php
$title = 'title_' . Yii::app()->getLanguage();
$district = 'district_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$shortDescription = 'short_description_' . Yii::app()->getLanguage();

?>

<?php
$this->pageTitle = Yii::t('main', 'Добавление места');

$this->breadcrumbs = [
    '' => Yii::t('main', 'Добавление места')
];

$errors = $model->getErrors();
?>

<div class="page_content form_page clearfix">
    <div class="add_object">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            [
                'id'                   => 'place-model-form',
                'enableAjaxValidation' => false,
                'htmlOptions'          => [ 'enctype' => 'multipart/form-data' ],
            ]
        ); ?>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t( 'main', 'Название' ); ?> <span class="nes">*</span>
            </div>
            <div class="input_wrap ">
                <?php echo $form->textField( $model, $title, [
                    'class' => 'input'
                ] ); ?>
                <?php if ( isset( $errors[$title] )): ?>
                    <span class="input_error"><?php echo $errors[$title][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Район'); ?> <span class="nes">*</span>
            </div>
            <div class="input_wrap">
                <div class="select">
                    <a href="javascript:void(0);" class="slct"></a>
                    <ul id="district" class="drop">
                        <?php /**@var Districts $district */ ?>
                        <?php $title = 'title_' . Yii::app()->getLanguage(); ?>
                        <?php foreach ($districts as $id => $district): ?>
                            <li><a href="<?php echo $id; ?>"><?php echo $district; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <input id="districts" type="hidden" name="Places[district_id]" value="<?php echo is_object($model) ? $model->district_id : ''; ?>" />
                </div>
                <?php if ( isset( $errors['district_id'] )): ?>
                    <span class="input_error"><?php echo $errors['district_id'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Адрес'); ?> <span class="nes">*</span>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($model, $address, [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors[$address] )): ?>
                    <span class="input_error"><?php echo $errors[$address][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Краткое описание'); ?> <span class="nes">*</span>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($model, $shortDescription, [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors[$shortDescription] )): ?>
                    <span class="input_error"><?php echo $errors[$shortDescription][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Описание'); ?> <span class="nes">*</span>
            </div>
            <div class="input_wrap">
                <?php echo $form->textArea($model, $description, [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors[$description] )): ?>
                    <span class="input_error"><?php echo $errors[$description][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Телефон городской'); ?>
            </div>
            <div class="input_wrap">
                <?php
                $this->widget('CMaskedTextField', [
                    'model' => $modelContacts,
                    'attribute' => 'phone_city',
                    'mask' => '99 99 99',
                    'placeholder' => '*',
                    'htmlOptions' => [
                        'class' => 'input'
                    ]
                ]);
                ?>
                <?php if ( isset( $errors['phone_city'] )): ?>
                    <span class="input_error"><?php echo $errors['phone_city'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Телефон мобильный'); ?>
            </div>
            <div class="input_wrap">
                <?php
                $this->widget('CMaskedTextField', [
                    'model' => $modelContacts,
                    'attribute' => 'phone_mobile1',
                    'mask' => '999 999 9999',
                    'placeholder' => '*',
                    'htmlOptions' => [
                        'class' => 'input'
                    ]
                ]);
                ?>
                <?php if ( isset( $errors['phone_mobile1'] )): ?>
                    <span class="input_error"><?php echo $errors['phone_mobile1'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Телефон мобильный (дополнительный)'); ?>
            </div>
            <div class="input_wrap">
                <?php
                $this->widget('CMaskedTextField', [
                    'model' => $modelContacts,
                    'attribute' => 'phone_mobile2',
                    'mask' => '999 999 9999',
                    'placeholder' => '*',
                    'htmlOptions' => [
                        'class' => 'input'
                    ]
                ]);
                ?>
                <?php if ( isset( $errors['phone_mobile2'] )): ?>
                    <span class="input_error"><?php echo $errors['phone_mobile2'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Телефон мобильный (дополнительный)'); ?>
            </div>
            <div class="input_wrap">
                <?php
                $this->widget('CMaskedTextField', [
                    'model' => $modelContacts,
                    'attribute' => 'phone_mobile3',
                    'mask' => '999 999 9999',
                    'placeholder' => '*',
                    'htmlOptions' => [
                        'class' => 'input'
                    ]
                ]);
                ?>
                <?php if ( isset( $errors['phone_mobile3'] )): ?>
                    <span class="input_error"><?php echo $errors['phone_mobile3'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Факс'); ?>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($modelContacts, 'phax', [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors['phax'] )): ?>
                    <span class="input_error"><?php echo $errors['phax'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'E-mail'); ?>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($modelContacts, 'email', [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors['email'] )): ?>
                    <span class="input_error"><?php echo $errors['email'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Скайп'); ?>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($modelContacts, 'skype', [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors['skype'] )): ?>
                    <span class="input_error"><?php echo $errors['skype'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Время работы'); ?>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($modelContacts, 'operation_time', [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors['operation_time'] )): ?>
                    <span class="input_error"><?php echo $errors['operation_time'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap">
            <div class="form_input_label">
                <?php echo Yii::t('main', 'Сайт'); ?>
            </div>
            <div class="input_wrap">
                <?php echo $form->textField($modelContacts, 'site', [
                    'class' => 'input'
                ]); ?>
                <?php if ( isset( $errors['site'] )): ?>
                    <span class="input_error"><?php echo $errors['site'][0]; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form_input_wrap photos">
            <?php
            $template = $this->renderPartial('partials/_uploadPhotoTemplate', [], true);
            $this->widget(
                'ext.EAjaxUpload.EAjaxUpload',
                [
                    'id' => 'uploadPhoto',
                    'config' => [
                        'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place/upload'),
                        'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                        'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                        'multiple' => true,
                        'template' => $template,
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
                                                                    "<div class=\"input_wrap delClass\" data-filename=\"" + responseJSON.filename + "\">" +
                                                                        "<div class=\"object-img-box\"><img class=\"delClass\" src=\"/' . Yii::app(
                            )->params['admin']['files']['tmp'] . '" + responseJSON.filename + "\" width=\"100\" height=\"90\" data-filename=\"" + responseJSON.filename + "\" /></div>" +
                                                                         "<a id=\"image_" + responseJSON.filename + "\" href=\"javascript:void(0)\" onclick=\"photo.deletePreviewUpload(this);\" rel=\"" + responseJSON.filename + "\" class=\"remove-photo\"><img src=\"/img/delete.png\"> ' . Yii::t(
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
            <?php if (isset($errors['images'])): ?>
                <span class="error" id="errorPhotos"><?php echo $errors['images'][0]; ?></span>
            <?php endif; ?>
        </div>
        <div class="form_input_bottom clearfix">
            <div class="captcha_block">
                <div class="captcha_image">
                    <? if ( CCaptcha::checkRequirements() ): ?>
                        <?php $this->widget( 'CCaptcha', [
                            'buttonLabel'       => Yii::t( 'main', 'Обновить' ),
                            'showRefreshButton' => true,
                            'buttonOptions'     => [
                                'class' => 'captcha_refresh'
                            ],
                            'clickableImage'    => true
                        ] ); ?>
                    <? endif ?>
                </div>
                <?php echo $form->textField( $model, 'verifyCode', [
                    'class'       => 'input captcha_input',
                    'placeholder' => Yii::t( 'main', 'Введите код' ) . ' *'
                ] ); ?>
                <?php if (isset($errors['verifyCode'])): ?>
                    <span class="error"><?php echo $errors['verifyCode'][0]; ?></span>
                <?php endif; ?>
            </div>
            <input type="submit" value="Добавить" class="submit">
        </div>
        <?php $this->endWidget( 'place-model-form' ); ?>
    </div>

</div>

<script type="text/javascript">
    $('.slct').html($('#district a[href=' + <?php echo is_object($model) ? $model->district_id : ''; ?> + ']').html());
</script>



