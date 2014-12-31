<?php
/** @var CActiveDataProvider $dataProvider */
?>
<?php
$this->pageTitle = Yii::t('main', 'Главная');
?>

<?php //if ($items): ?>
<!--    --><?php //$this->renderPartial('/site/partials/_searchFind', [
//            'items' => $items,
//            'pages' => $pages,
//            'model' => $model
//        ]) ?>
<?php //else: ?>
<!--    --><?php //$this->renderPartial('/site/partials/_searchNoFind', [
//            'model' => $model
//        ]) ?>
<?php //endif; ?>

<div class="page_content">
    <?php $this->renderPartial('partials/_mainMap'); ?>

    <div class="home_news">
        <div class="title">
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>">
                <?php echo Yii::t('main', 'Новости') ?>
            </a>
        </div>
        <ul class="home_news_list clearfix">
            <?php foreach ($modelNews as $oneNews): ?>
            <li class="home_news_item">
                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $oneNews->id . '/' . $oneNews->alias); ?>">
                    <div class="home_news_item_text">
                        <?php echo $oneNews->title; ?>
                    </div>
                    <div class="home_news_item_date">
                        <?php echo Yii::app()->dateFormatter->format('d MMMM HH:mm', $oneNews->created_at); ?>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="photos">
        <div class="title">
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo'); ?>">
                <?php echo Yii::t('main', 'Фото города') ?>
            </a>
        </div>
        <ul class="photos_list clearfix">
            <?php foreach ($modelsPhotoCity as $photo): ?>
            <li class="photos_item">
                <div class="photos_item_wrap">
                    <div class="photos_item_image">
                        <a href="javascript:void(0)">
                            <?php
                            echo Yii::app()->easyImage->thumbOf(
                                '/' . Yii::app()->params['admin']['files']['photoCity'] . '/' . $photo->photo,
                                [
                                    'resize' => ['width' => 230, 'height' => 160],
                                    'crop' => ['width' => 210, 'height' => 140],
                                    'quality' => 100,
                                ]
                            );
                            ?>
                        </a>
                    </div>
                    <div class="photos_item_mask">
                        <div class="photos_item_title">
                            <?php echo $photo->title; ?>
                        </div>
                        <div class="photos_item_author">
                            <?php echo Yii::t('main', 'фото'); ?>: <?php echo $photo->author; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="page_text">
        <?php $this->renderPartial('/partials/_find_' . Yii::app()->getLanguage()); ?>
    </div>
</div>

