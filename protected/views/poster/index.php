<?php
/** @var Posters[] $posters */
/** @var CategoryPosters[] $categories */
/** @var CategoryPosters $currentCategory */
/** @var string $currentCategoryAlias */
?>
<?php
//Yii::app()->clientScript->registerScriptFile('/js/jquery.freetile.js');
//Yii::app()->clientScript->registerScriptFile('/js/photo.js', CClientScript::POS_BEGIN);
?>

<?php
$title = 'title_' . Yii::app()->getLanguage();
$this->pageTitle = Yii::t('main', $currentCategory->{$title});

$this->breadcrumbs = [
    '' => Yii::t('main', $currentCategory->{$title})
];
?>

<div class="page_content photos">
    <div class="announces_cathegories">
        <?php foreach ($categories as $key => $category): ?>
            <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/poster/' . $category->alias); ?>"
               class="cathegories_item <?php if ($currentCategory->alias == $category->alias): ?>active<?php endif; ?>">
                <?php echo $category->{$title}; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div id="city_photos" class="city_photos">
        <?php $this->renderPartial('partials/_affishes', [
            'posters' => $posters,
            'currentCategory' => $currentCategory
        ]); ?>

    </div>
</div>