<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>"/>
    <meta name="description"
          content="<?php echo Yii::t('main', 'Где в Черкассах. Поиск в городе организаций, зданий, объектов, городской фотогид') ?>"/>
    <meta name='yandex-verification' content='72cc09e6d8e79d9c'/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/colorbox.css">
    <link rel="stylesheet" href="/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/css/jquery.jgrowl.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/pace.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,700&subset=latin,cyrillic'
          rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,500italic&subset=latin,cyrillic'
          rel='stylesheet'
          type='text/css'>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script src="/js/jquery.bxslider.js"></script>
    <script src="/js/jquery.colorbox-min.js"></script>
    <script src="/js/jquery.freetile.js"></script>
    <script src="/js/pace.min.js"></script>
    <script src="/js/script.js"></script>
    <script type="text/javascript" src="/js/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="/js/feedback.js"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-50948800-1', 'gde.ck.ua');
        ga('send', 'pageview');

    </script>

    <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png"/>
    <base href="<?php echo Yii::app()->baseUrl; ?>">
</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&appId=229877880358538&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="container">

    <?php $this->renderPartial('/partials/_notify'); ?>

    <div class="sidebar">
        <div class="sidebar_wrap">
            <div class="sidebar_top">
                <?php $this->renderPartial('/partials/_language'); ?>
                <a href="#" class="menu_icon"></a>
            </div>
            <?php /*
            <div class="sidebar_enter">
                <a href="#" class="enter_pop_up_link"><?php echo Yii::t('main', 'Войти'); ?></a>
                <a href="#" class="registr_pop_up_link"><?php echo Yii::t('main', 'Регистрация'); ?></a>
            </div>
            */ ?>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place/add'); ?>" class="add_place ">+ <?php echo Yii::t('main', 'ДОБАВИТЬ МЕСТО'); ?></a>
            <ul class="menu">
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_DEFAULT): ?> active <?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/main'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Главная'); ?></span>
                        <span class="menu_item_icon icon1"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_NEWS): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Новости'); ?></span>
                        <span class="menu_item_icon icon2"></span>
                    </a>
                </li>
	            <?php /* if (Yii::app()->user->checkAccess(Users::ROLE_MUSER)): ?>
		            <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_MUSER): ?>active<?php endif; ?>">
			            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/mnews'); ?>">
				            <span class="menu_item_text"><?php echo Yii::t('main', 'Редактирование новостей'); ?></span>
				            <span class="menu_item_icon icon2"></span>
			            </a>
		            </li>
	            <?php endif; */ ?>
	            <?php if (Yii::app()->user->checkAccess(Users::ROLE_CHASHKA)): ?>
		            <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_CHASHKA_CHE): ?>active<?php endif; ?>">
			            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/chashka-che'); ?>">
				            <span class="menu_item_text"><?php echo Yii::t('main', 'Чашка Кави.Че'); ?></span>
				            <span class="menu_item_icon icon2"></span>
			            </a>
		            </li>
	            <?php endif; ?>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_PLACES): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>">
                        <span class="menu_item_text"><?php echo CHtml::encode(Yii::t('main', 'Места города')); ?></span>
                        <span class="menu_item_icon icon3"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_WEBCAMS): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/webcams'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Веб-камеры'); ?></span>
                        <span class="menu_item_icon icon4"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_POSTERS): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/poster'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Афиши'); ?></span>
                        <span class="menu_item_icon icon5"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_PHOTO_CITY): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Фото города'); ?></span>
                        <span class="menu_item_icon icon6"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_ABOUT): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/about'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'О проекте'); ?></span>
                        <span class="menu_item_icon icon7"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_FEEDBACK): ?>active<?php endif; ?>">
                    <a href="#" class="feedback_link">
                        <span class="menu_item_text"><?php echo CHtml::encode(Yii::t('main', 'Связь с нами')); ?></span>
                        <span class="menu_item_icon icon8"></span>
                    </a>
                </li>
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_HELP_SITE): ?>active<?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/about#help'); ?>">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Помочь сайту'); ?></span>
                        <span class="menu_item_icon icon9"></span>
                    </a>
                </li>
	            <?php if (!Yii::app()->user->isGuest): ?>
		            <li class="menu_item" style="border-bottom: 1px solid #5d5e5e">
		            </li>
		            <?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN) || Yii::app()->user->checkAccess(Users::ROLE_CHASHKA)): ?>
		            <li class="menu_item">
			            <a href="<?php echo Yii::app()->createUrl('/admin'); ?>">
				            <span class="menu_item_text"><?php echo Yii::t('admin', 'Админпанель'); ?></span>
				            <span class="menu_item_icon icon7"></span>
			            </a>
		            </li>
		            <?php endif; ?>
	                <li class="menu_item">
	                    <a href="<?php echo Yii::app()->createUrl('/logout'); ?>">
	                        <span class="menu_item_text"><?php echo Yii::t('main', 'Выйти'); ?></span>
	                        <span class="menu_item_icon icon7"></span>
	                    </a>
	                </li>
	            <?php endif; ?>
            </ul>
            <div class="advertise">
                <div class="advertise_title">
                    <a href="javascript:void(0);"><?php echo Yii::t('main', 'реклама'); ?></a>
                </div>
                <?php $this->renderPartial('/partials/_adsLeft'); ?>
            </div>
        </div>
    </div>
    <div class="content">
        <header class="clearfix">
            <?php $logo = 'logo_' . Yii::app()->getLanguage(); ?>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/main'); ?>" class="logo">
                <img src="/images/<?php echo $logo; ?>.png" alt="<?php echo Yii::t('main', 'Где в Черкассах'); ?>">
            </a>

            <?php $this->renderPartial('/partials/_search', []); ?>
        </header>
        <div class="content_advertise">
            <?php $this->renderPartial('/partials/_adsTop'); ?>
        </div>
        <nav class="clearfix">
            <?php $this->renderPartial('/partials/_breadcrumbs'); ?>

            <div class="nav_date">
                <?php echo Yii::app()->dateFormatter->format('d MMMM yyyy', time()); ?>
            </div>
        </nav>

        <?php echo $content; ?>

        <footer class="clearfix">
            <div class="footer_text">
                <div class="copyright">©<?php echo Yii::app()->dateFormatter->format('yyyy', time()); ?>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>">www.gde.ck.ua</a>
                                       - "<?php echo Yii::t('main', 'Где в Черкассах'); ?>"
                </div>
                <?php $this->renderPartial('/partials/_signature_' . Yii::app()->getLanguage()); ?>
                <br/>
                <?php echo Yii::t('main', 'Все права защищены'); ?>
            </div>
            <ul class="footer_links">
                <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/main'); ?>">
                        <?php echo Yii::t('main', 'Главная'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>">
                        <?php echo Yii::t('main', 'Новости'); ?>
                    </a>
                </li>
                <li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>"><span class="menu_item_text"><?php echo CHtml::encode(Yii::t('main', 'Места города')); ?></a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/webcams'); ?>">
                        <?php echo Yii::t('main', 'Веб-камеры'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/poster'); ?>">
                        <?php echo Yii::t('main', 'Афиши'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo'); ?>">
                        <?php echo Yii::t('main', 'Фото города'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/about'); ?>">
                        <?php echo Yii::t('main', 'О проекте'); ?>
                    </a>
                </li>
                <li>
                    <a href="#" class="feedback_link">
                        <?php echo CHtml::encode(Yii::t('main', 'Связь с нами')); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/about#help'); ?>">
                        <?php echo Yii::t('main', 'Помочь сайту'); ?>
                    </a>
                </li>
            </ul>
            <div class="footer_facebook">
                <?php $this->renderPartial('/partials/_fbclub'); ?>
            </div>
            <div class="footer_vk">
                <?php $this->renderPartial('/partials/_vkclub'); ?>
            </div>
        </footer>
    </div>
    <div class="right_block">
        <a href="#" class="right_block_go_bot"><?php echo Yii::t('main', 'вниз') ?></a>
        <a href="#" class="right_block_go_top"><?php echo Yii::t('main', 'вверх') ?></a>
    </div>
    <div class="cover"></div>
    <div class="select_cover"></div>
</div>

<?php $this->renderPartial('/partials/_popups'); ?>

 Yandex.Metrika counter
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter24984920 = new Ya.Metrika({id:24984920,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/24984920" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
 /Yandex.Metrika counter
</body>
</html>