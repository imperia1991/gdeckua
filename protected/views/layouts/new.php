<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>"/>
    <meta name="description"
          content="<?php echo Yii::t('main', 'Где в Черкассах? Поиск в городе организаций, зданий, объектов, городской фотогид') ?>"/>
    <meta name='yandex-verification' content='72cc09e6d8e79d9c'/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/css/new/normalize.css">
    <link rel="stylesheet" href="/css/new/colorbox.css">
    <link rel="stylesheet" href="/css/new/jquery.bxslider.css">
    <link rel="stylesheet" href="/css/new/style.css">
    <link href="/css/pace.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,700&subset=latin,cyrillic'
          rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,500italic&subset=latin,cyrillic'
          rel='stylesheet'
          type='text/css'>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script src="/js/new/jquery.bxslider.js"></script>
    <script src="/js/new/jquery.colorbox-min.js"></script>
    <script src="/js/new/jquery.freetile.js"></script>
    <script src="/js/pace.min.js"></script>
    <script src="/js/new/script.js"></script>
    <script type="text/javascript" src="/js/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="/js/feedback.js"></script>
    <script type="text/javascript" src="/js/auth.js"></script>

    <!--    <script>-->
    <!--        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){-->
    <!--        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),-->
    <!--        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)-->
    <!--        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');-->
    <!---->
    <!--        ga('create', 'UA-50948800-1', 'gde.ck.ua');-->
    <!--        ga('send', 'pageview');-->
    <!---->
    <!--    </script>-->

    <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>//images/favicon.png"/>
    <base href="<?php echo Yii::app()->baseUrl; ?>">
