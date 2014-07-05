<?php
$title = 'title_' . Yii ::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
$this->keywords = $model->tags->tags . ', ' . $model->{$title};

$this->pageTitle = $model->{$title};
?>
<div class="search-block margin-top10"">
<?php
$this->renderPartial('/partials/_search', array(
    'dataProvider' => $dataProvider,
    'currentPage' => 1,
    'model' => $model,
    'selectDistrict' => '',
    'districts' => $districts,
    'checkedString' => ''
));
?>
</div>
<div class="container">
    <div class="content padding-left400">
        <div id="placeMap" class="map-wrap height515">
            <?php
                $this->renderPartial('partials/_mapOne', array(
                    'model' => $model,
                ));
            ?>
        </div>
    </div>
    <div class="line"></div>
    <?php $this->renderPartial('/partials/_ads'); ?>
    <div class="line"></div>
    <div class="container-text">
        <?php $this->renderPartial('/partials/_find_' . Yii::app()->getLanguage()); ?>
    </div>
</div>
<div class="left-sidebar width400">
    <div class="content-view">
        <h1><?php echo CHtml::encode($model->{$title}); ?></h1>
        <div class="text-view">
            <span><?php echo Yii::t('main', 'Район') . ' ' . CHtml::encode($model->district->{$title}); ?>,</span>
            <span><?php echo CHtml::encode($model->{$address}); ?>,</span>
            <span><?php echo CHtml::encode($model->{$description}); ?></span>
        </div>
        <div class="line"></div>
        <div class="gallery-wrap highslide-gallery">
            <?php $path = '/' . Yii::app()->params['admin']['files']['images'] . $model->photos[0]->title; ?>
            <div class="view-photo">
                <a id="thumb1" class="big-photo" href="<?php echo $path; ?>" onclick="return hs.expand(this, { thumbnailId: 'thumb1', slideshowGroup: 1 })">
                    <?php
                    echo Yii::app()->easyImage->thumbOf($path,
                        array(
                            'resize' => array('width' => 500, 'height' => 400),
                            'crop' => array('width' => 355, 'height' => 221),
                            'quality' => 100,
                    ));
                    ?>
                    <i class="enlarge"><?php echo Yii::t('main', 'Увеличить'); ?></i>
                </a>
            </div>
            <div class="photo-list">
                <?php $index = 0; foreach ($model->photos as $photo): ?>
                <?php
                if ($index++ == 0) continue;
                $path = '/' . Yii::app()->params['admin']['files']['images'] . $photo->title
                ?>
                <div class="photo-item">
                    <a class="big-photo" href="<?php echo $path; ?>" onclick="return hs.expand(this, { thumbnailId: 'thumb1', slideshowGroup: 1 })">
                        <?php
                        echo Yii::app()->easyImage->thumbOf($path,
                            array(
                                'resize' => array('width' => 150, 'height' => 150),
                                'crop' => array('width' => 115, 'height' => 77),
                                'quality' => 100,
                        ));
                        ?>
                        <i class="enlarge"><?php echo Yii::t('main', 'Увеличить'); ?></i>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
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

