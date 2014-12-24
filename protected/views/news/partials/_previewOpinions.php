<?php
/** @var News[] $previewOpinions */
?>
<?php /** @var News $opinion */ ?>
<?php foreach ($previewOpinions as $opinion): ?>
<div class="news-box row">
    <div class="row collapse">
        <div class="large-12 medium-12 small-12 columns oglavlenie">
            <div class="row collapse">
                <div class="large-4 medium-4 small-3 columns">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $opinion->id . '/' . $opinion->alias); ?>">
                        <?php
                        echo Yii::app()->easyImage->thumbOf('/' . Yii::app()->params['admin']['files']['news'] . '/' . $opinion->photo,
                            [
                                'resize' => ['width' => 100, 'height' => 110],
                                'crop' => ['width' => 69, 'height' => 71],
                                'quality' => 100,
                            ]);
                        ?>
                    </a>
                </div>
                <div class="large-8 medium-8 small-9 columns">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $opinion->id . '/' . $opinion->alias); ?>"><h4><?php echo $opinion->getShortTitle(); ?></h4></a>
                </div>
            </div>
        </div>
        <div class="large-12 columns medium-12 small-12 description">
            <p><?php echo $opinion->getShortText(); ?></p>
        </div>
        <div align="center" class="large-12 columns medium-12 small-12 news-link">
            <a align="center"href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $opinion->id . '/' . $opinion->alias); ?>">
                <?php echo Yii::t('main', 'прочитать статью полностью'); ?>
            </a>
        </div>

    </div>
</div>
<?php endforeach; ?>