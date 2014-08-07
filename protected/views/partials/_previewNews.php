
<div class="large-2 small-12 columns right-section-cont">

    <!-- news block -->
    <div class="right-section">
        <h4><?php echo Yii::t('main', 'Новости'); ?></h4>
        <?php
        /** @var News $oneNews */
        ?>
        <?php foreach ($this->previewNews as $oneNews): ?>
        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-4 medium-4 small-2 columns">
                            <?php
                            echo Yii::app()->easyImage->thumbOf('/' . Yii::app()->params['files']['photos']['news'] . $oneNews->photo,
                                [
                                    'resize' => ['width' => 100, 'height' => 80],
                                    'crop' => ['width' => 71, 'height' => 60],
                                    'quality' => 100,
                                ]);
                            ?>
                        </div>
                        <div class="large-8 medium-8 small-10 columns">
                            <p><?php echo $oneNews->created_at; ?></p>
                            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $oneNews->id . '/' . $oneNews->alias); ?>"><h4><?php echo $oneNews->title; ?></h4></a>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p><?php echo $oneNews->short_text; ?>...</p>
                    <a align="center" href="<?php echo Yii::app()->createUrl('/news/' . $oneNews->id); ?>"><?php echo Yii::t('main', 'прочитать статью полностью'); ?></a>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- news block -->

    <!-- read more news -->
    <div class="row collapse show-news">
        <div class="large-12 columns">
            <p><a href="<?php echo Yii::app()->createUrl('/news'); ?>"><?php echo Yii::t('main', 'Читать все новости'); ?></a></p>
        </div>
    </div>
    <!-- read more news -->


    <!-- right section reklama -->
    <div class="row collapse reklama-news-box">
        <div class="large-12 medium-12 small-12 columns">
            <div><a href="#"><img src="/img/reklama.png"></a></div>
        </div>
    </div>
    <!-- right section reklama -->


</div>