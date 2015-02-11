<?php
/** @var CActiveDataProvider $photos */
?>
<div class="city_photos"  id="panelPhotoCity">
	<?php $this->renderPartial(
		'partials/_photoView',
		[
			'photos' => $photos,
		]
	) ?>
</div>


<?php if ( $photos->getTotalItemCount() > $photos->getPagination()->pageSize ): ?>
	<div id="showPhotos">
		<img id="loading" style="display: none" src="/images/loading.gif" alt=""/>
		<a id="showMore" href="javascript:void(0);" class="more_news button"><?php echo Yii::t( 'main', 'Показать еще фотографии' ); ?></a>
	</div>
	<script type="text/javascript">
		/*<![CDATA[*/
		(function ($) {
			// скрываем стандартный навигатор
//            $('.paginator').hide();
			// запоминаем текущую страницу и их максимальное количество
			var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
			var pageCount = parseInt('<?php echo (int)$photos->pagination->pageCount; ?>');
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
						url    : location.href,
						data   : {
							// передаём номер нужной страницы методом POST
							'page': page + 1
						},
						success: function (data) {
							// увеличиваем номер текущей страницы и снимаем блокировку
							page++;
							loadingFlag = false;
							// прячем анимацию загрузки
							$('#loading').hide();
							$('#showMore').show();
							// вставляем полученные записи после имеющихся в наш блок
							$('#panelPhotoCity').append(data);
							$('#panelPhotoCity').freetile({
								selector: '.photo_item'
							});
							$(".colorbox").colorbox({
								slideshow: false,
								rel      : 'slideshow',
								current  : "{current}/{total}"
							});
							// если достигли максимальной страницы, то прячем кнопку
							if (page >= pageCount)
								$('#showPhotos').hide();
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
