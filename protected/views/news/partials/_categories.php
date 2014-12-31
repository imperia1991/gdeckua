<?php
/** @var CategoryNews[] $categories */
/** @var CategoryNews $category */
?>

<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news'); ?>"
   class="cathegories_item <?php if (empty($currentCategory)) echo 'active'; ?>">
    <?php echo Yii::t('main', 'Все новости'); ?>
</a>

<?php foreach ($categories as $category): ?>
    <?php $title = 'title_' . Yii::app()->getLanguage(); ?>
    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $category->aliases . '/'); ?>"
       class="cathegories_item <?php if ($currentCategory == $category->aliases) echo 'active'; ?>">
        <?php echo $category->{$title}; ?>
    </a>
<?php endforeach; ?>

<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . News::OPINION); ?>"
   class="cathegories_item <?php if ($currentCategory == News::OPINION) echo 'active'; ?>">
    <?php echo Yii::t('main', 'Актуальное'); ?>
</a>