<?php
$items = $dataProvider->getData();
$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
?>
<script type="text/javascript">
var currLang = '<?php echo Yii::app()->getLanguage(); ?>';
var placeMap;
var placeCenter = [49.439172, 32.059268];
var searchPoints = [];
<?php foreach ($items as $item): ?>
    <?php
    $district = '';
    if ($model->search) {
        $titleDistrict = 'district_' . Yii::app()->getLanguage();
        $district= $item->{$titleDistrict};
    } else {
        $district = $item->district->{$title};
    }
    ?>
    searchPoints.push({
        id: <?php echo $item->id ?>,
        coords:[<?php echo $item->lat; ?>, <?php echo $item->lng; ?>],
        header: '<?php echo CHtml::encode($item->{$title}); ?>',
        body: '<?php echo CHtml::encode($item->{$description}); ?>',
        footer: '<?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($district) . ', ' . CHtml::encode($item->{$address}); ?>',
        text: '<?php echo '<strong>' . CHtml::encode($item->{$title}) . '</strong><br/>' . Yii::t('main', 'Район') . ' ' . CHtml::encode($district) . ', ' . CHtml::encode($item->{$address}); ?>'
    });
<?php endforeach; ?>
var placemark;
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/search.js', CClientScript::POS_BEGIN);
?>
