<?php
/** @var Posters $poster */
/** @var CategoryPosters $category */

?>
<?php if ( $posters->getTotalItemCount() ): ?>
	<?php foreach ( $posters->getData() as $poster ): ?>
		<div class="photo_item">
			<div class="photos_item">
				<div class="photos_item_wrap">
					<div class="photos_item_image">
						<a href="#">
							<?php
							echo Yii::app()->easyImage->thumbOf(
								'/' . Yii::app()->params['admin']['files']['photoPoster'] . '/' . $poster->photo,
								[
									'resize'  => [ 'width' => 491, 'height' => 340 ],
//                            'crop' => ['width' => 491, 'height' => 340],
									'quality' => 100,
								]
							);
							?>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

	<script type="text/javascript">
		$(document).ready(function ()
			{
				$("#panelItems").freetile({
					selector       : '.photo_item',
					containerResize: true
				});
			}
		);
	</script>
<?php else: ?>
	<p style="padding-left: 5px;"><?php echo Yii::t( 'main', 'В данной категории информация отсутствует' ); ?></p>
<?php endif;
