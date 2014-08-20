<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    <meta name="title" content="<?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>" />
	<meta name="description" content="<?php echo Yii::t('main', 'Где в Черкассах? Поиск в городе организаций, зданий, объектов, городской фотогид') ?>" />
    <meta property="og:title" content="<?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?>" />
    <meta property="og:description" content="<?php echo Yii::t('main', 'Где в Черкассах? Поиск в городе организаций, зданий, объектов, городской фотогид') ?>" />
    <meta property="og:url" content="http://www.gde.ck.ua" />
    <meta property="og:image" content="/img/logo.png" />
    <meta name='yandex-verification' content='72cc09e6d8e79d9c' />
    <link rel="stylesheet" href="/css/foundation.css" />
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/mobile.css" />
    <link rel="stylesheet" href="/css/scroll.css" />
    <link rel="stylesheet" href="/css/jquery.searchselect.css">
    <link rel="stylesheet" href="/css/colorbox.css">
    <link href="/css/jquery.jgrowl.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script src="/js/vendor/modernizr.js"></script>
    <script src="/js/jquery.slimscroll.min.js"></script>
    <script src="/js/jquery.searchselect.min.js"></script>
    <script src="/js/jquery.colorbox-min.js"></script>
    <script src="/js/salvattore.js"></script>
    <script type="text/javascript" src="/js/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="/js/feedback.js"></script>

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

    <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" />
    <base href="<?php echo Yii::app()->baseUrl; ?>">
</head>

