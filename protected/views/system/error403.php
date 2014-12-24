<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Ошибка 503')
];
$this->renderPartial('/partials/_breadcrumbs');
?>
<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-4 medium-3 columns left-sector-error">
            <div class="error-page">
                <ul>
                    <li><?php echo Yii::t('main', 'Доступ запрещен!'); ?> :(</li>
                    <li class="large-font-error">403</li>
                </ul>
            </div>
            <div><p><a href="/"><?php echo Yii::t('main', 'перейти на главную'); ?></a></p></div>
        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>

    </div>
</div>