<?php
/** @var CActiveDataProvider $dataProvider */
?>
<?php
$this->pageTitle = $model->search ? CHtml::encode($model->search) : Yii::t('main', 'Введите, что ищете');
?>

<?php if ($items): ?>
    <?php $this->renderPartial('/site/partials/_searchFind', [
            'items' => $items,
            'pages' => $pages,
            'model' => $model
        ]) ?>
<?php else: ?>
    <?php $this->renderPartial('/site/partials/_searchNoFind', [
            'model' => $model
        ]) ?>
<?php endif;

