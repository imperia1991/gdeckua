<div class="large-12 columns navigation-top">
    <p>
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>"><?php echo Yii::t('main', 'Главная') ?></a>
        >
        <?php foreach ($this->breadcrumbs as $url => $breadcrumb): ?>
            <?php if (!empty($url)): ?>
                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/' . $url); ?>"><?php echo $breadcrumb; ?></a>
            <?php else: ?>
                <?php
                    $this->pageTitle = $breadcrumb;
                    echo $breadcrumb;
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </p>
    <hr>
</div>