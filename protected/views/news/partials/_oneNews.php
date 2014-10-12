<?php
/** @var News $data */
?>
<div class="row collapse news-in-accordion">
    <div class="large-2 medium-2 columns">
        <?php
        echo Yii::app()->easyImage->thumbOf(
            '/' . Yii::app()->params['admin']['files']['news'] . '/' . $data->photo,
            [
//                'resize' => ['width' => 500, 'height' => 400],
//                'crop' => ['width' => 491, 'height' => 340],
//                'quality' => 100,
            ]
        );
        ?>
    </div>
    <div class="large-10 medium-10 columns new-description">
        <div class="row title-new">
            <div class="large-9 medium-9 columns">
                <a href="<?php echo Yii::app()->createUrl(
                    '/' . Yii::app()->getLanguage() . '/news/' . $data->id . '/' . $data->alias
                ); ?>">
                    <h4><?php echo $data->title; ?></h4>
                </a>
            </div>
            <div class="large-3 medium-3 columns">
                <p class="right"><?php echo Yii::t('main', 'добавлено'); ?>:<br>
                    <?php echo Yii::t(
                        'main',
                        '{date} в {time}',
                        [
                            '{date}' => Yii::app()->dateFormatter->format('dd.MM.yyyy', $data->created_at),
                            '{time}' => Yii::app()->dateFormatter->format('HH:mm', $data->created_at)
                        ]
                    ); ?>
                </p>
            </div>
        </div>
        <div class="large-12 columns new-preview-text">
            <p><?php echo $data->short_text; ?></p><br>

            <p class="right">
                <a href="<?php echo Yii::app()->createUrl(
                    '/' . Yii::app()->getLanguage() . '/news/' . $data->id . '/' . $data->alias
                ); ?>"><?php echo Yii::t('main', 'показать новость полностью'); ?></a>
            </p>
        </div>
    </div>
</div>