<ul class="breadcrumbs">
    <li>
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage()); ?>"><?php echo Yii::t('main', 'Главная') ?></a>
    </li>
    <?php foreach ($this->breadcrumbs as $url => $breadcrumb): ?>
        <?php if (!empty($url)): ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/' . $url); ?>"><?php echo $breadcrumb; ?></a>
            </li>
        <?php else: ?>
            <?php
            $this->pageTitle = $breadcrumb;
            echo $breadcrumb;
            ?>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>