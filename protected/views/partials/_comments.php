<?php
/** @var Comments $comment */
?>

<h2 id="comments"><?php echo $caption; ?>:</h2>

<?php $form = $this->beginWidget(
	'CActiveForm',
	[
		'id'                   => 'comment-model-form',
		'enableAjaxValidation' => false,
		'htmlOptions'          => [
			'class' => 'row collapse'
		],
	]
);

$errors = $comment->getErrors();
?>
	<div class="add_comment ">
		<div class="add_comment_left">
			<div class="input_wrap">
				<?php echo $form->textArea( $comment, 'message', [
					'class'       => 'input',
					'placeholder' => Yii::t( 'main', 'Напишите комментарий' ) . "...",
					'value'       => StringHelper::br2nl( $comment->message )
				] ); ?>

				<?php if (isset($errors['message'])): ?>
					<label class="error"><?php echo $errors['message'][0]; ?></label>
				<?php endif; ?>
			</div>
		</div>
		<div class="add_comment_right">
			<?php if (isset($errors['name'])): ?>
				<label class="error"><?php echo $errors['name'][0]; ?></label>
			<?php endif; ?>
			<div class="input_wrap">
				<?php echo $form->textField( $comment, 'name', [
					'class'       => 'input',
					'placeholder' => Yii::t( 'main', 'Ваше Имя' ) . ' *'
				] ); ?>

			</div>

			<div class="input_wrap captcha_block clearfix">
				<?php if (isset($errors['verifyCode'])): ?>
					<label class="error"><?php echo $errors['verifyCode'][0]; ?></label>
				<?php endif; ?>
				<div class="captcha_image">
					<? if ( CCaptcha::checkRequirements() ): ?>
						<?php $this->widget( 'CCaptcha', [
							'buttonLabel'       => Yii::t( 'main', 'Обновить' ),
							'showRefreshButton' => true,
							'buttonOptions'     => [
								'class' => 'captcha_refresh'
							],
//                            'buttonType' => 'button',
							'clickableImage'    => true
						] ); ?>
					<? endif ?>
				</div>
				<?php echo $form->textField( $comment, 'verifyCode', [
					'class'       => 'input captcha_input',
					'placeholder' => Yii::t( 'main', 'Введите код' ) . ' *'
				] ); ?>

			</div>
			<div class="pop_up_bottom clearfix">
				<?php echo CHtml::submitButton( Yii::t( 'main', 'Добавить' ), [ 'class' => 'submit' ] ); ?>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

<?php
/** @var CActiveDataProvider $dataProvider */
$dataProvider = $comment->search( $model->id );
?>

<div id="commentsView">
<?php $this->renderPartial( '/partials/_commentsView', [
	'dataProvider' => $dataProvider,
	'model'        => $model
] ) ?>
</div>

<?php if ( $dataProvider->getTotalItemCount() > $dataProvider->getPagination()->pageSize ): ?>

	<br>
	<div id="showComments" class="row collapse">
		<div class="show-other-news">
			<img id="loading" style="display: none" src="/img/loading.gif" alt=""/>
			<a id="showMore" class="more_news button"
			   href="javascript:void(0)"><?php echo Yii::t( 'main', 'Показать больше комментариев' ) ?></a>
		</div>
	</div>

	<script type="text/javascript">
		/*<![CDATA[*/
		(function ($) {
			// скрываем стандартный навигатор
//            $('.paginator').hide();
			// запоминаем текущую страницу и их максимальное количество
			var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
			var pageCount = parseInt('<?php echo (int)$dataProvider->pagination->pageCount; ?>');
			var loadingFlag = false;
			$('#showMore').on('click', function () {
				// защита от повторных нажатий
				if (!loadingFlag) {
					// выставляем блокировку
					loadingFlag = true;
					// отображаем анимацию загрузки
					$('#showMore').hide();
					$('#loading').show();
					$.ajax({
						type   : 'post',
						url    : '<?php echo $url; ?>',
						data   : {
							// передаём номер нужной страницы методом POST
							'page': page + 1,
							'id'  : <?php echo $model->id ?>
						},
						success: function (data) {
							// увеличиваем номер текущей страницы и снимаем блокировку
							page++;
							loadingFlag = false;
							// прячем анимацию загрузки
							$('#loading').hide();
							$('#showMore').show();
							// вставляем полученные записи после имеющихся в наш блок
							$('#commentsView').html(data);
							// если достигли максимальной страницы, то прячем кнопку
							if (page >= pageCount)
								$('#showComments').hide();
							var n = $(document).height();
							$('html, body').animate({scrollTop: n}, 1000);
						},
						done   : function () {
							$('#loading').hide();
							$('#showMore').show();
						}
					});
				}
				return false;
			})
		})(jQuery);
		/*]]>*/
	</script>

<?php endif; ?>