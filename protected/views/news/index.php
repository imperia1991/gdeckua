<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Новости')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-10 small-12 columns left-section-news-slider">
            <div class="row collapse">
                <div class="large-3 medium-3 columns">
                    <div class="right-section">
                        <h4><?php echo Yii::t('main', 'Актуальное'); ?></h4>

                        <?php $this->renderPartial(
                            'partials/_previewOpinions',
                            [
                                'previewOpinions' => $previewOpinions
                            ]
                        ) ?>
                    </div>
                </div>
                <div class="large-9 medium-9 columns slider">
                    <?php $this->renderPartial(
                        'partials/_slider',
                        [
                            'news' => $news
                        ]
                    ); ?>
                </div>
            </div>

            <div class="row collapse">
                <?php $this->renderPartial(
                    'partials/_news',
                    [
                        'news' => $news,
                        'rss' => $rss,
                        'categories' => $categories,
                        'currentCategory' => $currentCategory,
                    ]
                ) ?>
            </div>

        </div>

        <div class="large-2 medium-2 small-12 columns">
            <?php $this->renderPartial(
                'partials/_previewComments',
                [
                    'previewComments' => $previewComments,
                ]
            ); ?>

            <?php $this->renderPartial('/partials/_adsOne'); ?>

        </div>


    </div>
</div>