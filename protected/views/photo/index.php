<?php
/** @var PhotoCity $photoCityModel */
?>
<?php
//Yii::app()->clientScript->registerScriptFile('/js/jquery.freetile.js');
//Yii::app()->clientScript->registerScriptFile('/js/photo.js', CClientScript::POS_BEGIN);
?>

<?php
$this->pageTitle = Yii::t('main', 'Фотографии города');

$this->breadcrumbs = [
    '' => Yii::t('main', 'Фотографии города')
];
?>

<div class="add_photos_wrap">
    <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo/add'); ?>" class="add_photos_link">+ <?php echo Yii::t('main', 'фотографию'); ?></a>
</div>
<div class="page_content photos">
        <?php $this->renderPartial(
            'partials/_photos',
            [
                'photos' => $photos,
            ]
        ) ?>
</div>