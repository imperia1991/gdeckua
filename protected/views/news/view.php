<?php
/** @var News $newsModel */
?>
<?php
$this->pageTitle = $newsModel->title;

$this->breadcrumbs = [
	'news'  => Yii::t('main', 'Новости'),
    '' => $newsModel->title,
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
                'image' => Yii::app()->createUrl('/uploads/photos/news/' . $newsModel->photo),
                'title' => $newsModel->title,
            ]
        ); ?>
    </div>

    <div class="home_news">
        <div class="title"><?php echo Yii::t('main', 'читайте так же'); ?>:</div>
        <ul class="home_news_list clearfix">
            <?php
            /** News $oneNews */
            $news = $newsModel->getViewNews()
            ?>
            <?php foreach ($news as $oneNews): ?>
            <li class="home_news_item">
                <a href="<?php echo Yii::app()->createUrl(
                    '/' . Yii::app()->getLanguage(
                    ) . '/news/' . $oneNews->id . '/' . $oneNews->alias
                ) ?>">
                    <div class="home_news_item_text">
                        <?php echo $oneNews->getTitle(); ?>
                    </div>
                    <div class="home_news_item_date">
                        <?php echo Yii::app()->dateFormatter->format('d MMMM yyyy', $oneNews->created_at); ?>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php echo $this->renderPartial(
        '/partials/_comments',
        [
            'comment' => $comment,
            'model' => $newsModel,
            'caption' => Yii::t('main', 'Комментарии'),
            'url' => Yii::app()->createUrl('/comments/commentsNews'),
        ]
    ); ?>

</div>