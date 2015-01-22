<?php
/** @var PhotoCity $data */
?>

<div class="photo_item">
    <div class="photos_item">
        <div class="photos_item_wrap">
            <div class="photos_item_image">
                <a href="javascript:void(0)">
                    <?php
                    echo Yii::app()->easyImage->thumbOf(
                        '/' . Yii::app()->params['admin']['files']['photoCity'] . '/' . $data->photo,
                        [
                            'resize' => ['width' => 500, 'height' => 400],
                            'crop' => ['width' => 491, 'height' => 340],
                            'quality' => 100,
                        ]
                    );
                    ?>
                </a>
            </div>
            <div class="photos_item_mask">
                <div class="photos_item_title">
                    <?php echo $data->title; ?>
                </div>
                <div class="photos_item_author">
                    <?php echo Yii::t('main', 'фото'); ?>: <?php echo $data->author; ?>
                </div>
                <a href="<?php
                echo Yii::app()->easyImage->thumbSrcOf(
                    '/' . Yii::app()->params['admin']['files']['photoCity'] . $data->photo,
                    [
                        'resize' => ['width' => 800, 'height' => 600],
                        'quality' => 100,
                    ]
                );
                ?>" class="photos_item_link colorbox" title="<?php echo $data->title; ?>"><?php echo Yii::t('main', 'Увеличить'); ?></a>
            </div>
        </div>
    </div>
</div>
