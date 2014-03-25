<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="/images/lightgallery/skins/default/style.css" rel="stylesheet">

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script type="text/javascript" src="/js/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="/js/lightgallery.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript">
        lightgallery.init();
    </script>

    <base href="<?php echo Yii::app()->baseUrl; ?>">
</head>

<body>
<div class="wrapper">
    <?php $this->renderPartial('/partials/_language'); ?>
    <div class="header-bg">
        <div class="header">
            <a href="/">
                <img class="d" src="images/logo.png" alt="">
                <img class="m" src="images/m/logo.png" alt="">
            </a>
        </div>
    </div><!-- .header-->
    <div class="middle">
        <?php $this->renderPartial('/partials/_welcome_' . Yii::app()->language); ?>

        <?php echo $content; ?>
        <div class="back-top"></div>
    </div>
</div>
<div class="footer-bg">
    <div class="footer">
        <div>
            <span class="d"><a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->hostInfo; ?> - <?php echo Yii::t('main', 'Сервис поиска "Где в Черкассах?"'); ?></a> © <?php echo Yii::app()->dateFormatter->format('yyyy', time()); ?> <?php echo Yii::t('main', 'Все права защищены'); ?></span>
            <span class="m"><a href="<?php echo Yii::app()->request->hostInfo; ?>"><?php echo Yii::app()->request->hostInfo; ?> - <?php echo Yii::t('main', 'Сервис поиска "Где в Черкассах?"'); ?></a> © <?php echo Yii::app()->dateFormatter->format('yyyy', time()); ?> <?php echo Yii::t('main', 'Все права защищены'); ?></span>
            <a href="#feedback" class="call-popup"><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></a>
            <a href="#organization-add" class="call-popup" style="border-right: none;"><?php echo CHtml::encode(Yii::t('main', 'Добавить объект')); ?></a>
        </div>
    </div>
</div><!-- .footer -->

<!-- popups -->
<div class="popup popup-hidden" id="organization-add">
    <div class="popup-bg">
        <form>
            <input class="large" type="text" placeholder="Введите название организации" name="name" id="name" value="">
            <input class="large" type="text" placeholder="Введите Город расположения" name="town" id="town" value="">
            <input class="large" type="text" placeholder="Введите точный адрес расположения" name="address" id="address" value="">
            <input class="large" type="text" placeholder="Район города" name="area" id="area" value="">
            <input class="large" type="text" placeholder="Телефон в формате +38 0472 66-56-58" name="phone" id="phone" value="">
        </form>
        <div class="left center" style="width: 39%;">
            <img src="images/add-photo.png" alt="">
            <input type="button" value="Загрузить" class="btn">
        </div>
        <div class="left center" style="width: 61%;">
            <img src="images/captcha.png" alt="">
            <input class="big" type="text" placeholder="Введите код" name="captcha" id="captcha" value="">
            <input type="button" value="Добавить" class="btn">
            <div class="block">
                <input type="button" value="Закрыть" class="btn close-popup">
            </div>
        </div>
    </div>
</div>

<div class="popup popup-hidden" id="feedback">
    <div class="popup-bg">
        <form>
            <input class="large" type="text" placeholder="Введите Ваши имя и фамилию" name="name" id="name" value="">
            <input class="large" type="text" placeholder="Введите Ваш E-mail" name="email" id="email" value="">
            <textarea class="large" placeholder="Оставьте Ваше сообщение" name="message" id="message"></textarea>
        </form>
        <div class="half left center">
            <img src="images/captcha.png" alt="">
        </div>
        <div class="half left center">
            <input class="big" type="text" placeholder="Введите код" name="captcha" id="captcha" value="">
            <input type="button" value="Отправить" class="btn">
            <div class="block">
                <input type="button" value="Закрыть" class="btn close-popup">
            </div>
        </div>
    </div>
</div>
</body>
</html>
