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

$photos = [];

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

        echo '<pre>';
        print_r($photos);
        echo '</pre>';exit;
    } catch (Zend_Search_Lucene_Exception $e){

    }
}
?>

<div class="large-12 medium-12 small-12 columns establishment">
    <div class="establishment-box" item="<?php echo $data->id; ?>">
        <div class="row collapse">
            <div class="columns right-text">
                <div class="columns left-img">
                    <ul class="clearing-thumbs">
                        <li>
                            <a href="<?php
                            echo Yii::app()->easyImage->thumbSrcOf($photos[0],
                                [
                                    'resize' => ['width' => 800, 'height' => 600],
                                    'quality' => 100,
                                ]);
                            ?>" class="gallery" title="<?php echo CHtml::encode($data->{$title}); ?>">
                                <?php
                                echo Yii::app()->easyImage->thumbOf($photos[0],
                                    [
                                        'resize' => ['width' => 150, 'height' => 150],
                                        'crop' => ['width' => 100, 'height' => 100],
                                        'quality' => 100,
                                    ]);
                                ?>
                                <span class="enlarge">
                                    <img src="/img/large.png">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <h6>
                    <b>
                        <a href="<?php echo $url . '/' . $placeId . '/' . $data->alias; ?>" target="_blank">
                            <?php echo CHtml::encode($data->{$title}); ?>
                        </a>
                    </b>
                </h6>
                <div class="information" onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
                    <p>
                        <?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($district); ?><br>
                        <?php echo CHtml::encode($data->{$address}); ?><br>
                        <?php echo CHtml::encode($data->{$description}); ?>
                    </p>
                </div>
                <div class="view-item">
                    <a href="<?php echo $url . '/' . $placeId . '/' . $data->alias; ?>" align="center" target="_blank"><?php echo Yii::t('main', 'Показать на отдельной странице'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
