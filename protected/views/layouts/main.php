<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>" />
	<meta name="description" content="" />
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="/css/highslide.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script type="text/javascript" src="/js/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="/js/highslide-with-gallery.js"></script>
    <script type="text/javascript" src="/js/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript">
        hs.graphicsDir = '/js/graphics/';
        hs.showCredits = false;
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.fadeInOut = true;
        hs.outlineType = 'glossy-dark';
        hs.wrapperClassName = 'dark';
        //hs.captionEval = 'this.a.title';
        //hs.numberPosition = 'caption';
        hs.useBox = true;
        hs.width = 600;
        hs.height = 400;
        hs.dimmingOpacity = 0.8;

        // Add the slideshow providing the controlbar and the thumbstrip
        hs.addSlideshow({
            //slideshowGroup: 'group1',
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                position: 'bottom center',
                opacity: 0.75,
                hideOnMouseOut: true
            },
            thumbstrip: {
                position: 'above',
                mode: 'horizontal',
                relativeTo: 'expander'
            }
        });
    </script>
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png" />
    <base href="<?php echo Yii::app()->baseUrl; ?>">
</head>

<body>
<div class="wrapper">
    <?php $this->renderPartial('/partials/_language'); ?>
    <div class="header-bg">
        <div class="header">
            <a href="/">
                <img class="d" src="/images/logo_<?php echo Yii::app()->language ?>.png" alt="<?php echo CHtml::encode(Yii::t('main', Yii::app()->name)); ?>">
            </a>
        </div>
    </div><!-- .header-->
    <div class="middle">

        <?php echo $content; ?>

        <a href="#" class="tooltip-top">
            <div class="back-top"><span><?php echo Yii::t('main', 'Наверх'); ?></span></div>
        </a>
    </div>
</div>
<div class="footer-bg">
    <div class="footer">
        <div class="footer-wrap">
            <?php echo Yii::app()->request->serverName; ?> - <?php echo Yii::t('main', 'Сервис поиска "Где в Черкассах?"'); ?> © <?php echo Yii::app()->dateFormatter->format('yyyy', time()); ?> <?php echo Yii::t('main', 'Все права защищены'); ?>
            <?php /*
            <a href="#feedback" class="link call-popup"><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></a>
             */?>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/add/'); ?>" class="link" style="border-right: none;"><?php echo CHtml::encode(Yii::t('main', 'Добавить объект')); ?></a>
        </div>
        <div class="popup popup-hidden" id="feedback">
            <h2><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></h2>
            <div class="block">
                <a href="#" class="btn close-popup"><?php echo Yii::t('main', 'Закрыть'); ?></a>
            </div>
            <div class="popup-bg">
                <form id="feeadback">
                    <input type="text" placeholder="<?php echo Yii::t('main', 'Введите Ваши имя и фамилию'); ?>" name="name" id="name" value="">
                    <label class="error" for="name"></label>
                    <input type="text" placeholder="<?php echo Yii::t('main', 'Введите Ваш E-mail'); ?>" name="email" id="email" value="">
                    <label class="error" for="name"></label>
                    <textarea rows="7" placeholder="<?php echo Yii::t('main', 'Введите текст сообщения'); ?>" name="message" id="message"></textarea>
                    <label class="error" for="message"></label>
                </form>
                <div class="captcha-wrap">
                    <?if(CCaptcha::checkRequirements()):?>
                        <?php $this->widget('CCaptcha', array('buttonLabel' => Yii::t('main', 'Обновить'))); ?>
                    <?endif?>
                </div>
                <input class="captcha-input" type="text" placeholder="<?php echo Yii::t('main', 'Введите код с картинки'); ?>" name="captcha" id="captcha" value="">
                <input type="submit" value="<?php echo Yii::t('main', 'Отправить'); ?>" class="btn submit-popup">
            </div>
        </div>
    </div>
</div><!-- .footer -->


</body>
</html>
