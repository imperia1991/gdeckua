<?php
/** @var NewsChaska $newsModel */
?>
<?php
$this->pageTitle = Yii::t('main', 'Просмотр новости') . ': ' . $newsModel->title;

$this->breadcrumbs = [
	'chashka-che'  => Yii::t('main', 'Новости от Чашка Кави.Че'),
    '' => Yii::t('main', 'Просмотр новости') . ': ' . $newsModel->title,
];
?>

<div class="page_content news_single">
    <h1 class="news_single_title">
        <?php echo $newsModel->title; ?>
    </h1>
    <div class="news_single_date">
        <?php echo Yii::t('main', 'добавлено'); ?>
        <?php echo Yii::t(
            'main',
            '{date} в {time}',
            [
                '{date}' => Yii::app()->dateFormatter->format(
                    'dd.MM.yyyy',
                    $newsModel->created_at
                ),
                '{time}' => Yii::app()->dateFormatter->format(
                    'HH:mm',
                    $newsModel->created_at
                )
            ]
        ); ?>
    </div>
    <div class="news_single_content">
        <div>
            <p>
                <?php echo $newsModel->text; ?>
            </p>
        </div>
        <?php $this->renderPartial(
            '/partials/_social',
            [
                'image' => Yii::app()->createUrl('/uploads/photos/ch/' . $newsModel->photo),
                'title' => $newsModel->title,
            ]
        ); ?>
    </div>

</div>