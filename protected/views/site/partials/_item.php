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
                'resize' => array('width' => 97, 'height' => 99),
                'quality' => 60,
        ));
        ?>
    </a>
    <div class="item">
        <h1><?php echo $data->{$title}; ?></h1>
        <div class="address">
            <span><?php echo Yii::t('main', 'Район') . ' ' . $district . ', ' . $data->{$address}; ?></span>
            <span><?php echo $data->{$description}; ?></span>
        </div>
    </div>
</li>