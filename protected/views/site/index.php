<?php
/** @var CActiveDataProvider $dataProvider */
?>
<?php
$this->pageTitle = $model->search ? CHtml::encode($model->search) : Yii::t('main', 'Введите, что ищете');
?>

<?php if ($dataProvider->getData()): ?>
    <?php $this->renderPartial('/site/partials/_searchFind', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]) ?>
<?php else: ?>
    <?php $this->renderPartial('/site/partials/_searchNoFind', [
            'model' => $model
        ]) ?>
<?php endif;

