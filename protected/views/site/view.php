<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.mCustomScrollbar.min.js', CClientScript::POS_BEGIN);

/** @var Places $model */

$title = 'title_' . Yii ::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$this->keywords = $model->tags->tags . ', ' . $model->{$title};

$this->pageTitle = CHtml::encode($model->{$title});
?>
<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Расширенный просмотр') . ' - ' . CHtml::encode($model->{$title})
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns left-sector-large-view">
            <div class="row large-view-box collapse">
                <div class="large-6 medium-6 small-12 columns">
                    <div class="large-12 mod-title">
                        <h4><?php echo CHtml::encode($model->{$title}); ?></h4>
                    </div>
                    <div class="large-12 mod-description">
                        <p><?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($model->district->{$title}); ?><br>
                            <?php echo CHtml::encode($model->{$address}); ?>
                        </p>
                    </div>
                    <div class="row mod-images-gallery">

                        <ul class="tabs" data-tab style="text-align: center;">
                            <li class="tab-title active" style="width: 30%"><a href="#panel2-1"><?php echo Yii::t(
                                        'main',
                                        'Фотографии'
                                    ); ?></a></li>
                            <li class="tab-title" style="width: 40%"><a href="#panel2-2"><?php echo Yii::t(
                                        'main',
                                        'Описание'
                                    ); ?></a></li>
                            <li class="tab-title" style="width: 30%"><a href="#panel2-3"><?php echo Yii::t(
                                        'main',
                                        'Контакты'
                                    ); ?></a></li>
                        </ul>

                        <div class="tabs-content">
                            <div class="content active" id="panel2-1">
                                <div class="large-12 small-12 columns">
                                    <?php $path = '/' . Yii::app(
                                        )->params['admin']['files']['images'] . $model->photos[0]->title; ?>
                                    <ul class="clearing-thumbs main-pic clearing-feature">
                                        <li class="clearing-featured-img">
                                            <a href="<?php
                                            echo Yii::app()->easyImage->thumbSrcOf(
                                                $path,
                                                [
                                                    'resize' => ['width' => 800, 'height' => 600],
                                                    'quality' => 100,
                                                ]
                                            );
                                            ?>"
                                               rel="slideshow"
                                               title="<?php echo CHtml::encode($model->{$title}); ?>"
                                               alt="<?php echo CHtml::encode($model->{$title}); ?>"
                                               class="gallery">
                                                <?php
                                                echo Yii::app()->easyImage->thumbOf(
                                                    $path,
                                                    [
                                                        'resize' => ['width' => 550, 'height' => 400],
                                                        'crop' => ['width' => 491, 'height' => 340],
                                                        'quality' => 100,
                                                    ]
                                                );
                                                ?>
                                                <span class="anlarge"><img src="/img/larger.png"></span>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="centered clearing-thumbs three-images-block clearing-feature block-grid-3">
                                        <?php $index = 0;
                                        foreach ($model->photos as $photo): ?>
                                            <?php
                                            if ($index++ == 0) {
                                                continue;
                                            }
                                            $path = '/' . Yii::app()->params['admin']['files']['images'] . $photo->title
                                            ?>
                                            <li>
                                                <a class="gallery" rel="slideshow" href="<?php
                                                echo Yii::app()->easyImage->thumbSrcOf(
                                                    $path,
                                                    [
                                                        'resize' => ['width' => 800, 'height' => 600],
                                                        'quality' => 100,
                                                    ]
                                                );
                                                ?>"
                                                   title="<?php echo CHtml::encode($model->{$title}); ?>"
                                                   alt="<?php echo CHtml::encode($model->{$title}); ?>">
                                                    <?php
                                                    echo Yii::app()->easyImage->thumbOf(
                                                        $path,
                                                        [
                                                            'resize' => ['width' => 150, 'height' => 150],
                                                            'crop' => ['width' => 115, 'height' => 77],
                                                            'quality' => 100,
                                                        ]
                                                    );
                                                    ?>
                                                    <span class="onlarge">
                                                    <img src="/img/large.png">
                                                </span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="content" id="panel2-2" style="padding: 5px;">
                                <div class="row collapse mCustomScrollbar">
                                    <div class="large-12 columns scroll-description scroll-pane" style="height:338px;">
                                        <p>
                                            <?php echo CHtml::encode($model->{$description}); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content" id="panel2-3" style="padding: 5px;">
                                <div class="row collapse mCustomScrollbar">
                                    <div class="large-12 columns scroll-description scroll-pane" style="height:338px;">
                                        <?php if ($model->contact->phone_city): ?>
                                            <p><strong><?php echo Yii::t('main', 'Телефон городской'); ?>
                                                    :</strong> <?php echo $model->contact->phone_city; ?></p>
                                        <?php endif; ?>
                                        <?php if ($model->contact->phone_mobile1): ?>
                                            <p><strong><?php echo Yii::t('main', 'Телефон мобильный'); ?>
                                                    :</strong> <?php echo $model->contact->phone_mobile1; ?></p>
                                        <?php endif; ?>
                                        <?php if ($model->contact->phone_mobile2): ?>
                                            <p><strong><?php echo Yii::t(
                                                        'main',
                                                        'Телефон мобильный (дополнительный)'
                                                    ); ?>:</strong> <?php echo $model->contact->phone_mobile2; ?></p>
                                        <?php endif; ?>
                                        <?php if ($model->contact->phax): ?>
                                            <p><strong><?php echo Yii::t('main', 'Факс'); ?>
                                                    :</strong> <?php echo $model->contact->phax; ?></p>
                                        <?php endif; ?>
                                        <?php if ($model->contact->email): ?>
                                            <p><strong><?php echo Yii::t('main', 'Электронный адрес (email)'); ?>
                                                    :</strong> <?php echo $model->contact->email; ?></p>
                                        <?php endif; ?>
                                        <?php if ($model->contact->skype): ?>
                                            <p><strong><?php echo Yii::t('main', 'Скайп (skype)'); ?>
                                                    :</strong> <?php echo $model->contact->skype; ?></p>
                                        <?php endif; ?>
                                        <?php if ($model->contact->operation_time): ?>
                                            <p><strong><?php echo Yii::t('main', 'Время работы'); ?>
                                                    :</strong> <?php echo $model->contact->operation_time; ?></p>
                                        <?php endif; ?>

                                        <?php $howToGet = 'how_to_get_' . Yii::app()->getLanguage(); ?>
                                        <p><?php echo $model->{$howToGet} ?></p>

                                        <?php if ($model->isEmptyContact()): ?>
                                            <p><?php echo Yii::t('main', 'Информация уточняется'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="large-6 medium-6 columns map-of-object">
                    <div id="placeMap" class="map-section">
                        <?php
                        $this->renderPartial(
                            'partials/_mapOne',
                            [
                                'model' => $model,
                            ]
                        );
                        ?>
                    </div>
                </div>
            </div>

            <?php echo $this->renderPartial(
                '/partials/_comments',
                [
                    'comment' => $comment,
                    'model' => $model,
                    'caption' => Yii::t('main', 'Комментарии к объекту'),
                    'url' => Yii::app()->createUrl('/comments/comments'),
                ]
            ); ?>

        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>

    </div>
</div>

<?php /*
<div class="comments">
    <?php $this->renderpartial('partials/_comments', array(
            'model' => $model,
            'comment' => $comment,
        )) ?>
</div>
 */
?>

<script type="text/javascript">
    (function ($) {
        $(window).load(function () {
            $(".scroll-pane").mCustomScrollbar({

            });
        });
    })(jQuery);
</script>

<script type="text/javascript">
    $('a[rel=slideshow]', '.clearing-thumbs').colorbox({
        slideshow: false,
        current: "{current}/{total}"
    });
</script>

