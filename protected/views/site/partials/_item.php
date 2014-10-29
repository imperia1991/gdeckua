<?php
/** @var Places $data */

$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$shortDescription = 'short_description_' . Yii::app()->getLanguage();
$url = Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/view');

$this->keywords .= $data->{$title} . ', ';
$photoPath = '/' . Yii::app()->params['admin']['files']['images'];

?>

<div class="large-12 medium-12 small-12 columns establishment">
    <div class="establishment-box" item="<?php echo $data->id; ?>">
        <div class="row collapse">
            <div class="columns right-text">
                <div class="columns left-img">
                    <ul class="clearing-thumbs">
                        <li>
                            <a href="<?php
                            echo Yii::app()->easyImage->thumbSrcOf($photoPath . $data->photos[0]->title,
                                [
                                    'resize' => ['width' => 800, 'height' => 600],
                                    'quality' => 100,
                                ]);
                            ?>" class="gallery" title="<?php echo $data->{$title}; ?>">
                                <?php
                                echo Yii::app()->easyImage->thumbOf($photoPath . $data->photos[0]->title,
                                    [
                                        'resize' => ['width' => 150, 'height' => 150],
                                        'crop' => ['width' => 100, 'height' => 100],
                                        'quality' => 100,
                                    ]);
                                ?>
                                <span class="enlarge"><?php echo Yii::t('main', 'Увеличить'); ?>&nbsp;<img src="/img/lupka.png"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <h6>
                    <b>
                        <a href="<?php echo $url . '/' . $data->id . '/' . $data->alias; ?>" target="_blank">
                            <?php echo $data->{$title}; ?>
                        </a>
                    </b>
                </h6>
                <div class="information" onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
                    <p>
                        <?php echo Yii::t('main', 'Район') . ' ' . $data->getDistrict(); ?><br>
                        <?php echo $data->{$address}; ?><br>
                        <?php echo $data->{$shortDescription}; ?>
                    </p>
                </div>
                <div class="view-item">
                    <a href="<?php echo $url . '/' . $data->id . '/' . $data->alias; ?>" align="center" target="_blank"><?php echo Yii::t('main', 'Показать на отдельной странице'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
