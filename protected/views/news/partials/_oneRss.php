<?php
/** @var RssContent $data */
?>

<div class="row1">
    <div class="row title-two" id="news1">
        <h4>
            <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', $data->getAddAt()); ?> -
            <a href="<?php echo $data->getRssSite()->getSite(); ?>" style="font-size:14px; text-decoration: underline;color:#0066cc" target="_blank">
                <?php echo $data->getRssSite()->getTitle(); ?>
            </a>
        </h4>
    </div>
    <p>
        <a href="<?php echo $data->getUrl(); ?>" target="_blank"><?php echo $data->getTitleNews(); ?></a>
    </p>
</div>
