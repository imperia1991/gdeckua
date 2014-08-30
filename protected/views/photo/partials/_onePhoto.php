<?php
/** @var PhotoCity $data */
?>
<div class="large-4 small-12 medium-6 columns foto-inner item">
    <div class="row collapse">
        <div class="large-12 columns foto-inner-title"><h3><?php echo $data->title; ?></h3></div>
        <div class="large-12 columns foto-inner-img">
            <a href="<?php
                echo Yii::app()->easyImage->thumbSrcOf('/' . Yii::app()->params['admin']['files']['photoCity'] . $data->photo,
                    [
                        'resize' => ['width' => 800, 'height' => 600],
                        'quality' => 100,
                    ]);
                ?>"
               class="gallery" title="<?php echo $data->title; ?>"
                >
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
                <span class="enlarge large-lupa"><?php echo Yii::t('main', 'Увеличить'); ?>&nbsp;<img src="/img/lupka.png"></span>
            </a>
        </div>
        <div class="large-12 columns foto-inner-text"><p><?php echo Yii::t('main', 'фото'); ?>: <?php echo $data->author; ?></p></div>
        <div class="large-12 columns foto-inner-soc">
<!--            --><?php //$this->renderPartial('/partials/_social', [
//                    'image' => Yii::app()->createUrl('/uploads/photos/photoCity/' . $data->photo),
//                    'title' => $data->title,
//                ]); ?>
        </div>
    </div>
</div>
