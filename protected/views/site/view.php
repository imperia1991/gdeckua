<?php
$title = 'title_' . Yii ::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$this->keywords = $model->tags->tags . ', ' . $model->{$title};

$this->pageTitle = CHtml::encode($model->{$title});
?>

<div class="large-12 columns navigation-top">
    <p><a href="/"><?php echo Yii::t('main', 'Главная'); ?></a> > <?php echo Yii::t('main', 'Расширенный просмотр'); ?> - <?php echo CHtml::encode($model->{$title}); ?></p><hr>
</div>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 small-12 columns left-sector-large-view">
            <div class="row large-view-box collapse">
                <div class="large-6 medium-6 small-12 columns">
                    <div class="large-12 mod-title">
                        <h4><?php echo CHtml::encode($model->{$title}); ?></h4>
                    </div>
                    <div class="large-12 mod-description">
                        <p><?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($model->district->{$title}); ?><br>
                            <?php echo CHtml::encode($model->{$address}); ?>
                        </p>
                        <p><?php echo CHtml::encode($model->{$description}); ?></p>
                    </div>
                    <div class="row mod-images-gallery">
                        <?php /*
                        <ul class="tabs" data-tab>
                            <li class="tab-title active"><a href="#panel2-1">Фотографии</a></li>
                            <li class="tab-title"><a href="#panel2-2">Как добраться</a></li>
                        </ul>
                        */ ?>
                        <div class="tabs-content">
                            <div class="content active" id="panel2-1">
                                <div class="large-12 small-12 columns">
                                    <?php $path = '/' . Yii::app()->params['admin']['files']['images'] . $model->photos[0]->title; ?>
                                    <ul class="clearing-thumbs main-pic clearing-feature">
                                        <li class="clearing-featured-img">
                                            <a href="<?php
                                                    echo Yii::app()->easyImage->thumbSrcOf($path,
                                                        [
                                                            'resize' => ['width' => 800, 'height' => 600],
                                                            'quality' => 100,
                                                        ]);
                                                    ?>"
                                               rel="slideshow"
                                               title="<?php echo CHtml::encode($model->{$title}); ?>"
                                               alt="<?php echo CHtml::encode($model->{$title}); ?>"
                                               class="gallery">
                                                <?php
                                                echo Yii::app()->easyImage->thumbOf($path,
                                                    [
                                                        'resize' => ['width' => 500, 'height' => 400],
                                                        'crop' => ['width' => 355, 'height' => 221],
                                                        'quality' => 100,
                                                    ]);
                                                ?>
                                                <span class="anlarge"><img src="/img/larger.png"></span>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="centered clearing-thumbs three-images-block clearing-feature block-grid-3" >
                                        <?php $index = 0; foreach ($model->photos as $photo): ?>
                                        <?php
                                            if ($index++ == 0) continue;
                                            $path = '/' . Yii::app()->params['admin']['files']['images'] . $photo->title
                                        ?>
                                        <li>
                                            <a class="gallery" rel="slideshow" href="<?php
                                                        echo Yii::app()->easyImage->thumbSrcOf($path,
                                                            [
                                                                'resize' => ['width' => 800, 'height' => 600],
                                                                'quality' => 100,
                                                            ]);
                                                        ?>"
                                               title="<?php echo CHtml::encode($model->{$title}); ?>"
                                               alt="<?php echo CHtml::encode($model->{$title}); ?>">
                                                <?php
                                                echo Yii::app()->easyImage->thumbOf($path,
                                                    [
                                                        'resize' => ['width' => 150, 'height' => 150],
                                                        'crop' => ['width' => 115, 'height' => 77],
                                                        'quality' => 100,
                                                    ]);
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
                            <div class="content" id="panel2-2">
                                <p>Second panel content goes here...</p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="large-6 medium-6 columns map-of-object">
                    <div id="placeMap" class="map-section">
                        <?php
                        $this->renderPartial('partials/_mapOne', [
                                'model' => $model,
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="large-12 columns comments">
                Комментарии к объекту
            </div>
            <div class="row collapse input-form">

                <form class="row collapse">
                    <div class="large-7 columns">
                        <textarea placeholder="Напишите Ваш комментарий..."></textarea>
                    </div>
                    <div class="large-5 columns">
                        <div class="row collapse" style="padding-left: 5px !important;">
                            <div class="large-12 columns">
                                <input type="text" placeholder="Ваше Имя (обязательно)">
                            </div>
                            <div class="large-6 columns">
                                <img src="img/capcha.png"><br><br>
                                <input type="submit" value="Сменить"class="button tiny">
                            </div>
                            <div class="large-6 columns">
                                <input type="text" placeholder="Введите код">
                            </div>
                            <div class="large-12 columns">
                                <input type="submit" value="Написать"class="button small">
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="row collapse comment-block">
                <div class="large-12 columns row">
                    <div class="large-1 medium-1 columns comment-icon">
                        <img src="img/comment.png" class="left">
                    </div>

                    <div class="large-11 medium-11 columns comment-box-inner-left">
                        <div class="large-6 medium-5 small-4 columns right"><p class="right"><a href="#">Владислав</a></p></div>
                        <div class="large-6 medium-7 small-8 columns left"><p class="left">23 октября 2014 16:39</p></div>
                        <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                            Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum  dolor sit amet enim. Etiam ullamcorper. Supendisse a</p>
                    </div>

                </div>
                <div class="large-12 columns"></div>
                <div class="large-12 columns row">

                    <div class="large-11 medium-11 columns comment-box-inner-right">
                        <div class="large-6 medium-5 small-4 columns left"><p class="left"><a href="#">Елена</a></p></div>
                        <div class="large-6 medium-7 small-8 columns right"><p class="right">23 октября 2014 16:39</p></div>
                        <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                            Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum  dolor sit amet enim. Etiam ullamcorper. Supendisse</p>
                    </div>

                    <div class="large-1 medium-1 columns comment-icon-right">
                        <img src="img/comment-right.png" class="right">
                    </div>
                </div>
            </div>
            <br>
            <div class="row collapse">
                <div class="show-other-news">
                    <a href="#">Показать больше комментариев</a>
                </div>
            </div>

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
 */?>

<script type="text/javascript">
    $('a[rel=slideshow]', '.clearing-thumbs').colorbox({
        slideshow: false,
        current: "{current}/{total}"
    });
</script>

