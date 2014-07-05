<?php
/** @var News $newsModel */
/** @var CategoryNews[] $categories */

Yii::app()->clientScript->registerScriptFile('/js/jquery-migrate-1.2.1.js', CClientScript::POS_BEGIN);
?>

<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'addNewsForm',
        'type'=>'horizontal',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => false,
            'validateOnChange' => false,
        ),
        'focus' => ($newsModel->hasErrors()) ? '.error:first' : array($newsModel, 'title'),
    )); ?>

<div class="row">
    <?php echo $form->textFieldRow($newsModel, 'title', array(
            'style' => 'width:90%'
        )); ?>
    <?php echo $form->dropDownListRow($newsModel, 'category_news_id', $categories, array('empty' => 'Выберите категорию')); ?>
</div>
<div class="row">
    <?php echo $form->error($newsModel, 'text'); ?>
    <?php
    $this->widget('ext.tinymce.TinyMce', array(
            'model' => $newsModel,
            'attribute' => 'text',
            // Optional config
            'compressorRoute' => '/admin/tinyMce/compressor',
//									'spellcheckerUrl' => array('/admin/tinyMce/spellchecker'),
            // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'fileManager' => array(
                'class' => 'ext.elFinder.TinyMceElFinder',
                'connectorRoute'=>'/admin/elfinder/connector',
            ),
            'htmlOptions' => array(
                'rows' => 30,
//										'cols' => 60,
            ),
            'settings' => array(
                'language' => 'ru'
            )
        ));
    ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$newsModel->isNewRecord ? 'Добавить' : 'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/news', 'label'=>'Отмена')); ?>
</div>

<?php $this->endWidget(); ?>