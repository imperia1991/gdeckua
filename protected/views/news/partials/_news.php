<div class="large-12 columns news-accordion">
    <?php $this->renderPartial(
        'partials/_categories',
        [
            'categories' => $categories,
            'currentCategory' => $currentCategory,
        ]
    ); ?>
    <div class="tabs-content">
        <div id="newsView" class="content active">

            <?php $this->renderPartial(
                'partials/_newsView',
                [
                    'news' => $news,
                ]
            ) ?>

        </div>
    </div>
</div>