<?php
/** @var CActiveDataProvider $dataProvider */
?>
<?php
$this->pageTitle = Yii::t('main', 'Места города');
?>

<div class="page_content objects_page">
<?php if ($items): ?>
    <?php $this->renderPartial('partials/_searchFind', [
            'items' => $items,
            'pages' => $pages,
            'model' => $model
        ]) ?>
<?php else: ?>
    <?php $this->renderPartial('partials/_searchNoFind', [
            'model' => $model
        ]) ?>
<?php endif; ?>
</div>


