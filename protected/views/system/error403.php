<?php
$this->pageTitle   = Yii::t('main', 'Ошибка 503');
$this->breadcrumbs = [
    '' => Yii::t('main', 'Ошибка 503')
];

?>

<div class="no-find">

    <h6><?php echo Yii::t('main', 'Доступ запрещен!'); ?> :(</h6>

    <p>
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/main') ?>">
            <?php echo Yii::t('main', 'перейти на главную'); ?>
        </a>
    </p>
    <img src="/images/nothing-find.png">
</div>