<?php
$model = is_object($this->modelPlaces) ? $this->modelPlaces : new Places();

$form = $this->beginWidget('CActiveForm', [
    'id' => 'searchForm',
    'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?page=' . $this->currentPage),
    'method' => 'GET',
    'htmlOptions' => [],
    ]);
?>

<div class="row collapse search">
    <div class="large-7 medium-8 small-5 columns">
        <?php
        echo $form->textField($model, 'search', [
                'name' => 'search',
                'placeholder' => Yii::t('main', 'Введите, что ищете') . '...',
            ]);
        ?>
    </div>
    <div class="large-4 medium-3 small-6 columns styled-select">
        <?php
        echo CHtml::dropDownList('districts', $model->district_id, $this->districts, ['empty' => Yii::t('main', 'Весь город') . '...', 'class' => 'select-inner']);
        ?>
    </div>
    <div class="large-1 medium-1 small-2 columns">
        <?php echo CHtml::submitButton(Yii::t('main', 'найти'), ['name' => '', 'class' => 'button postfix']); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php if ($this->checkedString): ?>
<div class="large-12 columns maybe">
    <p><?php echo Yii::t('main', 'Возможно вы имели ввиду'); ?>: <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?search=' . urlencode($this->checkedString) . '&districts=' . $this->selectDistrict) ?>"><?php echo $this->checkedString; ?>?</a></p>
</div>
<?php endif; ?>

