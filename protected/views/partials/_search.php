<?php
$model = is_object($this->modelPlaces) ? $this->modelPlaces : new Places();

$form = $this->beginWidget('CActiveForm', [
    'id' => 'searchForm',
    'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place?page=' . $this->currentPage),
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
            <ul id="district" class="drop">
                <?php /**@var Districts $district */ ?>
                <?php $title = 'title_' . Yii::app()->getLanguage(); ?>
                <li><a href=""><?php echo Yii::t('main', 'Весь город'); ?>...</a></li>
                <?php foreach ($this->districts as $id => $district): ?>
                    <li><a href="<?php echo $id; ?>"><?php echo $district; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <input id="districts" type="hidden" name="districts" value="<?php echo $this->modelPlaces->district_id ?: ''; ?>" />
        </div>
    </div>
    <input type="submit" class="search_submit" value="">
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('.slct').html($('#district a[href=' + <?php echo $this->modelPlaces->district_id; ?> + ']').html());
</script>
