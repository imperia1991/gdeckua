<?php
$this->pageTitle = Yii::t('main', 'Новости');

$this->breadcrumbs = [
    '' => Yii::t('main', 'Новости')
];
?>

<div class="page_content news clearfix">
    <div class="news_main">
        <h2><?php echo Yii::t('main', 'Новости') ?> :</h2>
        <div class="main_news_list_wrap">
            <div class="main_news_list">
                <?php $this->renderPartial(
                    'partials/_slider',
                    [
                        'news' => $news
                    ]
                ); ?>
            </div>
        </div>
        <div class="news_cathegories">
            <?php $this->renderPartial(
                'partials/_categories',
                [
                    'categories' => $categories,
                    'currentCategory' => $currentCategory,
                ]
            ); ?>
        </div>

        <?php $this->renderPartial(
            'partials/_news',
            [
                'news' => $news,
            ]
        ) ?>

    </div>

    <?php $this->renderPartial(
        'partials/_rss',
        [
            'rss' => $rss,
        ]
    ) ?>


    <?php $this->renderPartial('partials/_buttonAnotherView', [
        'news' => $news,
        'rss' => $rss,
    ]); ?>

</div>