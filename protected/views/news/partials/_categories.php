<?php
/** @var CategoryNews[] $categories */
/** @var CategoryNews $category */
?>
<ul class="tabs">
    <li class="tab-title active">
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $category->aliases . '/'); ?>">
            <?php echo Yii::t('main', 'Все новости'); ?>
        </a>
    </li>
    <?php foreach ($categories as $category): ?>
    <li class="tab-title">
        <?php $title = 'title_' . Yii::app()->getLanguage(); ?>
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $category->aliases . '/'); ?>"><?php echo $category->{$title}; ?></a>
    </li>
    <?php endforeach; ?>
    <li class="tab-title">
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . News::OPINION); ?>"><?php echo Yii::t('main', 'Мнения'); ?></a>
    </li>
</ul>