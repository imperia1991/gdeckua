<?php
$model = is_object($this->modelPlaces) ? $this->modelPlaces : new Places();

$form = $this->beginWidget('CActiveForm', [
    'id' => 'searchForm',
    'action' => Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/?page=' . $this->currentPage),
    'method' => 'GET',
    'htmlOptions' => [],
    ]);
?>

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
            <input id="districts" type="hidden" name="districts" value="<?php echo is_object($this->modelPlaces) ? $this->modelPlaces->district_id : ''; ?>" />
        </div>
    </div>
    <input type="submit" class="search_submit" value="">
</div>

<?php $this->endWidget(); ?>

<?php if ($this->checkedString): ?>
<div class="maybe">
    <span>
        <?php echo Yii::t('main', 'Возможно вы имели ввиду'); ?>:
        <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/place/?search=' . urlencode($this->checkedString) . '&districts=' . $this->selectDistrict) ?>">
            <?php echo $this->checkedString; ?>?
        </a>
    </span>
</div>
<?php endif; ?>

<script type="text/javascript">
    $('.slct').html($('#district a[href=' + <?php echo is_object($this->modelPlaces) ? $this->modelPlaces->district_id : ''; ?> + ']').html());
</script>
