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
            <?php echo $poster->description; ?>
            <div class="film_text">
                Каждый год, все птицы улетают на юг. Должна улететь и стая нашего<br/> юного героя Чижика, но в последний момент перед перелетом на вожака стаи Дариуса злой кот. Только Дариус знает дорогу на юг, и он успевает передать секрет Чижику, который юного героя Чижика, но в последний момент перед перелетом на вожака стаи Дариуса нападает злой кот. Только Дариус знает дорогу на юг, и он успевает передать секрет Чижику, который
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="padding-left: 5px;"><?php echo Yii::t('main', 'В данной категории информация отсутствует'); ?></p>
<?php endif; ?>



