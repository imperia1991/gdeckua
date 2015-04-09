<?php
/** @var CActiveDataProvider $meetings */
/** @var NewsChaska $meeting */
?>

<?php foreach ($meetings->getData() as $meeting): ?>
<div class="main_news_item">
    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/chashka-che/' . $meeting->alias); ?>">
	    <img src="<?php echo '/' . Yii::app()->params['admin']['files']['ch'] . $meeting->photo ?>" alt="<?php echo $meeting->title; ?>" />
        <div class="main_news_item_text"><?php echo $meeting->title; ?></div>
    </a>
</div>
<?php endforeach; ?>