<?php
$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$url = Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/view');

$district = '';
$placeId = $data->id;
if (isset($data->photos) && is_array($data->photos)) {
    $district = $data->district->{$title};
    $this->keywords .= $data->tags->tags . ', ' . $data->{$title};
} else {
    $titleDistrict = 'district_' . Yii::app()->getLanguage();
    $district= $data->{$titleDistrict};
    $placeId = $data->place_id;
    $this->keywords .= $data->{$title} . ', ';
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

<li item="<?php echo $data->id; ?>" onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)" class="highslide-gallery" style="cursor: pointer;">
    <a id="thumb<?php echo $placeId; ?>" href="<?php echo $photos[0]; ?>" class="big-photo" onclick="return hs.expand(this, { thumbnailId: 'thumb<?php echo $placeId; ?>', slideshowGroup: <?php echo $placeId; ?> })">
        <?php
        echo Yii::app()->easyImage->thumbOf($photos[0],
            array(
                'resize' => array('width' => 150, 'height' => 150),
                'crop' => array('width' => 97, 'height' => 99),
                'quality' => 100,
        ));
        ?>
        <i class="enlarge"><?php echo Yii::t('main', 'Увеличить'); ?></i>
    </a>
    <div class="hidden-container">
        <?php $index = 0; foreach ($photos as $photo): ?>
        <?php if ($index++ == 0) continue; ?>
        <a href="<?php echo $photo; ?>" onclick="return hs.expand(this, { thumbnailId: 'thumb<?php echo $placeId; ?>', slideshowGroup: <?php echo $placeId; ?> })">
            <?php
            echo CHtml::image($photo, CHtml::encode($data->{$title}));
            ?>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="item">
        <h1><?php echo CHtml::encode($data->{$title}); ?></h1>
        <div class="address">
            <span><?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($district); ?>,</span>
            <span><?php echo CHtml::encode($data->{$address}); ?></span>
            <span><?php echo CHtml::encode($data->{$description}); ?></span>
        </div>
    </div>
    <div class="view-item">
        <?php echo CHtml::link(Yii::t('main', 'Показать на отдельной странице'), $url . '/' . $placeId . '/' . $data->alias, array('target' => '_blank')); ?>
    </div>
</li>
