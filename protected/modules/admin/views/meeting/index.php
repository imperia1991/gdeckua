<?php
/** @var NewsChaska $meetingModel */
?>
<div class="row">
	<h4><?php echo Yii::t('admin', 'Список заседаний'); ?></h4>
</div>
<div class="row">
	<?php $this->widget('bootstrap.widgets.TbButton', [
		'buttonType' => 'link',
		'url'        => '/admin/meeting/create',
		'label'      => Yii::t('admin', 'Добавить заседание')
	]); ?>
</div>
<div class="row">
	<?php $this->widget(
		'bootstrap.widgets.TbGridView',
		[
			'type'          => 'striped bordered condensed',
			'dataProvider'  => $meetingModel->search(),
			'emptyText'     => Yii::t('admin', 'Заседания не найдены'),
			'template'      => '{pager}{summary}{items}{pager}',
			'filter'        => $meetingModel,
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
					'filter'   => $meetingModel->getStatuses(),
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