<?php
$this->pageTitle = Yii::t('main', 'Мои блоги');

$this->breadcrumbs = [
	'user' => Yii::t('main', 'Мой кабинет'),
	''     => Yii::t('main', 'Мои блоги')
];
?>

<div class="page_content news clearfix">
	<div class="news_main muser">
		<div class="news_cathegories">
			<a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/user/blog/add'); ?>"
			   class="cathegories_item">
				<?php echo Yii::t('main', 'Добавить блог'); ?>
			</a>
		</div>
		<div class="add_object">
			<?php
			/**@var Blog $modelBlog */

			$this->widget(
				'zii.widgets.grid.CGridView',
				[
					'dataProvider'  => $modelBlog->search(),
					'emptyText'     => Yii::t('error', 'Блоги не найдены'),
					'template'      => '{pager}{summary}{items}{pager}',
					'filter'        => $modelBlog,
					'columns'       => [
						[
							'name'  => 'title',
							'value' => function ($data, $row) {
								/** @var News $data */
								echo CHtml::encode($data->title);
							}
						],
						[
							'name'   => 'created_at',
							'filter' => false,
						],
						[
							'class'       => 'CButtonColumn',
							'template'    => '{update}{delete}',
							'htmlOptions' => ['style' => 'width: 50px'],
						],
					],
					'pager'         => [
						'header'               => '',
						'cssFile'              => false,
						'selectedPageCssClass' => 'active',
						'footer'               => '',
						'internalPageCssClass' => '',
						'prevPageLabel'        => '<',
						'nextPageLabel'        => '>',
						'previousPageCssClass' => 'arrow',
						'htmlOptions'          => ['class' => 'pagination'],
						'firstPageCssClass'    => 'first',
						'firstPageLabel'       => '<<',
						'lastPageCssClass'     => 'last',
						'lastPageLabel'        => '>>',
						'nextPageCssClass'     => 'arrow',
						'hiddenPageCssClass'   => 'unavailable',
						'maxButtonCount'       => 5
					],
					'pagerCssClass' => 'pagination pagination-centered',
				]
			); ?>
		</div>
	</div>
</div>