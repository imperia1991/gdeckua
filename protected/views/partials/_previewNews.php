
<div class="large-2 medium-3 small-12 columns right-section-cont">

    <!-- news block -->
    <div class="right-section">
        <h4><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>" title="<?php echo Yii::t('main', 'Новости'); ?>"><?php echo Yii::t('main', 'Новости'); ?></a></h4>
        <?php
        /** @var News $oneNews */
        ?>
        <?php foreach ($this->previewNews as $oneNews): ?>
        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-12 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-12 medium-12 small-12 columns">
                            <?php
                            echo Yii::app()->easyImage->thumbOf('/' . Yii::app()->params['admin']['files']['news'] . $oneNews->photo,
                                [
                                    'resize' => ['width' => 100, 'height' => 80],
                                    'crop' => ['width' => 71, 'height' => 60],
                                    'quality' => 100,
                                ]);
                            ?>
                            <p><?php echo $oneNews->created_at; ?></p>
                            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $oneNews->id . '/' . $oneNews->alias); ?>"><h4><?php echo $oneNews->title; ?></h4></a>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-12 small-12 description">
                    <p><?php echo $oneNews->short_text; ?>...</p>
                    <a align="center" href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $oneNews->id . '/' . $oneNews->alias); ?>"><?php echo Yii::t('main', 'прочитать статью полностью'); ?></a>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- news block -->

    <!-- read more news -->
    <div class="row collapse show-news">
        <div class="large-12 columns">
            <p><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>" title="<?php echo Yii::t('main', 'Новости'); ?>"><?php echo Yii::t('main', 'Читать все новости'); ?></a></p>
        </div>
    </div>
    <!-- read more news -->


    <!-- right section reklama -->
    <?php $this->renderPartial('/partials/_adsOne'); ?>
    <!-- right section reklama -->


</div>