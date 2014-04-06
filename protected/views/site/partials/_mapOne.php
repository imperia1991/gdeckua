<?php
$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
?>
<script type="text/javascript">
var currLang = '<?php echo Yii::app()->getLanguage(); ?>';
var placeMap;
var placeCenter = [<?php echo $model->lat; ?>, <?php echo $model->lng; ?>];
var header = '<?php echo CHtml::encode($model->{$title}); ?>';
var body = '<?php echo CHtml::encode($model->{$description}); ?>';
var footer = '<?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($model->district->{$title}) . ', ' . CHtml::encode($model->{$address}); ?>';
var text = '<?php echo '<strong>' . CHtml::encode($model->{$title}) . '</strong><br/>' . Yii::t('main', 'Район') . ' ' . CHtml::encode($model->district->{$title}) . ', ' . CHtml::encode($model->{$address}); ?>';
var placemark;
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/view.js', CClientScript::POS_BEGIN);
?>
