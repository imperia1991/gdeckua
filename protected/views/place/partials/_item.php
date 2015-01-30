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
            <a href="<?php
            echo Yii::app()->easyImage->thumbSrcOf($photoPath . $data->photos[0]->title,
                [
                    'resize' => ['width' => 800, 'height' => 600],
                    'quality' => 100,
                ]);
            ?>" class="colorbox">

                <?php
                echo Yii::app()->easyImage->thumbOf($photoPath . $data->photos[0]->title,
                    [
                        'resize' => ['width' => 210, 'height' => 130],
                        'crop' => ['width' => 200, 'height' => 120],
                        'quality' => 100,
                    ]);
                ?>
            </a>
        </div>
        <a href="<?php echo $url . '/place/' . $data->id . '/' . $data->alias; ?>">
            <div class="object_item_bottom information" onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
                <div class="object_item_title">
                    <a href="<?php echo $url . '/' . $data->id . '/' . $data->alias; ?>" target="_blank">
                        <?php echo $data->{$title}; ?>
                    </a>
                </div>
                <div class="object_more">
                    <a href="<?php echo $url . '/' . $data->id . '/' . $data->alias; ?>" align="center" target="_blank"><?php echo Yii::t('main', 'Расширенный просмотр'); ?></a>
                </div>
            </div>
        </a>
    </div>
</div>
