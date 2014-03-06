<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Aviators - byaviators.com">

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

        <base href="<?php echo Yii::app()->baseUrl; ?>">

        <title><?php echo CHtml::encode(Yii::t('main', Yii::app()->name)) . ' | ' . CHtml::encode(Yii::t('main', $this->pageTitle)); ?></title>
    </head>

    <body>
        <?php $this->renderPartial('/partials/_language'); ?>
        <?php
        $hour = date('G');
        echo $hour > 6 && $hour < 18 ? 'Утро / День' : 'Вечер / Ночь';
        ?>
        <?php echo $content; ?>
    </body>
</html>
