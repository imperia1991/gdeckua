<div class="qq-uploader row collapse">
	<div class="qq-upload-drop-area"></span></div>
	<div class="qq-upload-button">
		<button type="submit" class="add-foto-btn"><?php echo Yii::t(
				'main',
				'Загрузить фото объекта'
			); ?>
		</button>
	</div>
	<span class="qq-drop-processing"><span class="qq-drop-processing-spinner"></span></span>
	<ul class="qq-upload-list"></ul>
</div>

<?php if ( count( Yii::app()->session['images'] ) ): ?>
	<?php $images = Yii::app()->session['images'] ?>
	<?php foreach ( $images as $image ): ?>
		<div class="input_wrap delClass" data-filename="<?php echo $image; ?>">
			<div class="object-img-box">
				<img src="/<?php echo Yii::app()->params['admin']['files']['tmp'] . $image; ?>" width="100px"
				     height="90px"/>
			</div>
			<p>
				<a id="image_<?php echo $image; ?>" href="javascript:void(0);"
				   onclick="photo.deletePreviewUpload(this);" rel="<?php echo $image; ?>"
				   class="remove-photo">
					<img src="/img/delete.png">
					<?php echo Yii::t( 'main', 'Удалить' ); ?>
				</a>
			</p>
			<input name="Photos[]" type="hidden" value="<?php echo $image; ?>"/>
		</div>
	<?php endforeach; ?>
<?php endif; ?>

<input id="deleteUrl" type="hidden"
       value="<?php echo Yii::app()->createUrl(
	       '/' . Yii::app()->getLanguage() . '/place/deletePreviewUpload'
       ) ?>"/>