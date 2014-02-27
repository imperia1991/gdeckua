<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Aviators - byaviators.com">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="/css/bootstrap-responsive.css" type="text/css">
        <link rel="stylesheet" href="/libraries/chosen/chosen.css" type="text/css">
        <link rel="stylesheet" href="/libraries/bootstrap-fileupload/bootstrap-fileupload.css" type="text/css">
        <link rel="stylesheet" href="/libraries/jquery-ui-1.10.2.custom/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" type="text/css">
        <link rel="stylesheet" href="/css/realia-blue.css" type="text/css" id="color-variant-default">
        <link rel="stylesheet" href="/css/style.css" type="text/css" id="color-variant-default">

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

        <base href="<?php echo Yii::app()->baseUrl; ?>">

        <title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    </head>

    <body>
        <div id="wrapper-outer" >
            <div id="wrapper">
                <div id="wrapper-inner">
                    <!-- BREADCRUMB -->
                    <?php echo $this->renderPartial('/partials/_breadcrumb'); ?>
                    <!-- HEADER -->
                    <?php echo $this->renderPartial('/partials/_header'); ?>
                    <!-- NAVIGATION -->
                    <?php echo $this->renderPartial('/partials/_navigation'); ?>

                    <!-- CONTENT -->
                    <div id="content">
                        <div class="container">
                            <?php $this->renderPartial('/partials/_messages'); ?>
                            
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div><!-- /#wrapper-inner -->

                <?php $this->renderpartial('/partials/_footer'); ?>
            </div><!-- /#wrapper -->
        </div><!-- /#wrapper-outer -->

        <script type="text/javascript" src="/js/jquery.ezmark.js"></script>
        <script type="text/javascript" src="/js/jquery.currency.js"></script>
        <script type="text/javascript" src="/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/js/retina.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/carousel.js"></script>
        <script type="text/javascript" src="/libraries/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="/libraries/iosslider/_src/jquery.iosslider.min.js"></script>
        <script type="text/javascript" src="/js/realia.js"></script>
    </body>
</html>
