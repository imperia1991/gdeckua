<?php
/** @var Places $items */
/** @var CPagination $pages */
?>
<?php
$currentPage = $pages->currentPage + 1;
?>
<?php
$this->pageTitle = Yii::t( 'main', 'Поиск' ) . ': ' . CHtml::encode($model->search);
$this->breadcrumbs = [
//    '' => Yii::t('main', 'Поиск') . ': ' . CHtml::encode($model->search) . ' (' . Yii::t('main', 'найдено {n} объект|найдено {n} объекта|найдено {n} объектов', [$dataProvider->getTotalItemCount()]) . ')'
	'' => Yii::t( 'main', 'Поиск' ) . ': ' . CHtml::encode($model->search)
];

?>

<div class="block_with_map clearfix ">
	<div class="block_with_map_left">
		<div id="placeMap">
			<?php
			$this->renderPartial( 'partials/_map', [
				'items'          => $items,
				'model'          => $model,
				'selectDistrict' => $this->selectDistrict,
			] );

			?>
		</div>
	</div>
	<div class="block_with_map_left_right">
		<div id="findedPlaces" class="objects clearfix objects_page_list">
			<?php foreach ( $items as $data ): ?>
				<?php $this->renderPartial( 'partials/_item', [ 'data' => $data ] ); ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>


	<?php
	$this->widget( 'CLinkPager', [
		'pages'                => $pages,
//                'cssFile'=>Yii::app()->baseUrl."/css/pagination.css",
		'header'               => '',
		'selectedPageCssClass' => 'active',
		'footer'               => '',
		'internalPageCssClass' => '',
		'prevPageLabel'        => '<',
		'nextPageLabel'        => '>',
		'previousPageCssClass' => 'arrow',
		'htmlOptions'          => [ 'class' => 'pagination' ],
		'firstPageCssClass'    => 'first',
		'firstPageLabel'       => '<<',
		'lastPageCssClass'     => 'last',
		'lastPageLabel'        => '>>',
		'nextPageCssClass'     => 'arrow',
		'hiddenPageCssClass'   => 'unavailable',
		'maxButtonCount'       => 5
	] );
	?>