</head>
<body>
<div class="container">
    <div class="sidebar">
        <div class="sidebar_wrap">
            <div class="sidebar_top">
                <?php $this->renderPartial('/partials/_language'); ?>
                <a href="#" class="menu_icon"></a>
            </div>
            <div class="sidebar_enter">
                <a href="#" class="enter_pop_up_link"><?php echo Yii::t('main', 'Войти'); ?></a>
                <a href="#" class="registr_pop_up_link"><?php echo Yii::t('main', 'Регистрация'); ?></a>
            </div>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/add'); ?>" class="add_place ">+ <?php echo Yii::t('main', 'ДОБАВИТЬ МЕСТО'); ?></a>
            <ul class="menu">
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_DEFAULT): ?> active <?php endif; ?>">
                    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>">
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
                <li class="menu_item <?php if ($this->currentPageType == PageTypes::PAGE_PLACES): ?>active<?php endif; ?>">
                    <a href="#"><span class="menu_item_text"><?php echo CHtml::encode(Yii::t('main', 'Места города')); ?></span>
                        <span class="menu_item_icon icon3"></span></a>
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
                    <a href="#">
                        <span class="menu_item_text"><?php echo Yii::t('main', 'Помочь сайту'); ?></span>
                        <span class="menu_item_icon icon9"></span>
                    </a>
                </li>
            </ul>
            <div class="advertise">
                <div class="advertise_title">
                    <a href="javascript:void(0);"><?php echo Yii::t('main', 'реклама'); ?></a>
                </div>
                <?php $this->renderPartial('/partials/_ads'); ?>
            </div>
        </div>
    </div>
    <div class="content">
        <header class="clearfix">
            <?php $logo = 'logo_' . Yii::app()->getLanguage(); ?>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>" class="logo">
                <img src="/images/<?php echo $logo; ?>.png" alt="<?php echo Yii::t('main', 'Где в Черкассах'); ?>">
            </a>

            <?php $this->renderPartial('/partials/_search', []); ?>
        </header>
        <div class="content_advertise">
                <span class="content_advertise_wrap">
                    <a href="#" class="content_advertise_item"><img src="/images/data/contentban1.jpg" alt=""></a>
                    <a href="#" class="content_advertise_item"><img src="/images/data/contentban2.jpg" alt=""></a>
                </span>
                <span class="content_advertise_wrap">
                    <a href="#" class="content_advertise_item"><img src="/images/data/contentban3.jpg" alt=""></a>
                    <a href="#" class="content_advertise_item"><img src="/images/data/contentban4.jpg" alt=""></a>
                </span>
        </div>
        <nav class="clearfix">
            <ul class="breadcrumbs">
                <li><a href="#">Главная</a></li>
            </ul>
            <div class="nav_date">24 ноября, 2014</div>
        </nav>
        <div class="page_content">
            <div class="block_with_map clearfix">
                <div class="block_with_map_left">

                    <script type="text/javascript"
                            charset="utf-8"
                            src="http://api-maps.yandex.ru/services/constructor/1.0/js/?sid=VmG6h2HaO5j43R7K8XnnTXBcsmrwH9MU"></script>

                </div>
                <div class="block_with_map_left_right">
                    <div class="cathegories">
                        <a href="#" class="cathegories_item active">Объекты</a>
                        <a href="#" class="cathegories_item">Акции</a>
                        <a href="#" class="cathegories_item">Афиша</a>
                        <a href="#" class="cathegories_item">Кино</a>
                    </div>
                    <div class="objects clearfix">
                        <div class="object_item">
                            <div class="object_item_block">
                                <div class="object_item_photo">
                                    <a href="/images/data/1-1.png" class="colorbox"><img src="/images/data/1-1.png"
                                                                                        alt=""></a>
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
                                    <a href="/images/data/2-1.png" class="colorbox"><img src="/images/data/2-1.png"
                                                                                        alt=""></a>
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
                                    <a href="/images/data/1-1.png" class="colorbox"><img src="/images/data/1-1.png"
                                                                                        alt=""></a>
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
                                    <a href="/images/data/2-1.png" class="colorbox"><img src="/images/data/2-1.png"
                                                                                        alt=""></a>
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
                                    <a href="/images/data/1-1.png" class="colorbox"><img src="/images/data/1-1.png"
                                                                                        alt=""></a>
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
                                    <a href="/images/data/2-1.png" class="colorbox"><img src="/images/data/2-1.png"
                                                                                        alt=""></a>
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
                <div class="title"><a href="#">НОВОСТИ</a></div>
                <ul class="home_news_list clearfix">
                    <li class="home_news_item">
                        <a href="#">
                            <div class="home_news_item_text">
                                Sinoptik: Погода в Черкасах та Черкаській області на вівторо 25 листопада
                            </div>
                            <div class="home_news_item_date">
                                23 листопада 14:54
                            </div>
                        </a>
                    </li>
                    <li class="home_news_item">
                        <a href="#">
                            <div class="home_news_item_text">
                                Украинцы на референдуме примут решение, вступать ли государству в НАТО или нет
                            </div>
                            <div class="home_news_item_date">
                                23 листопада 14:54
                            </div>
                        </a>
                    </li>
                    <li class="home_news_item">
                        <a href="#">
                            <div class="home_news_item_text">
                                Украинцы на референдуме примут решение, вступать ли государству в НАТО или нет
                            </div>
                            <div class="home_news_item_date">
                                23 листопада 14:54
                            </div>
                        </a>
                    </li>
                    <li class="home_news_item">
                        <a href="#">
                            <div class="home_news_item_text">
                                Sinoptik: Погода в Черкасах та Черкаській області на вівторо 25 листопада
                            </div>
                            <div class="home_news_item_date">
                                23 листопада 14:54
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="photos">
                <div class="title"><a href="#">ФОТО ГОРОДА</a></div>
                <ul class="photos_list clearfix">
                    <li class="photos_item">
                        <div class="photos_item_wrap">
                            <div class="photos_item_image">
                                <a href="#"><img src="/images/data/photo1.jpg" alt=""></a>
                            </div>
                            <div class="photos_item_mask">
                                <div class="photos_item_title">
                                    ЧНУ
                                </div>
                                <div class="photos_item_author">
                                    фото: Євген
                                </div>
                                <a href="/images/data/photo1.jpg"
                                   class="photos_item_link colorbox"
                                   title="ЧНУ">Увеличить</a>
                            </div>
                        </div>
                    </li>
                    <li class="photos_item">
                        <div class="photos_item_wrap">
                            <div class="photos_item_image">
                                <a href="#"><img src="/images/data/photo2.jpg" alt=""></a>
                            </div>
                            <div class="photos_item_mask">
                                <div class="photos_item_title">
                                    ЧНУ
                                </div>
                                <div class="photos_item_author">
                                    фото: Євген
                                </div>
                                <a href="/images/data/photo2.jpg"
                                   class="photos_item_link colorbox"
                                   title="ЧНУ">Увеличить</a>
                            </div>
                        </div>
                    </li>
                    <li class="photos_item">
                        <div class="photos_item_wrap">
                            <div class="photos_item_image">
                                <a href="#"><img src="/images/data/photo3.jpg" alt=""></a>
                            </div>
                            <div class="photos_item_mask">
                                <div class="photos_item_title">
                                    ЧНУ
                                </div>
                                <div class="photos_item_author">
                                    фото: Євген
                                </div>
                                <a href="/images/data/photo3.jpg"
                                   class="photos_item_link colorbox"
                                   title="ЧНУ">Увеличить</a>
                            </div>
                        </div>
                    </li>
                    <li class="photos_item">
                        <div class="photos_item_wrap">
                            <div class="photos_item_image">
                                <a href="#"><img src="/images/data/photo3.jpg" alt=""></a>
                            </div>
                            <div class="photos_item_mask">
                                <div class="photos_item_title">
                                    ЧНУ
                                </div>
                                <div class="photos_item_author">
                                    фото: Євген
                                </div>
                                <a href="/images/data/photo3.jpg" class="photos_item_link colorbox " title="ЧНУ">Увеличить</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="page_text">
                Вы не нашли объект или организацию которую искали? Напишите нам в “Обратную связь” или добавьте
                самостоятельно воспользовавшись функцией “Добавить объект”. По вопросам сотрудничества, размещение
                рекламы, новостных статей обращайтесь через “Обратную связь” или напишите письмо по адресу
                support@gde.ck.ua
            </div>
        </div>
        <footer class="clearfix">
            <div class="footer_text">
                <div class="copyright">©2014-2015 <a href="#">www.gde.ck.ua</a> - "Где в Черкассах"</div>
                Перепечатка и иное использование материалов,
                присутствующие на разрешается при условии
                ссылки на www.gde.ck.ua. Интернет-издания могут
                использовать материалы сайта, размещать видео
                при условии гиперссылки на www.gde.ck.ua.
                запрещено перепечатка и использование материалов,
                в которых содержится ссылка на агентства
                Интерфакс-Украина, УНИАН, Reuters, Associated Press
                материалы обозначены меткой "Реклама"
                публикуются на<br/>
                Все права защищены
            </div>
            <ul class="footer_links">
                <li><a href="">Главная</a></li>
                <li><a href="">Новости</a></li>
                <li><a href="">Барахолка</a></li>
                <li><a href="">Афиша</a></li>
                <li><a href="">Фотоблог</a></li>
                <li><a href="">Фото города</a></li>
                <li><a href="">Вэб камеры</a></li>
                <li><a href="">О проекте</a></li>
                <li><a href="">Обратная связь</a></li>
                <li><a href="">Помощь сайту</a></li>
            </ul>
            <div class="footer_facebook">
                <img src="/images/data/fb.jpg" alt="">
            </div>
            <div class="footer_vk">
                <img src="/images/data/vk.jpg" alt="">
            </div>
        </footer>
    </div>
    <div class="right_block">
        <a href="#" class="right_block_go_bot">вниз</a>
        <a href="#" class="right_block_go_top">вверх</a>
    </div>
    <div class="cover"></div>
    <div class="select_cover"></div>
</div>

<!-- Yandex.Metrika counter-->
<!--<script type="text/javascript">-->
<!--(function (d, w, c) {-->
<!--    (w[c] = w[c] || []).push(function() {-->
<!--        try {-->
<!--            w.yaCounter24984920 = new Ya.Metrika({id:24984920,-->
<!--                    clickmap:true,-->
<!--                    trackLinks:true,-->
<!--                    accurateTrackBounce:true});-->
<!--        } catch(e) { }-->
<!--    });-->
<!---->
<!--    var n = d.getElementsByTagName("script")[0],-->
<!--        s = d.createElement("script"),-->
<!--        f = function () { n.parentNode.insertBefore(s, n); };-->
<!--    s.type = "text/javascript";-->
<!--    s.async = true;-->
<!--    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";-->
<!---->
<!--    if (w.opera == "[object Opera]") {-->
<!--        d.addEventListener("DOMContentLoaded", f, false);-->
<!--    } else { f(); }-->
<!--})(document, window, "yandex_metrika_callbacks");-->
<!--</script>-->
<!--<noscript><div><img src="//mc.yandex.ru/watch/24984920" style="position:absolute; left:-9999px;" alt="" /></div></noscript>-->
<!-- /Yandex.Metrika counter -->
</body>
</html>