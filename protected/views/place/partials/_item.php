<?php
/** @var Places $data */

$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$shortDescription = 'short_description_' . Yii::app()->getLanguage();
$url = Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place');

$this->keywords .= $data->{$title} . ', ';
$photoPath = '/' . Yii::app()->params['admin']['files']['images'];

?>

<div class="object_item">
    <div class="object_item_block">
        <div class="object_item_photo">
            <a href="<?php echo $photoPath . $data->photos[0]->title; ?>" class="colorbox">
                <img src="<?php echo $photoPath . $data->photos[0]->title; ?>" />
            </a>
        </div>
        <a href="<?php echo $data->getUrl(); ?>">
            <div class="object_item_bottom information" onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
                <div class="object_item_title">
                    <a href="<?php echo $data->getUrl(); ?>" target="_blank">
                        <?php echo $data->{$title}; ?>
                    </a>
                </div>
                <div class="object_more">
                    <a href="<?php echo $data->getUrl(); ?>" align="center" target="_blank"><?php echo Yii::t('main', 'Расширенный просмотр'); ?></a>
                </div>
            </div>
        </a>
    </div>
</div>
