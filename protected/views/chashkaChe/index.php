<?php
$this->pageTitle = Yii::t('main', 'Новости от Чашка Кави.Че');

$this->breadcrumbs = [
	'' => Yii::t('main', 'Новости от Чашка Кави.Че')
];
?>

<div class="page_content news clearfix">
	<div class="news_main">
		<h2><?php echo Yii::t('main', 'Заседания') ?> :</h2>

		<div class="main_news_list_wrap">
			<div class="main_news_list">
				<?php $this->renderPartial(
					'partials/_slider',
					[
						'meetings' => $meetings
					]
				); ?>
			</div>
		</div>

		<?php $this->renderPartial(
			'partials/_meeting',
			[
				'meetings' => $meetings,
			]
		) ?>

	</div>

	<?php $this->renderPartial(
		'partials/_club',
		[
			'clubs' => $clubs,
		]
	) ?>


	<?php $this->renderPartial('partials/_buttonAnotherView', [
		'meetings' => $meetings,
		'clubs'    => $clubs,
	]); ?>

</div>