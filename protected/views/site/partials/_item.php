<?php
$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();

$imagePath = '';
if (isset($data->photos) && is_array($data->photos)) {
    $imagePath = '/' . Yii::app()->params['admin']['files']['images'] . $data->photos[0]->title;
} else {
    $imagePath = '/' . Yii::app()->params['admin']['files']['images'] . $data->photoTitle;
}

$district = '';
if (isset($data->photos) && is_array($data->photos)) {
    $district = $data->district->{$title};
} else {
    $titleDistrict = 'district_' . Yii::app()->getLanguage();
    $district= $data->{$titleDistrict};
}
?>

<li onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
    <a class="big-photo" rel="lightgallery" href="<?php echo $imagePath; ?>">
        <?php
        echo Yii::app()->easyImage->thumbOf($imagePath,
            array(
                'resize' => array('width' => 150, 'height' => 150),
                'crop' => array('width' => 97, 'height' => 99),
                'quality' => 100,
        ));
        ?>
    </a>
    <div class="item">
        <h1><?php echo CHtml::encode($data->{$title}); ?></h1>
        <div class="address">
            <span><?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($district) . ', ' . CHtml::encode($data->{$address}); ?></span>
            <span><?php echo CHtml::encode($data->{$description}); ?></span>
        </div>
    </div>
</li>