<?php
/** @var CActiveDataProvider $posters */
/** @var Posters $poster */
/** @var CategoryPosters $category */
?>

<?php if ($posters->getTotalItemCount()): ?>
    <?php foreach ($posters->getData() as $poster): ?>
        <div class="film_single">
            <div class="film_poster">
                <a href="#">
                    <?php
                    echo Yii::app()->easyImage->thumbOf(
                        '/' . Yii::app()->params['admin']['files']['photoPoster'] . '/' . $poster->photo,
                        [
                            'resize' => ['width' => 491, 'height' => 340],
//                                    'crop' => ['width' => 491, 'height' => 340],
                            'quality' => 100,
                        ]
                    );
                    ?>
                </a>
            </div>
            <div class="film_title">
                <?php echo $poster->title; ?>
                <div class="film_title_capt">
                    <?php echo Yii::t('main', 'Показ'); ?>
                    <?php echo Yii::t('main', 'с'); ?>
                    <?php echo Yii::app()->dateFormatter->format(
                        'dd.MM',
                        strtotime($poster->date_from)
                    ); ?>
                    <?php echo Yii::t('main', 'по'); ?>
                    <?php echo Yii::app()->dateFormatter->format(
                        'dd.MM',
                        strtotime($poster->date_to)
                    ); ?>
                </div>
            </div>
	        <div class="cinema">
		        <?php echo $poster->description; ?>
	        </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="padding-left: 5px;"><?php echo Yii::t('main', 'В данной категории информация отсутствует'); ?></p>
<?php endif; ?>



