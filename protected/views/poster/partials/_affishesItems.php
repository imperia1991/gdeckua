<?php
/** @var Posters $poster */
/** @var CategoryPosters $category */

?>
<?php if ($posters->getTotalItemCount()): ?>
    <?php foreach ($posters->getData() as $poster): ?>
        <div class="column size-1of3 item">
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
                <div class="large-12 columns foto-inner-soc" style="margin-top: 5px;">
<!--                    --><?php //$this->renderPartial(
//                        '/partials/_social',
//                        [
//                            'image' => Yii::app()->createUrl('/uploads/photos/photoPoster/' . $poster->photo),
//                            'title' => $data->title,
//                        ]
//                    ); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="padding-left: 5px;"><?php echo Yii::t('main', 'В данной категории информация отсутствует'); ?></p>
<?php endif;
