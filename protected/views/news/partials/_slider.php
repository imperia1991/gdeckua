<?php
/** @var CActiveDataProvider $news */
/** @var News $oneNews */
?>
<ul class="example-orbit-content" data-orbit>
    <?php foreach ($news->getData() as $oneNews): ?>
    <li data-orbit-slide="headline-1">
        <div class="row slide-title">
            <div class="large-10 medium-10 small-10 columns">
                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $oneNews->id . '/' . $oneNews->alias); ?>">
                    <h2><?php echo $oneNews->title; ?></h2>
                </a>
            </div>
            <div class="large-2 medium-2 small-2 columns">
                <h3><?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneNews->created_at); ?></h3>
            </div>
        </div>
        <div class="row collapse">
            <div class="large-12 slide-image columns">
                <?php
                $path = '/' . Yii::app()->params['admin']['files']['news'] . $oneNews->photo;

                echo Yii::app()->easyImage->thumbOf($path,
                    [
//                        'resize' => ['width' => 616, 'height' => 360],
//                        'crop' => ['width' => 491, 'height' => 359],
//                        'quality' => 100,
                    ]);
                ?>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>