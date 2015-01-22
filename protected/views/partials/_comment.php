<?php /**@var News $data */ ?>
<li class="comment">
	<div class="comment_title">
		<span class="comment_author"><?php echo CHtml::encode( $data->name ); ?></span>
            <span class="comment_date">
                <?php echo Yii::t(
	                'main',
	                '{date} в {time}',
	                [
		                '{date}' => Yii::app()->dateFormatter->format(
			                'dd MMMM yyyy',
			                $data->created_at
		                ),
		                '{time}' => Yii::app()->dateFormatter->format(
			                'HH:mm',
			                $data->created_at
		                )
	                ]
                ); ?>
            </span>

		<div class="comment_text">
			<?php echo CHtml::encode( $data->message ); ?>
		</div>
	</div>
</li>
