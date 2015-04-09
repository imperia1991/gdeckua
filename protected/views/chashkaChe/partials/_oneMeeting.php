<?php
/** @var NewsChaska $data */
?>

<?php if (file_exists(Yii::app()->params['admin']['files']['ch'] . '/' . $data->photo)): ?>

<li class="news_item">
    <div class="news_item_photo_wrap">
        <div class="news_item_photo">
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/chashka-che/' . $data->alias); ?>">
	            <img src="<?php echo '/' . Yii::app()->params['admin']['files']['ch'] . '/' . $data->photo; ?>" alt="<?php echo $data->title; ?>">
            </a>
        </div>
        <div class="news_item_date">
            <?php echo Yii::t(
                'main',
                '{date} в {time}',
                [
                    '{date}' => Yii::app()->dateFormatter->format('dd.MM.yyyy', $data->created_at),
                    '{time}' => Yii::app()->dateFormatter->format('HH:mm', $data->created_at)
                ]
            ); ?>
        </div>
    </div>
    <div class="news_item_content">
        <div class="news_item_title">
            <a href="<?php echo  Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/chashka-che/' . $data->alias); ?>">
                <?php echo $data->title; ?>
            </a>
        </div>
        <div class="news_item_text">
            <?php echo $data->short_text; ?>
        </div>
    </div>
</li>
<?php endif; ?>