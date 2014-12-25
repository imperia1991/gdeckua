<?php
$model = is_object($this->modelPlaces) ? $this->modelPlaces : new Places();

$form = $this->beginWidget('CActiveForm', [
    'id' => 'searchForm',
    'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?page=' . $this->currentPage),
    'method' => 'GET',
    'htmlOptions' => [],
    ]);
?>

<?php if ($this->checkedString): ?>
<div class="large-12 columns maybe">
    <p><?php echo Yii::t('main', 'Возможно вы имели ввиду'); ?>: <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?search=' . urlencode($this->checkedString) . '&districts=' . $this->selectDistrict) ?>"><?php echo $this->checkedString; ?>?</a></p>
</div>
<?php endif; ?>

<div class="search_block">
    <?php
    echo $form->textField($model, 'search', [
        'name' => 'search',
        'placeholder' => Yii::t('main', 'Введите, что ищете') . '...',
        'class' => 'search_input'
    ]);
    ?>
    <div class="search_select">
        <div class="select">
            <a href="javascript:void(0);" class="slct"><?php echo Yii::t('main', 'Весь город'); ?>...</a>
            <ul class="drop">
                <?php /**@var Districts $district */ ?>
                <?php $title = 'title_' . Yii::app()->getLanguage(); ?>
                <?php foreach ($this->districts as $district): ?>
                    <li><a href="#"><?php echo $district; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <input type="hidden"  />
        </div>
    </div>
    <input type="submit" class="search_submit" value="">
</div>

<?php $this->endWidget(); ?>
