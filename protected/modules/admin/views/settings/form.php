<?php
/** @var Settings $settingsModel */

Yii::app()->clientScript->registerScriptFile('/js/jquery-migrate-1.2.1.js', CClientScript::POS_BEGIN);
?>
<h3>Настройки страницы "О проетке"</h3>
<?php /** $var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'addSettingsForm',
        'type'=>'horizontal',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => false,
            'validateOnChange' => false,
        ),
        'focus' => ($settingsModel->hasErrors()) ? '.error:first' : array($settingsModel, 'title'),
    )); ?>

<div class="row" style="margin-top: 20px">
    <label>О проекте</label>
    <?php echo $form->error($settingsModel, 'about'); ?>
    <?php
    $this->widget('ext.tinymce.TinyMce', array(
            'model' => $settingsModel,
            'attribute' => 'about',
            'compressorRoute' => '/admin/tinyMce/compressor',
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'fileManager' => array(
                'class' => 'ext.elFinder.TinyMceElFinder',
                'connectorRoute'=>'/admin/elfinder/connector',
            ),
            'htmlOptions' => array(
                'rows' => 20,
            ),
            'settings' => array(
                'language' => 'ru'
            )
        ));
    ?>
</div>
<div class="row" style="margin-top: 20px">
    <label>Контактная информация</label>
    <?php echo $form->error($settingsModel, 'contacts'); ?>
    <?php
    $this->widget('ext.tinymce.TinyMce', array(
            'model' => $settingsModel,
            'attribute' => 'contacts',
            'compressorRoute' => '/admin/tinyMce/compressor',
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'fileManager' => array(
                'class' => 'ext.elFinder.TinyMceElFinder',
                'connectorRoute'=>'/admin/elfinder/connector',
            ),
            'htmlOptions' => array(
                'rows' => 20,
            ),
            'settings' => array(
                'language' => 'ru'
            )
        ));
    ?>
</div>
<div class="row" style="margin-top: 20px">
    <?php echo $form->textFieldRow($settingsModel, 'lat', array()); ?>
    <?php echo $form->textFieldRow($settingsModel, 'lng', array()); ?>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label' => 'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => '/admin/places', 'label' => 'Отмена')); ?>
</div>

<?php $this->endWidget(); ?>