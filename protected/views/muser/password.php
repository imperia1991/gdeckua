<?php
$this->pageTitle = Yii::t('main', 'Изменить пароль');

$this->breadcrumbs = [
	'muser' => Yii::t('main', 'Мой кабинет'),
	'' => Yii::t('main', 'Изменить пароль')
];
?>
<div class="page_content news clearfix">
	<div class="news_main muser">
		<div class="news_cathegories">
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Личная информация'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/email'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Изменить E-Mail'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/blog'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Мои блоги'); ?>
			</a>
		</div>
		<ul class="news_list">
			<li class="news_item">
				<div class="news_item_photo_wrap">
					<div class="news_item_photo">
						<a href="#"><img src="images/data/n1.jpg" alt=""></a>
					</div>
					<div class="news_item_date">
						16.04.2014 в 15:42
					</div>
				</div>
				<div class="news_item_content">
					<div class="news_item_title">
						<a href="#">Справу з шахрайством в університеті Поплавського передадуть до Генпрокуратури – Квіт</a>
					</div>
					<div class="news_item_text">
						Директора КП «Черкаські ринки» засуджено до 3 років позбавлення волі
					</div>
				</div>
			</li>
			<li class="news_item">
				<div class="news_item_photo_wrap">
					<div class="news_item_photo">
						<a href="#"><img src="images/data/n2.jpg" alt=""></a>
					</div>
					<div class="news_item_date">
						16.04.2014 в 15:42
					</div>
				</div>
				<div class="news_item_content">
					<div class="news_item_title">
						<a href="#">«Батьківщина» підтримає кандидатуру Гройсмана на посаду спікера</a>
					</div>
					<div class="news_item_text">
						Про це повідомив представник об’єднання
					</div>
				</div>
			</li>
			<li class="news_item">
				<div class="news_item_photo_wrap">
					<div class="news_item_photo">
						<a href="#"><img src="images/data/n3.jpg" alt=""></a>
					</div>
					<div class="news_item_date">
						16.04.2014 в 15:42
					</div>
				</div>
				<div class="news_item_content">
					<div class="news_item_title">
						<a href="#">У новій Верховній Раді буде 27 комітетів</a>
					</div>
					<div class="news_item_text">
						Про це повідомив представник об’єднання
					</div>
				</div>
			</li>
			<li class="news_item">
				<div class="news_item_photo_wrap">
					<div class="news_item_photo">
						<a href="#"><img src="images/data/n4.jpg" alt=""></a>
					</div>
					<div class="news_item_date">
						16.04.2014 в 15:42
					</div>
				</div>
				<div class="news_item_content">
					<div class="news_item_title">
						<a href="#">ВВП України скоротиться на 7% – Яценюк</a>
					</div>
					<div class="news_item_text">
						При цьому дефіцит бюджету складає 4%
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>

