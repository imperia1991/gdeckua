<?php
/** @var NewsChaska $clubModel */
?>
<div class="row">
	<h4><?php echo Yii::t('admin', 'Список новостей клуба'); ?></h4>
</div>

<div class="row">
	<?php $this->widget(
		'bootstrap.widgets.TbGridView',
		[
			'type'          => 'striped bordered condensed',
			'dataProvider'  => $clubModel->adminSearch(),
			'emptyText'     => Yii::t('admin', 'Новости не найдены'),
			'template'      => '{pager}{summary}{items}{pager}',
			'filter'        => $clubModel,
			'columns'       => [
				[
					'name'  => 'title',
					'value' => function ($data, $row) {
						/** @var News $data */
						echo CHtml::encode($data->title);
					}
				],
				[
					'name'     => 'status',
					'value'    => function ($data, $row) {
						/** @var NewsChaska $data */
						echo $data->getStatus();
					},
					'sortable' => false,
					'filter'   => $clubModel->getStatuses(),
				],
				[
					'name'   => 'created_at',
					'filter' => false,
				],
				[
					'class'       => 'bootstrap.widgets.TbButtonColumn',
					'template'    => '{update}{delete}',
					'htmlOptions' => ['style' => 'width: 50px'],
				],
			],
			'pager'         => [
				'header'               => '',
				'cssFile'              => false,
				'maxButtonCount'       => 10,
				'selectedPageCssClass' => 'active',
				'hiddenPageCssClass'   => 'disabled',
				'firstPageLabel'       => '<<',
				'prevPageLabel'        => '<',
				'nextPageLabel'        => '>',
				'lastPageLabel'        => '>>',
			],
			'pagerCssClass' => 'pagination pagination-centered',
		]
	); ?>
</div>