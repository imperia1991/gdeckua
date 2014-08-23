<?php
/** @var CActiveDataProvider $posters */
/** @var Posters $poster */
/** @var CategoryPosters $category */
?>

<?php if ($posters->getTotalItemCount()): ?>
    <?php foreach ($posters->getData() as $poster): ?>
        <div class="large-12 columns afisha-block">
            <div class="row collapse">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <div class="large-12 columns ">
                            <?php
                            echo Yii::app()->easyImage->thumbOf(
                                '/' . Yii::app()->params['admin']['files']['photoPoster'] . '/' . $poster->photo,
                                [
                                    'resize' => ['width' => 500, 'height' => 400],
                                    'crop' => ['width' => 491, 'height' => 340],
                                    'quality' => 100,
                                ]
                            );
                            ?>
                        </div>
                        <div class="large-12 columns foto-inner-soc">
                            <ul class="soc-icons-list">
                                <?php $this->renderPartial(
                                    '/partials/_social',
                                    [
                                        'image' => Yii::app()->createUrl(
                                                '/uploads/photos/photoPoster/' . $poster->photo
                                            ),
                                        'title' => $data->title,
                                    ]
                                ); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="large-8 columns">
                    <div class="row collapse">
                        <div class="row collapse afisha-title">
                            <?php $columns = (!$poster->date_from && !$poster->date_to) ? 12 : 8; ?>
                            <div class="large-<?php echo $columns; ?> columns afisha-name"><h3><?php echo $poster->title; ?></h3></div>
                            <?php if ($poster->date_from && $poster->date_to): ?>
                                <div class="large-4 columns afisha-date">
                                    <h4>
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
                                    </h4>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row collapse afisha-table">
                            <div class="row collapse">
                                <div class="large-12 columns thin-description">
                                    <?php echo $poster->description; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p style="padding-left: 5px;"><?php echo Yii::t('main', 'В данной категории информация отсутствует'); ?></p>
<?php endif;
