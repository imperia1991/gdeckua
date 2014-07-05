<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>" />
	<meta name="description" content="Где в Черкассах? Поиск в городе организаций, зданий, объектов, городской фотогид" />
    <meta name='yandex-verification' content='72cc09e6d8e79d9c' />
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="/css/jquery.jgrowl.css" rel="stylesheet">
    <link href="/css/highslide.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script type="text/javascript" src="/js/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="/js/highslide-with-gallery.js"></script>
    <script type="text/javascript" src="/js/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="/js/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="/js/feedback.js"></script>
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

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-50948800-1', 'gde.ck.ua');
        ga('send', 'pageview');

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
            <a href="#feedback" class="link call-popup"><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></a>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/add/'); ?>" class="link" style="border-right: none;"><?php echo CHtml::encode(Yii::t('main', 'Добавить объект')); ?></a>
        </div>
        <div class="popup popup-hidden" id="feedback">
            <h2><?php echo CHtml::encode(Yii::t('main', 'Обратная связь')); ?></h2>
            <div class="block">
                <a href="#" class="btn close-popup"><?php echo Yii::t('main', 'Закрыть'); ?></a>
            </div>
            <div class="popup-bg">
                <?php
                $feedback = $this->feedback;
                ?>
                <?php $form = $this->beginWidget('CActiveForm',
                    array(
                        'id' => 'feedback-form',
                        'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/feedback'),
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array(),
                    )); ?>
                    <?php echo $form->textField($feedback, 'name', array(
                            'placeholder' => Yii::t('main', 'Введите Ваши имя и фамилию'),
                            'id' => 'name',
                            'class' => 'message'
                        ));
                    ?>
                    <label id="error_name" class="error" for="name"></label>
                    <?php echo $form->textField($feedback, 'email', array(
                            'placeholder' => Yii::t('main', 'Введите Ваш E-mail'),
                            'id' => 'email',
                            'class' => 'message'
                        ));
                    ?>
                    <label id="error_email" class="error" for="email"></label>
                    <?php echo $form->textArea($feedback, 'message', array(
                            'placeholder' => Yii::t('main', 'Введите текст сообщения'),
                            'id' => 'message',
                            'rows' => 7,
                            'class' => 'message'
                        ));
                    ?>
                    <label id="error_message" class="error" for="message"></label>
                    <div class="captcha-wrap">
                        <?if(CCaptcha::checkRequirements()):?>
                            <?php $this->widget('CCaptcha', array('buttonLabel' => Yii::t('main', 'Обновить'))); ?>
                        <?endif?>
                        <br/>
                        <label id="error_verifyCode" class="error" for="verifyCode"></label>
                    </div>
                    <?php echo $form->textField($feedback, 'verifyCode', array(
                            'placeholder' => Yii::t('main', 'Введите код с картинки'),
                            'id' => 'verifyCode',
                            'rows' => 7,
                            'class' => 'captcha-input message'
                        ));
                    ?>

                    <?php echo CHtml::submitButton(Yii::t('main', 'Отправить'), array('class' => 'btn submit-popup')); ?>
                <?php $this->endWidget('feedback'); ?>
            </div>
        </div>
        <?php $this->renderPartial('/partials/_notify'); ?>
    </div>
</div><!-- .footer -->
<!-- Yandex.Metrika counter -->
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
<!-- /Yandex.Metrika counter -->
</body>
</html>
