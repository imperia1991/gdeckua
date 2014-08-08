<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Новости')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
<div class="row collapse">

<div class="large-10 small-12 columns left-section-news-slider">
<div class="row collapse">
    <div class="large-3 columns">
        <div class="right-section">
            <h4><?php echo Yii::t('main', 'Мнения'); ?></h4>

            <?php $this->renderPartial('partials/_previewOpinions', [
                    'previewOpinions' => $previewOpinions
                ]) ?>
        </div>
    </div>
    <div class="large-9 columns slider">
        <ul class="example-orbit-content" data-orbit>
            <li data-orbit-slide="headline-1">
                <div class="row slide-title">
                    <div class="large-10 medium-10 columns">
                        <h2>Фондова биржа рухнула вчера утром</h2>
                    </div>
                    <div class="large-2 medium-2 columns">
                        <h3>25.20.2014</h3>
                    </div>
                </div>
                <div class="row collapse">
                    <div class="large-12 slide-image columns">
                        <img src="img/kamin.png">
                    </div>
                </div>
            </li>
            <li data-orbit-slide="headline-2">
                <div class="row slide-title">
                    <div class="large-10 medium-10 columns">
                        <h2>Фондова биржа рухнула вчера утром</h2>
                    </div>
                    <div class="large-2 medium-2 columns">
                        <h3>25.20.2014</h3>
                    </div>
                </div>
                <div class="row collapse">
                    <div class="large-12 slide-image columns">
                        <img src="img/map.png">
                    </div>
                </div>
            </li>
            <li data-orbit-slide="headline-3">
                <div class="row slide-title">
                    <div class="large-10 medium-10 columns">
                        <h2>Фондова биржа рухнула вчера утром</h2>
                    </div>
                    <div class="large-2 medium-2 columns">
                        <h3>25.20.2014</h3>
                    </div>
                </div>
                <div class="row collapse">
                    <div class="large-12 slide-image columns">
                        <img src="img/kamin.png">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="row collapse">
<div class="large-12 columns news-accordion">
<ul class="tabs" data-tab>
    <li class="tab-title active">
        <a href="#panel2-1">Все новости</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-2">Политика</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-3">Комун. службы</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-4">Власть</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-5">Общество</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-6">События</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-7">Спорт</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-8">Культура</a>
    </li>
    <li class="tab-title">
        <a href="#panel2-9">Мнения</a>
    </li>
</ul>
<div class="tabs-content">
<div class="content active" id="panel2-1">


    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse">
        <div class="show-other-news">
            <a href="#">Показать другие новости</a>
        </div>
    </div>
</div>
<div class="content" id="panel2-2">
    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse">
        <div class="show-other-news">
            <a href="#">Показать другие новости</a>
        </div>
    </div>
</div>
<div class="content" id="panel2-3">
    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse">
        <div class="show-other-news">
            <a href="#">Показать другие новости</a>
        </div>
    </div>
</div>
<div class="content" id="panel2-4">
    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse news-in-accordion">
        <div class="large-2 medium-2 columns">
            <img src="img/kamin.png">
        </div>
        <div class="large-10 medium-10 columns new-description">
            <div class="row title-new">
                <div class="large-9 medium-9 columns"><h4>Депутаты чудят</h4></div>
                <div class="large-3 medium-3 columns">
                    <p class="right">добавлено:<br>
                        25.20.2014  в 15:56</p>
                </div>
            </div>
            <div class="large-12 columns new-preview-text">
                <p>р-н Леси Украинки Бул. Шевченка 124    5 эт., оф. 265/7а Тут можно вкусно поесть</p>
                <p>и отметить день рождение</p>
                <p>и тут остапа понесло!</p><br>
                <p class="right"><a href="#">показать новость полностью</a></p>
            </div>
        </div>
    </div>

    <div class="row collapse">
        <div class="show-other-news">
            <a href="#">Показать другие новости</a>
        </div>
    </div>
</div>
<div class="content" id="panel2-5">
    <p>5 panel content goes here...</p>
</div>
<div class="content" id="panel2-6">
    <p>6 panel content goes here...</p>
</div>
<div class="content" id="panel2-7">
    <p>7 panel content goes here...</p>
</div>
<div class="content" id="panel2-8">
    <p>8 panel content goes here...</p>
</div>
<div class="content" id="panel2-9">
    <p>9 panel content goes here...</p>
</div>
</div>
</div>
</div>

</div>

<div class="large-2 small-12 columns">
    <div class="right-section">
        <h4>Комментарии</h4>

        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-12 medium-12 small-12 columns">
                            <p class="right">29.05.2014     15:38</p><br>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p><strong>Иван Иванович</strong></p>
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                </div>
                <div align="center" class="large-12 columns medium-9 small-12 news-link">
                    <a align="center"href="#">все комментарии к новости</a>
                </div>

            </div>
        </div>
        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-12 medium-12 small-12 columns">
                            <p class="right">29.05.2014     15:38</p><br>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p><strong>Иван Иванович</strong></p>
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                </div>
                <div align="center" class="large-12 columns medium-9 small-12 news-link">
                    <a align="center"href="#">все комментарии к новости</a>
                </div>

            </div>
        </div>

        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-12 medium-12 small-12 columns">
                            <p class="right">29.05.2014     15:38</p><br>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p><strong>Иван Иванович</strong></p>
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                </div>
                <div align="center" class="large-12 columns medium-9 small-12 news-link">
                    <a align="center"href="#">все комментарии к новости</a>
                </div>

            </div>
        </div>
        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-12 medium-12 small-12 columns">
                            <p class="right">29.05.2014     15:38</p><br>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p><strong>Иван Иванович</strong></p>
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                </div>
                <div align="center" class="large-12 columns medium-9 small-12 news-link">
                    <a align="center"href="#">все комментарии к новости</a>
                </div>

            </div>
        </div>
    </div>

    <div class="row collapse">
        <div class="large-12 medium-12 small-12 columns">
            <div class="reklama-news-box"><a href="#"><img src="img/reklama.png"></a></div>
        </div>
    </div>


</div>


</div>
</div>