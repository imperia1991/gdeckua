<?php
/** @var CActiveDataProvider $dataProvider */
?>
<?php
$this->pageTitle = Yii::t('main', 'Главная');

$title = 'title_' . Yii::app()->getLanguage();
?>

<div class="page_content">
	<div class="block_with_map clearfix">
		<div class="block_with_map_left">

			<script type="text/javascript"
			        charset="utf-8"
			        src="http://api-maps.yandex.ru/services/constructor/1.0/js/?sid=VmG6h2HaO5j43R7K8XnnTXBcsmrwH9MU"></script>

		</div>
		<div class="block_with_map_left_right">
			<div class="cathegories">
				<?php foreach ($categories as $key => $category): ?>
					<a class="cathegories_item <?php if ($currentCategoryId == $category->id): ?>active<?php endif; ?>"
					   href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/poster/' . $category->alias); ?>">
						<?php echo $category->{$title}; ?>
					</a>
				<?php endforeach; ?>
			</div>
			<div class="objects clearfix">
				<div class="object_item">
					<div class="object_item_block">
						<div class="object_item_photo">
							<a href="images/data/1-1.png" class="colorbox"><img src="images/data/1-1.png" alt=""></a>
						</div>
						<a href="#">
							<div class="object_item_bottom">
								<div class="object_item_title">
									Черкасский государственный технологический университет
								</div>
								<div class="object_more">розширений перегляд</div>
							</div>
						</a>
					</div>
				</div>
				<div class="object_item">
					<div class="object_item_block">
						<div class="object_item_photo">
							<a href="images/data/2-1.png" class="colorbox"><img src="images/data/2-1.png" alt=""></a>
						</div>
						<a href="#">
							<div class="object_item_bottom">
								<div class="object_item_title">
									Черкасский национальный институ имени Тараса Григорьевича Шевченко
								</div>
								<div class="object_more">розширений перегляд</div>
							</div>
						</a>
					</div>
				</div>
				<div class="object_item">
					<div class="object_item_block">
						<div class="object_item_photo">
							<a href="images/data/1-1.png" class="colorbox"><img src="images/data/1-1.png" alt=""></a>
						</div>
						<a href="#">
							<div class="object_item_bottom">
								<div class="object_item_title">
									Черкасская областная государственная администрация
								</div>
								<div class="object_more">розширений перегляд</div>
							</div>
						</a>
					</div>
				</div>
				<div class="object_item">
					<div class="object_item_block">
						<div class="object_item_photo">
							<a href="images/data/2-1.png" class="colorbox"><img src="images/data/2-1.png" alt=""></a>
						</div>
						<a href="#">
							<div class="object_item_bottom">
								<div class="object_item_title">
									Аптека
								</div>
								<div class="object_more">розширений перегляд</div>
							</div>
						</a>
					</div>
				</div>
				<div class="object_item">
					<div class="object_item_block">
						<div class="object_item_photo">
							<a href="images/data/1-1.png" class="colorbox"><img src="images/data/1-1.png" alt=""></a>
						</div>
						<a href="#">
							<div class="object_item_bottom">
								<div class="object_item_title">
									Департамент соціальної політики та молоді і ще і спорту України
								</div>
								<div class="object_more">розширений перегляд</div>
							</div>
						</a>
					</div>
				</div>
				<div class="object_item">
					<div class="object_item_block">
						<div class="object_item_photo">
							<a href="images/data/2-1.png" class="colorbox"><img src="images/data/2-1.png" alt=""></a>
						</div>
						<a href="#">
							<div class="object_item_bottom">
								<div class="object_item_title">
									Ночной клуб Миллениум
								</div>
								<div class="object_more">розширений перегляд</div>
							</div>
						</a>
					</div>
				</div>
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

