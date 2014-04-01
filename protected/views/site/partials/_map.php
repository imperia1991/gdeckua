<?php
$items = $dataProvider->getData();
$title = 'title_' . Yii::app()->getLanguage();
?>
<script type="text/javascript">
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
        header: '<?php echo $item->{$title}; ?>',
        body: '<?php echo $item->description; ?>',
        footer: '<?php echo Yii::t('main', 'Район') . ' ' . $district . ', ' . $item->address; ?>',
        text: '<?php echo '<strong>' . $item->{$title} . '</strong><br/>' . Yii::t('main', 'Район') . ' ' . $district . ', ' . $item->address; ?>'
    });
<?php endforeach; ?>
var placemark;
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
Yii::app()->clientScript->registerScriptFile('/js/search.js', CClientScript::POS_BEGIN);
?>
