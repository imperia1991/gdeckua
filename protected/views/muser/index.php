<?php
$this->pageTitle = Yii::t('main', 'Мой кабинет');

$this->breadcrumbs = [
	'' => Yii::t('main', 'Мой кабинет')
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
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/password'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Изменить пароль'); ?>
			</a>
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/muser/blog'); ?>" class="cathegories_item">
				<?php echo Yii::t('main', 'Мои блоги'); ?>
			</a>
		</div>
		<div class="add_object">
			<form>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Название <span class="nes">*</span>
					</div>
					<div class="input_wrap ">
						<input type="text" class="input error">
						<span class="input_error">Ошибка</span>
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Район  <span class="nes">*</span>
					</div>
					<div class="input_wrap">
						<div class="select">
							<a href="javascript:void(0);" class="slct"> </a>
							<ul class="drop">
								<li><a href="#">Центр</a></li>
								<li><a href="#">Розы Люксемберг</a></li>
								<li><a href="#">Героев Сталинграда</a></li>
								<li><a href="#">Героев Днепра</a></li>
								<li><a href="#">Дахновка</a></li>
								<li><a href="#">ЮЗР</a></li>
							</ul>
							<input type="hidden"  />
						</div>
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Адрес  <span class="nes">*</span>
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Краткое описание  <span class="nes">*</span>
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Описание  <span class="nes">*</span>
					</div>
					<div class="input_wrap">
						<textarea class="input"></textarea>
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Тел. городской
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Тел. мобильный
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Тел. мобильный
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Тел. мобильный
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Факс
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						E-mail
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Skype
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Время работы
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_wrap">
					<div class="form_input_label">
						Сайт
					</div>
					<div class="input_wrap">
						<input type="text" class="input">
					</div>
				</div>
				<div class="form_input_bottom clearfix">
					<div class="captcha_block">
						<div class="captcha_image">
							<img src="images/data/captcha.jpg" alt="">
							<a href="#" class="captcha_refresh">Обновить</a>
						</div>
						<input type="text" class="input captcha_input" placeholder="Введите код с картинки">
					</div>
					<input type="submit" value="Добавить" class="submit">
				</div>
			</form>
		</div>
	</div>
</div>

