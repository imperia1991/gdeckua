<?php
/** @var Places[] $places */
?>
<?php
$this->pageTitle = Yii::t('main', 'Главная');

$title = 'title_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$url = Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place');
$photoPath = '/' . Yii::app()->params['admin']['files']['images'];
?>

<div class="page_content">
	<div class="block_with_map clearfix main">
		<div class="block_with_map_left_right">
            <div class="title">
                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place'); ?>">
                    <?php echo Yii::t('main', 'Места города') ?>
                </a>
            </div>
			<div class="objects clearfix">
				<?php foreach ($places as $place): ?>
					<div class="object_item">
						<div class="object_item_block">
							<div class="object_item_photo">
								<a href="<?php echo $photoPath . $place->photos[0]->title; ?>" class="colorbox">
                                    <img src="<?php echo $photoPath . $place->photos[0]->title; ?>" />
								</a>
							</div>
							<a href="<?php echo $place->getUrl(); ?>" target="_blank">
								<div class="object_item_bottom main">
									<div class="object_item_title">
										<?php echo $place->{$title}; ?>
									</div>
                                    <a href="<?php echo $place->getUrl(); ?>" target="_blank">
									    <div class="object_more"><?php echo $place->getFullAddress(); ?></div>
                                    </a>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
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

