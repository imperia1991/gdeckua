<?php
$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$url = Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/view/object/');

$district = '';
$placeId = $data->id;
if (isset($data->photos) && is_array($data->photos)) {
    $district = $data->district->{$title};
} else {
    $titleDistrict = 'district_' . Yii::app()->getLanguage();
    $district= $data->{$titleDistrict};
    $placeId = $data->place_id;
}

$photos = array();
if (isset($data->photos) && is_array($data->photos)) {
    foreach ($data->photos as $photo) {
        $photos[] = '/' . Yii::app()->params['admin']['files']['images'] . $photo->title;
    }
} else {
    $photoTitleString = 'photoTitle_';
    $index = 0;

    $photoTitle = $photoTitleString . $data->place_id . '_' . $index;
    try {
        while ($data->{$photoTitle}) {
            $photos[] = '/' . Yii::app()->params['admin']['files']['images'] . $data->{$photoTitle};

            $index++;
            $photoTitle = $photoTitleString . $data->place_id . '_' . $index;
        }
    } catch (Zend_Search_Lucene_Exception $e){

    }
}
?>

<li onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
    <a class="big-photo" rel="lightgallery" href="<?php echo $photos[0]; ?>">
        <?php
        echo Yii::app()->easyImage->thumbOf($photos[0],
            array(
                'resize' => array('width' => 150, 'height' => 150),
                'crop' => array('width' => 97, 'height' => 99),
                'quality' => 100,
        ));
        ?>

        <?php foreach ($photos as $photo): ?>
            <?php
            echo CHtml::image($photo, CHtml::encode($data->{$title}), array('style' => 'display:none'));
            ?>
        <?php endforeach; ?>
    </a>
    <div class="item">
        <h1><?php echo CHtml::encode($data->{$title}); ?></h1>
        <div class="address">
            <span><?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($district) . ', ' . CHtml::encode($data->{$address}); ?></span>
            <span><?php echo CHtml::encode($data->{$description}); ?></span><br/>
            <?php echo CHtml::link(Yii::t('main', 'Показать на отдельной странице'), $url . '/' . $placeId, array('target' => '_blank')); ?>
        </div>
    </div>
</li>