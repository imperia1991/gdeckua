<script type="text/javascript">
var placeMap;
var placeCenter = [49.439172, 32.059268];
var placemark;
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/search.js', CClientScript::POS_BEGIN);
?>
