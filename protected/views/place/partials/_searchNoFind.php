<?php
$this->breadcrumbs = [
	'' => CHtml::encode( Yii::t( 'main', 'Объект не найден' ) )
];
?>


<div class="no-find">

	<h6><?php echo Yii::t( 'main', 'Извините, к сожалению по Вашему запросу ничего не найдено' ); ?> :(</h6>
	<?php if ( $this->checkedString ): ?>
		<p><?php echo Yii::t( 'main', 'Возможно вы имели ввиду' ); ?>:
			<a href="<?php echo Yii::app()->createUrl( '/' . Yii::app()->getLanguage() . '/?search=' . urlencode( $this->checkedString ) . '&districts=' . $this->selectDistrict ) ?>"><?php echo $this->checkedString; ?>
		</p>
	<?php endif; ?>
	<img src="/images/nothing-find.png">
	<?php if ( $this->checkedString ): ?>
		<p><?php echo Yii::t( 'main', 'попробуйте снова' ); ?>!</p>
	<?php endif; ?>
</div>
