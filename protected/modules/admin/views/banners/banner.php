<?php
/** @var Banners $bannerModel */
/** @var Categories[] $categories */
?>

<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id'=>'addBannerForm',
        'type'=>'horizontal',
        'htmlOptions' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'clientOptions' => [
            'validateOnSubmit' => false,
            'validateOnChange' => false,
        ],
        'focus' => ($bannerModel->hasErrors()) ? '.error:first' : [$bannerModel, 'title'],
    ]); ?>

    <div class="row" style="margin-bottom: 30px;">
        <?php
        $bannerPhoto = '';
        $namePhoto = '';
        if (isset(Yii::app()->session['bannerImage'])) {
            $namePhoto = Yii::app()->session['bannerImage'];
            $bannerPhoto = '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['bannerImage'] . '?r=' . rand(0, 10000);
        } elseif (!empty($bannerModel->photo)) {
            $namePhoto = $bannerModel->photo;
            $bannerPhoto = '/' . Yii::app()->params['admin']['files']['banners'] . $bannerModel->photo . '?r=' . rand(0, 10000);
        }
        ?>

        <label class="control-label required" style="width: auto"><?php echo Yii::t('main', 'Изображение баннера (верхние - 190х80, правые - 167х120))') ?> <span class="required">*</span></label>
        <br/><br/>
        <img style="width: 190px; height: 80px" id="itemPhotoUp" alt="" src="<?php echo $bannerPhoto; ?>" style="margin-bottom: 20px;margin-top: 20px;" />
        <img style="width: 167px; height: 120px" id="itemPhotoRight" alt="" src="<?php echo $bannerPhoto; ?>" style="margin: 20px 0 20px 20px;" />
        <input id="uploadInputPhoto" name="Banners[photo]" type="hidden" value="<?php echo $namePhoto; ?>"/>
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUpload', [
                'id' => 'uploadAvatar',
                'config' => [
                    'action' => Yii::app()->createUrl('/admin/banners/upload'),
                    'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                    'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                    'multiple' => false,
                    'template' => '
                        <div class="qq-uploader">
                            <div class="qq-upload-drop-area"></span></div>
                            <div class="qq-upload-button btn" style="width: 170px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить изображение</a></div>
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
                                            $("#itemPhotoUp").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                            $("#itemPhotoRight").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                            $("#uploadInputPhoto").val(responseJSON.filename);
                                        }
                                    }'
                ]
            ]
        );
        ?>
    </div>
    <div class="row">
        <?php echo $form->error($bannerModel, 'photo'); ?>
    </div>

    <div class="row">
        <?php echo $form->textFieldRow($bannerModel, 'title', [
                'style' => 'width:90%'
            ]); ?>
        <?php echo $form->dropDownListRow($bannerModel, 'categoriesStore', $categories, ['multiple'=>true, 'size' => 10, 'options' => $bannerModel->getCategoriesSelected()]); ?>
        <?php echo $form->dropDownListRow($bannerModel, 'is_showing', $bannerModel->getStatuses(), ['empty' => 'Выберите статус']); ?>
        <?php echo $form->dropDownListRow($bannerModel, 'is_right_column', $bannerModel->getPositions(), ['empty' => 'Выберите позицию']); ?>
        <?php echo $form->textFieldRow($bannerModel, 'counter', []); ?>
        <label class="control-label required" style="width: auto"><?php echo Yii::t('main', 'Порядок расположения - числа от 1 до бесконечности. Указывает в каком порядке будут выводиться банеры вверху слева направо. Чем число меньше тем левее') ?> <span class="required">*</span></label>
        <br/><br/>
        <?php echo $form->textFieldRow($bannerModel, 'orderby', []); ?>
    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'submit', 'type'=>'primary', 'label'=>$bannerModel->isNewRecord ? 'Добавить' : 'Сохранить']); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'link', 'url' => '/admin/banners', 'label'=>'Отмена']); ?>
    </div>

<?php $this->endWidget(); ?>