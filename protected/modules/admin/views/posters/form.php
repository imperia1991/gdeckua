<?php
/** @var Posters $posterModel */
/** @var CategoryNews[] $categories */

Yii::app()->clientScript->registerScriptFile('/js/jquery-migrate-1.2.1.js', CClientScript::POS_BEGIN);
?>

<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id'                     => 'addPosterForm',
    'type'                   => 'horizontal',
    'htmlOptions'            => ['enctype' => 'multipart/form-data'],
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false,
    'clientOptions'          => [
        'validateOnSubmit' => false,
        'validateOnChange' => false,
    ],
    'focus'                  => ($posterModel->hasErrors()) ? '.error:first' : [$posterModel, 'title'],
]); ?>

    <div class="row">
        <?php
        $posterPhoto = '';
        $namePhoto   = '';
        if (isset(Yii::app()->session['posterImage'])) {
            $namePhoto   = Yii::app()->session['posterImage'];
            $posterPhoto = '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['posterImage'] . '?r=' . rand(0, 10000);
        } elseif ( !empty($posterModel->photo)) {
            $namePhoto   = $posterModel->photo;
            $posterPhoto = '/' . Yii::app()->params['admin']['files']['photoPoster'] . $posterModel->photo . '?r=' . rand(0, 10000);
        }
        ?>

        <label class="control-label required"
               style="width: auto"><?php echo Yii::t('main', 'Фото для афишы (Фото желательно 491х340, иначе оно будет мутным)') ?>
            <span class="required">*</span></label>
        <br/><br/>
        <img id="itemPhoto"
         width="71"
         height="60"
        alt=""
        src="<?php echo $posterPhoto; ?>"
        style="margin-bottom: 20px;margin-top: 20px;"/>
        <input id="uploadInputPhoto" name="Posters[photo]" type="hidden" value="<?php echo $namePhoto; ?>"/>
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUpload', [
                'id'     => 'uploadAvatar',
                'config' => [
                    'action'            => Yii::app()->createUrl('/admin/posters/upload'),
                    'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                    'sizeLimit'         => Yii::app()->params['admin']['images']['sizeLimit'],
                    'multiple'          => false,
                    'template'          => '
                                                    <div class="qq-uploader">
                                                        <div class="qq-upload-drop-area"></span></div>
                                                        <div class="qq-upload-button btn" style="width: 170px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить фотографию</a></div>
                                                        <span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
                                                        <ul class="qq-upload-list" style="display: none;"></ul>
                                                    </div>',
                    'messages'          => [
                        'typeError'    => "{file} имеет недопустимый формат. Допустимые форматы: {extensions}.",
                        'sizeError'    => "{file} имеет слишком большой объём, максимальный объём файла – {sizeLimit}.",
                        'minSizeError' => "{file} имеет слишком маленький объём, минимальный объём файла – {minSizeLimit}.",
                        'emptyError'   => "{file} пуст, пожалуйста, выберите другой файл.",
                        'noFilesError' => "Файлы для загрузки не выбраны.",
                        'onLeave'      => "В данный момент идёт загрузка файлов, если вы покинете страницу, загрузка будет отменена."
                    ],
                    'text'              => [
                        'failUpload'         => 'загрузка не удалась',
                        'dragZone'           => 'Перетащите файл для загрузки',
                        'cancelButton'       => 'Отмена',
                        'waitingForResponse' => 'Обработка...'
                    ],
                    'onComplete'        => 'js:function(id, fileName, responseJSON){
                                    if (responseJSON.success)
                                    {
                                        $("#itemPhoto").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                        $("#uploadInputPhoto").val(responseJSON.filename);
                                    }
                                }'
                ]
            ]
        );
        ?>

        <!-- Begin optional preview box -->
        <div id="preview" style="position:relative; overflow:hidden; width:217px; height:130px; margin-top: 10px; margin-bottom: 10px;">
            <img id="avatar-preview"
                 src="<?php echo $posterPhoto ?>"
                 style="width: 0px; height: 0px; margin-left: 0px; margin-top: 0px;">
        </div>
    </div>
    <div class="row">
        <?php echo $form->error($posterModel, 'photo'); ?>
    </div>

    <div class="row" style="margin-top: 30px;">
        <?php echo $form->dropDownListRow($posterModel, 'category_poster_id', $categories, ['empty' => 'Выберите категорию']); ?>
        <?php echo $form->textFieldRow($posterModel, 'title', [
            'style' => 'width:90%'
        ]); ?>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <?php echo CHtml::activeHiddenField($posterModel, 'place_id', [
            'value' => $posterModel->place_id ?: ''
        ]); ?>
        <?php echo $form->label($posterModel, 'place_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', [
            'model'       => $posterModel,   // модель
            'attribute'   => 'placeTitle',  // атрибут модели
            // "источник" данных для выборки
            'source'      => Yii::app()->createUrl('/admin/posters/autocomplete'),
            // параметры, подробнее можно посмотреть на сайте
            // http://jqueryui.com/demos/autocomplete/
            'options'     => [
                'minLength' => '2',
                'showAnim'  => 'fold',
                'select'    => 'js: function(event, ui) {
                    this.value = ui.item.value;
                    // записываем полученный id в скрытое поле
                    $("#Posters_place_id").val(ui.item.id);
                    return false;
            }',
            ],
            'htmlOptions' => [
                'style' => 'width:50%',
                'value' => $posterModel->getPlaceTitle()
            ],
        ]);
        ?>
    </div>

    <div class="row">
        <label>Показ (если дата одна достаточно её указать в поле "с")</label>
        c <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', [
            'name'        => 'Posters[date_from]',
            // additional javascript options for the date picker plugin
            'options'     => [
                'showAnim' => 'fold',
            ],
            'htmlOptions' => [
                'style' => 'height:20px;'
            ],
            'language'    => 'ru',
            'value'       => Yii::app()->dateFormatter->format('dd.MM.yyyy', $posterModel->date_from)
        ]);
        ?>

        по <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', [
            'name'        => 'Posters[date_to]',
            // additional javascript options for the date picker plugin
            'options'     => [
                'showAnim' => 'fold',
            ],
            'htmlOptions' => [
                'style' => 'height:20px;'
            ],
            'language'    => 'ru',
            'value'       => Yii::app()->dateFormatter->format('dd.MM.yyyy', $posterModel->date_to)
        ]);
        ?>
        <!--    --><?php //echo $form->textFieldRow($posterModel, 'date_from', []); ?>
        <!--    --><?php //echo $form->textFieldRow($posterModel, 'date_to', []); ?>
    </div>
    <div class="row" style="margin-top: 30px;">
        <?php echo $form->error($posterModel, 'description'); ?>
        <?php
        $this->widget('ext.tinymce.TinyMce', [
            'model'           => $posterModel,
            'attribute'       => 'description',
            // Optional config
            'compressorRoute' => '/admin/tinyMce/compressor',
//									'spellcheckerUrl' => array('/admin/tinyMce/spellchecker'),
            // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'fileManager'     => [
                'class'          => 'ext.elFinder.TinyMceElFinder',
                'connectorRoute' => '/admin/elfinder/connector',
            ],
            'htmlOptions'     => [
                'rows' => 30,
//										'cols' => 60,
            ],
            'settings'        => [
                'language' => 'ru'
            ]
        ]);
        ?>
    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => $posterModel->isNewRecord ? 'Добавить' : 'Сохранить'
        ]); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', [
            'buttonType' => 'link',
            'url'        => '/admin/posters',
            'label'      => 'Отмена'
        ]); ?>
    </div>

<?php $this->endWidget(); ?>