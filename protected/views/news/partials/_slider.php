<?php
/** @var CActiveDataProvider $news */
/** @var News $oneNews */
?>

<?php foreach ($news->getData() as $oneNews): ?>
<div class="main_news_item">
    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $oneNews->id . '/' . $oneNews->alias); ?>">
        <?php
        $path = '/' . Yii::app()->params['admin']['files']['news'] . $oneNews->photo;

        echo Yii::app()->easyImage->thumbOf($path,
            [
//                'resize' => ['width' => 505, 'height' => 302],
//                'crop' => ['width' => 495, 'height' => 292],
//                'quality' => 100,
            ],
            [
                'alt' => $oneNews->title,
            ]);
        ?>
        <div class="main_news_item_text"><?php echo $oneNews->title; ?></div>
    </a>
</div>
<?php endforeach; ?>