<body>
    <header>
        <div class="top-menu">
            <div class="row collapse top-menu">
                <div class="large-12 columns">
                    <nav class="top-bar" data-topbar>
                        <ul class="title-area">
                            <li class="name">
                                <h1></h1>
                            </li>
                            <li class="toggle-topbar menu-icon"><a href="#"><?php echo Yii::t('main', 'Меню'); ?></a></li>
                        </ul>

                        <section class="top-bar-section">
                            <!-- Right Nav Section -->
                            <div class="right currency">
                                <?php $this->renderPartial('/partials/_social'); ?>
                            </div>
                            <div class="right lang">
                                <?php $this->renderPartial('/partials/_language'); ?>
                            </div>
                            <!-- Left Nav Section -->
                            <ul class="left">
                                <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>"><?php echo Yii::t('main', 'Главная'); ?></a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>"><?php echo Yii::t('main', 'Новости'); ?></a></li>
                                <?php /*
                                <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/webCamera'); ?>"><?php echo Yii::t('main', 'Веб-камера'); ?></a></li>
                                */ ?>
                                <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo'); ?>"><?php echo Yii::t('main', 'Фото города'); ?></a></li>
                                <li class="last-menu-item"><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/about'); ?>"><?php echo Yii::t('main', 'О проекте'); ?></a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/add'); ?>"><?php echo Yii::t('main', 'ДОБАВИТЬ ОБЪЕКТ'); ?></a></li>
                            </ul>
                        </section>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row collapse search-panel">
            <div class="large-3 columns">
                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>"><img src="/img/logo.png"></a>
                <p><?php echo Yii::t('main', 'Уже'); ?> <?php echo Yii::app()->session['totalItemCount']; ?> <?php echo CHtml::encode(Yii::t('main', 'объектов')); ?></p>
            </div>
            <div class="large-9 columns">
                <?php $this->renderPartial('/partials/_search', []); ?>
            </div>
        </div>
    </header>

    <!-- REKLAMA -->
    <div class="row collapse">
        <?php $this->renderPartial('/partials/_ads'); ?>
    </div>

    <div id="content">
        <div class="row content-inner">
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="some-text">
            <div class="row">
                <hr>
                <div class="large-12 columns">
                    <p>
                        <?php $this->renderPartial('/partials/_find_' . Yii::app()->getLanguage()); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-menu">
            <div class="row collapse">
                <div class="large-12 columns">
                    <div class="row collapse" id='cssmenu'>
                        <div class="large-6  medium-12 small-12 columns">
                            <p><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>">www.gde.ck.ua</a> - <?php echo Yii::t('main', 'Сервис поиска "Где в Черкассах?"'); ?> ©<?php echo Yii::app()->dateFormatter->format('yyyy', time()); ?> <?php echo Yii::t('main', 'Все права защищены'); ?></p>
                        </div>
                        <div class='large-6 medium-12 small-12 columns'>
                            <ul class="right">
                                <li><a href='<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>'><span><?php echo Yii::t('main', 'Новости'); ?></span></a></li>
                                <li><a href='<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/add/'); ?>'><span><?php echo Yii::t('main', 'Добавить объект'); ?></span></a></li>
                                <?php
                                $feedback = $this->feedback;
                                ?>
                                <div id="back">
                                    <a href="#" class="button close-button tiny"><?php echo Yii::t('main', 'Закрыть'); ?></a> <span><p><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></p></span>
                                    <div class="input-form-footer">
                                        <?php $form = $this->beginWidget('CActiveForm',
                                            [
                                                'id' => 'feedback-form',
                                                'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/feedback'),
                                                'enableAjaxValidation' => false,
                                                'htmlOptions' => [],
                                            ]); ?>
                                            <div class="name-field">
                                                <?php echo $form->textField($feedback, 'name', [
                                                        'placeholder' => Yii::t('main', 'Введите Ваши имя и фамилию'),
                                                        'id' => 'name',
                                                        'class' => 'message'
                                                    ]);
                                                ?>
                                                <label id="error_name" class="error"></label>
                                            </div>
                                            <div class="name-field">
                                                <?php echo $form->textField($feedback, 'email', [
                                                        'placeholder' => Yii::t('main', 'Введите Ваш E-mail'),
                                                        'id' => 'email',
                                                        'class' => 'message'
                                                    ]);
                                                ?>
                                                <label id="error_email" class="error"></label>
                                            </div>
                                            <div class="name-field">
                                                <?php echo $form->textArea($feedback, 'message', [
                                                        'placeholder' => Yii::t('main', 'Введите текст сообщения'),
                                                        'id' => 'message',
                                                        'class' => 'message',
                                                        'row' => 15
                                                    ]);
                                                ?>
                                                <label id="error_message" class="error"></label>
                                            </div>
                                            <div class="row">
                                                <div class="large-12 columns captcha">
                                                    <?if(CCaptcha::checkRequirements()):?>
                                                        <?php $this->widget('CCaptcha', ['buttonLabel' => Yii::t('main', 'Обновить'),
                                                                'showRefreshButton' => true,
                                                                'buttonOptions' => [
                                                                    'class' => 'button refresh small left'
                                                                ],
                                                                'buttonType' => 'button',
                                                                'clickableImage' => true
                                                            ]); ?>
                                                    <?endif?>
                                                </div>
                                                <div class="large-12 columns">
                                                    <div class="name-field row">
                                                        <div class="large-8 columns">
                                                            <?php echo $form->textField($feedback, 'verifyCode', [
                                                                    'placeholder' => Yii::t('main', 'Введите код с картинки'),
                                                                    'id' => 'verifyCode',
                                                                    'rows' => 7,
                                                                    'class' => 'captcha-input message'
                                                                ]);
                                                            ?>
                                                            <label id="error_verifyCode" class="error"></label>
                                                        </div>
                                                        <div class="large-4 columns">
                                                            <?php echo CHtml::submitButton(Yii::t('main', 'Отправить'), ['class' => 'button refresh-button left']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php $this->endWidget('feedback'); ?>
                                    </div>
                                </div>
                                <li><a href='javascript:void(0)' class="obratnaya"><span><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></span></a></li>
                                <li><a href='<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/about'); ?>'><span><?php echo Yii::t('main', 'О проекте'); ?></span></a></li>
                            </ul>
                        </div>
                        <?php $this->renderPartial('/partials/_notify'); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function(){
            $(".obratnaya").on('click', function(){
                $("#back").slideToggle("slow");
                $(this).toggleClass("active");
                return false
            });
            $(".close-button").on('click', function(){
                $("#back").slideToggle("slow");
                return false
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            var columnHeight = $(".right-section-cont").height();
            var showAllNews = $(".show-news").height();
            var newsBlockHeight = $(".right-section").height();
            $(".reklama-news-box img").height(columnHeight-showAllNews-newsBlockHeight);

        });
    </script>

    <script>
        (function($){
            $(window).load(function(){
                $(".scroll-pane").mCustomScrollbar({

                });
            });
        })(jQuery);
    </script>

    <script type="text/javascript">
        (function($){
            $(window).load(function(){
                $(".styled-select select .select-inner").mCustomScrollbar({


                });
            });
        })(jQuery);
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var itemsMount = $(".establishment").length;
            if($(itemsMount) <= 5){
                $(".pagination-centered").hide();
            }
        });
    </script>

    <script src="/js/jquery.searchselect.min.js"></script>
    <script src="/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="/js/jquery.mousewheel.min.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script type="text/javascript">
        Foundation.global.namespace = '';
        $(document).foundation();
    </script>


<!-- .footer -->
<!-- Yandex.Metrika counter -->
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
