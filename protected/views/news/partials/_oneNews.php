<?php
/** @var News $data */
?>
<div class="row collapse news-in-accordion">
    <div class="llarge-2 medium-2 columns">
        <?php
        echo Yii::app()->easyImage->thumbOf(
            '/' . Yii::app()->params['admin']['files']['news'] . '/' . $data->photo,
            []
        );
        ?>
        <div>
            <p class="date-public"><?php echo Yii::t('main', 'добавлено'); ?>:<br>
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
    <div class="llarge-10 medium-10 columns new-description">
        <div class="row title-new">
            <a href="<?php echo Yii::app()->createUrl(
                '/' . Yii::app()->getLanguage() . '/news/' . $data->id . '/' . $data->alias
            ); ?>">
                <h4><?php echo $data->title; ?></h4>
            </a>
        </div>
        <div class="large-12 columns new-preview-text">
            <p><?php echo $data->short_text; ?></p>
            <p class="right">
                <a href="<?php echo Yii::app()->createUrl(
                    '/' . Yii::app()->getLanguage() . '/news/' . $data->id . '/' . $data->alias
                ); ?>"><?php echo Yii::t('main', 'показать новость полностью'); ?></a>
            </p>
        </div>
    </div>
</div>