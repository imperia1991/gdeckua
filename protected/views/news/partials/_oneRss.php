<?php
/** @var RssContent $data */
?>

<li class="other_news_item">
    <div class="othe_news_item_title">
        <a href="<?php echo $data->getRssSite()->getSite(); ?>" target="_blank">
            <?php echo Yii::app()->dateFormatter->format('HH:mm', $data->getAddAt()); ?>
            -
            <?php echo $data->getRssSite()->getTitle(); ?>
        </a>
    </div>
    <div class="other_news_item_text">
        <a href="<?php echo $data->getUrl(); ?>" target="_blank">
            <?php echo $data->getTitleNews(); ?>
        </a>
    </div>
</li>
