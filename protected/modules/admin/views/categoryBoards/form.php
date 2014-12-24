<?php
/** @var CategoryBoards $categoryModel */
$tree = $categoryModel->getTree();
?>

<div class="row">
    <h4>Добавление категории объявления</h4>
</div>
<div class="row">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'id' => 'addCategoryBoardForm',
//            'type' => 'inline',
            'htmlOptions' => ['class' => 'well'],
        ]
    ); ?>

    <?php echo $form->textFieldRow($categoryModel, 'title_ru', ['style' => 'margin-bottom:0']); ?>
    <?php echo $form->textFieldRow($categoryModel, 'title_uk', ['style' => 'margin-bottom:0']); ?>
</div>
<div class="row" style="margin-top: 30px;">
    <?php
    $newsPhoto = '';
    $namePhoto = '';
    if (isset(Yii::app()->session['categoryBoardsImage'])) {
        $namePhoto = Yii::app()->session['categoryBoardsImage'];
        $newsPhoto = '/' . Yii::app()->params['admin']['files']['tmp'] . Yii::app()->session['categoryBoardsImage'] . '?r=' . rand(0, 10000);
    } elseif (!empty($categoryModel->photo)) {
        $namePhoto = $categoryModel->photo;
        $newsPhoto = '/' . Yii::app()->params['admin']['files']['news'] . $categoryModel->photo . '?r=' . rand(0, 10000);
    }
    ?>

    <label class="control-label required" style="width: auto"><?php echo Yii::t(
            'main',
            'Иконка для категории'
        ) ?> <span class="required">*</span></label>
    <br/><br/>
    <img id="itemPhoto" alt="" src="<?php echo $newsPhoto; ?>" style="margin-bottom: 20px;margin-top: 20px;"/>
    <input id="uploadInputPhoto" name="CategoryBoards[photo]" type="hidden" value="<?php echo $namePhoto; ?>"/>
    <?php
    $this->widget(
        'ext.EAjaxUpload.EAjaxUpload',
        [
            'id' => 'uploadAvatar',
            'config' => [
                'action' => Yii::app()->createUrl('/admin/categoryBoards/upload'),
                'allowedExtensions' => Yii::app()->params['admin']['images']['allowedExtensions'],
                'sizeLimit' => Yii::app()->params['admin']['images']['sizeLimit'],
                'multiple' => false,
                'template' => '
														<div class="qq-uploader">
															<div class="qq-upload-drop-area"></span></div>
															<div class="qq-upload-button btn" style="width: 170px;"><a href="javascript:void(0)" class="buttonL bGreyish">Загрузить иконку</a></div>
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
                                            $("#itemPhoto").attr("src","/' . Yii::app()->params['admin']['files']['tmp'] . '" + responseJSON.filename + "");
                                            $("#uploadInputPhoto").val(responseJSON.filename);
                                        }
                                    }'
            ]
        ]
    );
    ?>
</div>
<div class="row">
    <?php echo $form->error($categoryModel, 'photo'); ?>
</div>
<div class="row" style="margin-top: 30px;">
    <?php if (!empty($tree)): ?>
        <label>Выберите родительскую категорию</label><br/>
        <?php // http://wwwendt.de/tech/dynatree/doc/dynatree-doc.html#nodeOptions ?>
        <?php $this->widget(
            'ext.dynatree.DynaTree',
            [
                'attribute' => CHtml::activeName($categoryModel, 'parent_id'),
                'data' => $tree,
                'selection' => [$categoryModel->parent_id],
                'options' => [
                    'selectMode' => 1,
                    'minExpandLevel' => 3,
                    'autoCollapse' => true,
                    'noLink' => true
                ]
            ]
        ); ?>
        <br/><br/>
    <?php endif; ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'submit', 'type' => 'primary', 'label' => $categoryModel->isNewRecord ? 'Добавить' : 'Сохранить']
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        ['buttonType' => 'link', 'label' => 'Отмена', 'url' => Yii::app()->createUrl('/admin/categoryBoards')]
    ); ?>

    <?php $this->endWidget(); ?>
</div>
