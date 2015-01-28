<?php
$this->breadcrumbs = [
    '' => CHtml::encode(Yii::t('main', 'Объект не найден'))
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 small-12 medium-9 columns left-sector">
            <h6><?php echo Yii::t('main', 'Извините, к сожалению по Вашему запросу ничего не найдено'); ?> :(</h6>
            <?php if ($this->checkedString): ?>
                <p><?php echo Yii::t('main', 'Возможно вы имели ввиду'); ?>: <a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '?search=' . urlencode($this->checkedString) . '&districts=' . $this->selectDistrict) ?>"><?php echo $this->checkedString; ?></p>
            <?php endif; ?>
            <img src="/img/nothing-find.png">
            <?php if ($this->checkedString): ?>
                <p><?php echo Yii::t('main', 'попробуйте снова'); ?>!</p>
            <?php endif; ?>
        </div>

    </div>
</div>