<?php
/** @var News $prevNewsModel */
/** @var News $currentNewsModel */
/** @var News $nextNewsModel */
?>
<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Просмотр новости') . ' - ' . $newsModel->title,
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<?php
//$currentNewsModel = isset($newsModels[])
?>

<div class="large-12 columns">
<div class="row collapse">

<div class="large-10 small-12 columns left-sector-large-view">

    <div class="row collapse new-box">
        <div class="large-12 columns left-sector-news-box">
            <div class="row left-sector-news-title collapse">
                <div class="large-2 medium-2 columns">
                    <p>добавлено:</p>

                    <p>25.12.2014 в 20:30</p>
                </div>
                <div class="large-10 medium-10 columns"><p>Нацгвардия получила новую усовершенствованную боевую
                        технику</p></div>
            </div>
            <div class="row collapse">
                <div class="large-12 columns main-news-inner">
                    <img src="img/kamin.png" class="left">

                    <p>На вручении боевой техники присутствовали спикер Верховной
                        Рады Александр Турчинов, министр внутренних дел Арсен
                        Аваков и командиры батальонов, которые принимают участие
                        в военных действиях на востоке страны.</p>

                    <p>По информации, украинская армия будет использовать технику
                        во время АТО на востоке Украины.</p>

                    <p>«Известный БТР-4Е очень хорошо показал себя во время
                        событий на востоке. Однако во время
                        боевых действий оказались некоторые несовершенства
                        техники, которые смогут
                        исправить эксперты и конструкторы
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row news-box-switcher">
        <div class="large-6 medium-6 columns"><p class="left"><a href="#"><< Предыдущая новость</a></p></div>
        <div class="large-6 medium-6 columns"><p class="right"><a href="#">Следующая новость >></a></p></div>
    </div>

    <div class="row collapse share-new">
        <div class="large-12 columns">
            <div class="left">
                <a href="#"><img src="img/soc-fb.png" alt=""></a>
                <a href="#"><img src="img/soc-vk.png" alt=""></a>
                <a href="#"><img src="img/soc-odn.png" alt=""></a>
                <a href="#"><img src="img/soc-twitter.png" alt=""></a>
                <a href="#"><img src="img/soc-google.png" alt=""></a>
                <a href="#"><img src="img/soc-mailru.png" alt=""></a>
                <a>Поделиться </a>
            </div>
        </div>
    </div>


    <div class="large-12 columns comments">
        Комментарии к новости
    </div>
    <div class="row collapse input-form-new">

        <form class="row collapse">
            <div class="large-7 columns">
                <textarea placeholder="Напишите Ваш комментарий..."></textarea>
            </div>
            <div class="large-5 columns">
                <div class="row collapse" style="padding-left: 5px !important;">
                    <div class="large-12 columns">
                        <input type="text" placeholder="Ваше Имя (обязательно)">
                    </div>
                    <div class="large-6 columns">
                        <img src="img/capcha.png"><br><br>
                        <input type="submit" value="Сменить" class="button tiny">
                    </div>
                    <div class="large-6 columns">
                        <input type="text" placeholder="Введите код">
                    </div>
                    <div class="large-12 columns">
                        <input type="submit" value="Написать" class="button small">
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div class="row collapse comment-block">
        <div class="large-12 columns row collapse">
            <div class="large-1 medium-1 columns comment-icon">
                <img src="img/comment.png" class="left">
            </div>
            <div class="large-11 medium-11 columns comment-box-left">

                <div class="comment-box-inner-left">
                    <div class="large-6 medium-6 small-4 columns right"><p class="right"><a href="#">Владислав</a></p>
                    </div>
                    <div class="large-6 medium-6 small-8 columns left"><p class="left">23 октября 2014 16:39</p></div>
                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse </p>

                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse </p>

                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse </p>

                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse </p>
                </div>
                <div class="comment-square-left"></div>
            </div>
        </div>

        <div class="large-12 columns"></div>

        <div class="large-12 columns row collapse">
            <div class="large-11 medium-11 columns comment-box-right">
                <div class="comment-square-right"></div>
                <div class="comment-box-inner-right">
                    <div class="large-6 columns left small-4"><p class="left"><a href="#">Елена</a></p></div>
                    <div class="large-6 columns right small-8"><p class="right">23 октября 2014 16:39</p></div>
                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse.</p>

                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse.</p>

                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse.</p>

                    <p>Etiam ullamcorper. Supendisse a pellentesque dui, non felis.
                        Maecenas malesuada elit lectus fe, malesuada ultricies. Lorem ipsum dolor sit amet enim. Etiam
                        ullamcorper. Supendisse.</p>
                </div>

            </div>
            <div class="large-1 medium-1 columns comment-icon-right">
                <img src="img/comment-right.png" class="right">
            </div>
        </div>

    </div>
    <br>

    <div class="row collapse">
        <div class="show-other-news">
            <a href="#">Показать больше комментариев</a>
        </div>
    </div>

</div>

<div class="large-2 small-12 columns right-section-cont">
    <div class="right-section">
        <h4>Новости</h4>

        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-4 medium-4 small-3 columns">
                            <img src="img/news-img.png">
                        </div>
                        <div class="large-8 medium-8 small-9 columns">
                            <p>29.05.2014 15:38</p>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                    <a align="center" href="#">прочитать статью полностью</a>
                </div>

            </div>
        </div>
        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-4 medium-4 small-3 columns">
                            <img src="img/news-img.png">
                        </div>
                        <div class="large-8 medium-8 small-9 columns">
                            <p>29.05.2014 15:38</p>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                    <a align="center" href="#">прочитать статью полностью</a>
                </div>

            </div>
        </div>
        <div class="news-box row">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-4 medium-4 small-3 columns">
                            <img src="img/news-img.png">
                        </div>
                        <div class="large-8 medium-8 small-9 columns">
                            <p>29.05.2014 15:38</p>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p>Всепришли на выборы что бы
                        поддержать своего кандидата
                        на пост главы города......</p>
                    <a align="center" href="#">прочитать статью полностью</a>
                </div>

            </div>
        </div>
        <div class="news-box row last-new">
            <div class="row collapse">
                <div class="large-12 medium-3 small-12 columns oglavlenie">
                    <div class="row collapse">
                        <div class="large-4 medium-4 small-3 columns">
                            <img src="img/news-img.png">
                        </div>
                        <div class="large-8 medium-8 small-9 columns">
                            <p>29.05.2014 15:38</p>
                            <h4>Сегодня
                                состоялись
                                выборы в мэры</h4>
                        </div>
                    </div>
                </div>
                <div class="large-12 columns medium-9 small-12 description">
                    <p>Всепришли на выборы что бы
                        на пост главы города......</p>
                    <a align="center" href="#">прочитать статью полностью</a>
                </div>

            </div>
        </div>

    </div>
    <div class="row collapse show-news">
        <div class="large-12 columns">
            <p><a href="#">Читать все новости</a></p>
        </div>
    </div>

    <div class="row collapse reklama-news-box">
        <div class="large-12 medium-12 small-12 columns">
            <div><a href="#"><img src="img/reklama.png"></a></div>
        </div>
    </div>


</div>


</div>
</div>