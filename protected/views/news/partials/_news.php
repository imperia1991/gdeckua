<div class="large-12 columns news-accordion">
    <?php $this->renderPartial(
        'partials/_categories',
        [
            'categories' => $categories,
        ]
    ); ?>
    <div class="tabs-content">
        <div class="content active" id="panel2-1">

            <div id="newsView" class="row collapse news-in-accordion">
                <?php $this->renderPartial(
                    'partials/_newsView',
                    [
                        'news' => $news,
                    ]
                ) ?>
            </div>


            <div class="row collapse">
                <div class="show-other-news">
                    <a href="#">Показать другие новости</a>
                </div>
            </div>
        </div>

    </div>
</div>