<?php
$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$url = Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/view/object/');

$imagePath = '';
if (isset($data->photos) && is_array($data->photos)) {
    $imagePath = '/' . Yii::app()->params['admin']['files']['images'] . $data->photos[0]->title;
} else {
    $imagePath = '/' . Yii::app()->params['admin']['files']['images'] . $data->photoTitle;
}

$district = '';
$id = $data->id;
if (isset($data->photos) && is_array($data->photos)) {
    $district = $data->district->{$title};
} else {
    $titleDistrict = 'district_' . Yii::app()->getLanguage();
    $district= $data->{$titleDistrict};
    $id = $data->place_id;
}
?>

<li onmouseover="showPlacemark(<?php echo $id; ?>)" onclick="clickPlacemark(<?php echo $id; ?>)" onmouseout="hidePlacemark(<?php echo $id; ?>)">
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
            <span><?php echo CHtml::encode($data->{$description}); ?></span><br/>
            <?php echo CHtml::link(Yii::t('main', 'Показать на отдельной странице'), $url . '/' . $id, array('target' => '_blank')); ?>
        </div>
    </div>
</li>