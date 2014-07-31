<?php
/** @var News $newsModel */
/** @var CategoryNews[] $categories */

Yii::app()->clientScript->registerScriptFile('/js/jquery-migrate-1.2.1.js', CClientScript::POS_BEGIN);
?>

<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id'=>'addNewsForm',
        'type'=>'horizontal',
        'htmlOptions' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'clientOptions' => [
            'validateOnSubmit' => false,
            'validateOnChange' => false,
        ],
        'focus' => ($newsModel->hasErrors()) ? '.error:first' : [$newsModel, 'title'],
    ]); ?>

<div class="row">
    <?php echo $form->textFieldRow($newsModel, 'title', [
            'style' => 'width:90%'
        ]); ?>
    <?php echo $form->dropDownListRow($newsModel, 'category_news_id', $categories, ['empty' => 'Выберите категорию']); ?>
    <?php echo $form->textFieldRow($newsModel, 'short_text', [
            'style' => 'width:90%'
        ]); ?>
</div>
<div class="row">
    <?php echo $form->error($newsModel, 'text'); ?>
    <?php
    $this->widget('ext.tinymce.TinyMce', [
            'model' => $newsModel,
            'attribute' => 'text',
            // Optional config
            'compressorRoute' => '/admin/tinyMce/compressor',
//									'spellcheckerUrl' => array('/admin/tinyMce/spellchecker'),
            // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'fileManager' => [
                'class' => 'ext.elFinder.TinyMceElFinder',
                'connectorRoute'=>'/admin/elfinder/connector',
            ],
            'htmlOptions' => [
                'rows' => 30,
//										'cols' => 60,
            ],
            'settings' => [
                'language' => 'ru'
            ]
        ]);
    ?>
</div>
<div class="row" style="margin-top: 30px;">
    <?php
    $newsPhoto = '';
    $namePhoto = '';
    if (isset(Yii::app()->session['newsImage'])) {
        $namePhoto = Yii::app()->session['newsImage'];
        $newsPhoto = '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['newsImage'] . '?r=' . rand(0, 10000);
    } elseif (!empty($newsModel->photo)) {
        $namePhoto = $newsModel->photo;
        $newsPhoto = '/' . Yii::app()->params['files']['photos']['news'] . $newsModel->photo . '?r=' . rand(0, 10000);
    }
    ?>

    <label class="control-label required" style="width: auto"><?php echo Yii::t('main', 'Фото для анонса новости') ?> <span class="required">*</span></label><br/>
    <img id="newsPhoto" width="71" height="60" alt="" src="<?php echo $newsPhoto; ?>" style="margin-bottom: 20px;margin-top: 20px; margin-left: -177px;" />
    <input id="uploadInputPhoto" name="News[photo]" type="hidden" value="<?php echo $namePhoto; ?>"/>
    <?php
    $this->widget('ext.EAjaxUpload.EAjaxUpload', [
            'id' => 'uploadAvatar',
            'config' => [
                'action' => Yii::app()->createUrl('/admin/news/upload'),
                'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                'multiple' => false,
                'template' => '
														<div class="qq-uploader">
															<div class="qq-upload-drop-area"></span></div>
															<div class="qq-upload-button btn" style="width: 170px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить фотографию</a></div>
															<span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
															<ul class="qq-upload-list" style="display: none;"></ul>
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
                    'failUpload' => 'загрузка не удалась',
                    'dragZone' => 'Перетащите файл для загрузки',
                    'cancelButton' => 'Отмена',
                    'waitingForResponse' => 'Обработка...'
                ],
                'onComplete' => 'js:function(id, fileName, responseJSON){
                                        if (responseJSON.success)
                                        {
                                            $("#newsPhoto").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                            $("#uploadInputPhoto").val(responseJSON.filename);
                                        }
                                    }'
            ]
        ]
    );
    ?>
</div>
<div class="row">
    <?php echo $form->error($newsModel, 'photo'); ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'submit', 'type'=>'primary', 'label'=>$newsModel->isNewRecord ? 'Добавить' : 'Сохранить']); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/news', 'label'=>'Отмена']); ?>
</div>

<?php $this->endWidget(); ?>