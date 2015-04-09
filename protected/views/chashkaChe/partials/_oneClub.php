<?php
/** @var NewsChaska $data */
?>

<li class="other_news_item">
    <div class="othe_news_item_title">
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/chashka-che/' . $data->alias); ?>">
            <?php echo Yii::app()->dateFormatter->format('HH:mm', $data->created_at); ?>
            -
            <?php echo $data->title; ?>
        </a>
    </div>
    <div class="other_news_item_text">
        <?php echo $data->short_text; ?>
    </div>
</li>
