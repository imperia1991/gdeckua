<?php
/** @var CategoryBlog $categoriesModel */
?>
<div class="row">
	<h4>Список категорий для блогов</h4>
</div>
<div class="row">
	<?php $this->widget('bootstrap.widgets.TbButton', [
		'buttonType' => 'link',
		'url'        => '/admin/categoryBlog/create',
		'label'      => 'Добавить категорию'
	]); ?>
</div>
<div class="row">
	<?php $this->widget(
		'bootstrap.widgets.TbGridView',
		[
			'type'          => 'striped bordered condensed',
			'dataProvider'  => $categoriesModel->search(),
			'emptyText'     => 'Новости не найдены',
			'template'      => '{pager}{summary}{items}{pager}',
			'filter'        => $categoriesModel,
			'columns'       => [
				[
					'name'   => 'title_ru',
					'header' => 'Название (русский)',
					'value'  => function ($data, $row) {
						/** @var CategoryBlog $data */
						echo CHtml::encode($data->title_ru);
					}
				],
				[
					'name'   => 'title_uk',
					'header' => 'Название (украинский)',
					'value'  => function ($data, $row) {
						/** @var CategoryBlog $data */
						echo CHtml::encode($data->title_uk);
					}
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