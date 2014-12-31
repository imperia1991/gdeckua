<?php
/** @var News $prevNewsModel */
/** @var News $currentNewsModel */
/** @var News $nextNewsModel */
?>
<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Просмотр новости') . ' - ' . $currentNewsModel->title,
];
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns left-sector-large-view">

            <div class="row collapse new-box">
                <div class="large-12 columns left-sector-news-box">
                    <div class="row left-sector-news-title collapse">
                        <div class="large-2 medium-2 small-12 columns">
                            <p><?php echo Yii::t('main', 'добавлено'); ?>:</p>

                            <p>
                                <?php echo Yii::t(
                                    'main',
                                    '{date} в {time}',
                                    [
                                        '{date}' => Yii::app()->dateFormatter->format(
                                                'dd.MM.yyyy',
                                                $currentNewsModel->created_at
                                            ),
                                        '{time}' => Yii::app()->dateFormatter->format(
                                                'HH:mm',
                                                $currentNewsModel->created_at
                                            )
                                    ]
                                ); ?>
                            </p>
                        </div>
                        <div class="large-10 medium-10 small-12 columns">
                            <p>
                                <?php echo $currentNewsModel->title; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="large-12 columns main-news-inner">
                            <?php echo $currentNewsModel->text; ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row news-box-switcher">
                <div class="large-6 medium-6 columns">
                    <?php if ($prevNewsModel): ?>
                        <p class="left">
                            <a href="<?php echo Yii::app()->createUrl(
                                '/' . Yii::app()->getLanguage(
                                ) . '/news/' . $prevNewsModel->id . '/' . $prevNewsModel->alias
                            ) ?>">
                                << <?php echo Yii::t('main', 'Предыдущая новость'); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="large-6 medium-6 columns">
                    <?php if ($nextNewsModel): ?>
                        <p class="right">
                            <a href="<?php echo Yii::app()->createUrl(
                                '/' . Yii::app()->getLanguage(
                                ) . '/news/' . $nextNewsModel->id . '/' . $nextNewsModel->alias
                            ) ?>">
                                <?php echo Yii::t('main', 'Следующая новость'); ?> >>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row collapse share-new">
                <div class="large-12 columns">
                    <div class="left">
                        <?php $this->renderPartial(
                            '/partials/_social',
                            [
                                'image' => Yii::app()->createUrl('/uploads/photos/news/' . $currentNewsModel->photo),
                                'title' => $currentNewsModel->title,
                            ]
                        ); ?>
                    </div>
                </div>
            </div>

            <?php echo $this->renderPartial(
                '/partials/_comments',
                [
                    'comment' => $comment,
                    'model' => $currentNewsModel,
                    'caption' => Yii::t('main', 'Комментарии к новости'),
                    'url' => Yii::app()->createUrl('/comments/commentsNews'),
                ]
            ); ?>

        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>


    </div>
</div>

<div class="page_content news_single">
    <h1 class="news_single_title">
        <?php echo $currentNewsModel->title; ?>
    </h1>
    <div class="news_single_date">
        <?php echo Yii::t('main', 'добавлено'); ?>
        <?php echo Yii::t(
            'main',
            '{date} в {time}',
            [
                '{date}' => Yii::app()->dateFormatter->format(
                    'dd.MM.yyyy',
                    $currentNewsModel->created_at
                ),
                '{time}' => Yii::app()->dateFormatter->format(
                    'HH:mm',
                    $currentNewsModel->created_at
                )
            ]
        ); ?>
    </div>
    <div class="news_single_content">
        <p>
            <?php echo $currentNewsModel->text; ?>
        </p>
        <ul class="socials">
            <li class="socials_item"><a href="#" class="socials_link facebook"></a></li>
            <li class="socials_item"><a href="#" class="socials_link vk"></a></li>
            <li class="socials_item"><a href="#" class="socials_link od"></a></li>
            <li class="socials_item"><a href="#" class="socials_link tweeter"></a></li>
            <li class="socials_item"><a href="#" class="socials_link google"></a></li>
            <li class="socials_item"><a href="#" class="socials_link mailru"></a></li>
        </ul>
    </div>

    <div class="home_news">
        <div class="title">читайте так же:</div>
        <ul class="home_news_list clearfix">
            <li class="home_news_item">
                <a href="#">
                    <div class="home_news_item_text">
                        Sinoptik: Погода в Черкасах та Черкаській області на вівторо 25 листопада
                    </div>
                    <div class="home_news_item_date">
                        23 листопада 14:54
                    </div>
                </a>
            </li>
            <li class="home_news_item">
                <a href="#">
                    <div class="home_news_item_text">
                        Украинцы на референдуме примут решение, вступать ли государству в НАТО или нет
                    </div>
                    <div class="home_news_item_date">
                        23 листопада 14:54
                    </div>
                </a>
            </li>
            <li class="home_news_item">
                <a href="#">
                    <div class="home_news_item_text">
                        Украинцы на референдуме примут решение, вступать ли государству в НАТО или нет
                    </div>
                    <div class="home_news_item_date">
                        23 листопада 14:54
                    </div>
                </a>
            </li>
            <li class="home_news_item">
                <a href="#">
                    <div class="home_news_item_text">
                        Sinoptik: Погода в Черкасах та Черкаській області на вівторо 25 листопада
                    </div>
                    <div class="home_news_item_date">
                        23 листопада 14:54
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <h2>КОММЕНТАРИИ (2):</h2>
    <form>
        <div class="add_comment ">
            <div class="add_comment_left">
                <div class="input_wrap">
                    <textarea class="input" placeholder="Напишите комментарий..."></textarea>
                </div>

            </div>
            <div class="add_comment_right">
                <div class="input_wrap">
                    <input type="text" class="input" placeholder="Введите Ваше имя *">
                </div>
                <div class="input_wrap captcha_block clearfix">
                    <div class="captcha_image">
                        <img src="images/data/captcha.jpg" alt="">
                        <a href="#" class="captcha_refresh">Обновить</a>
                    </div>
                    <input type="text" class="input captcha_input" placeholder="Введите код с картинки *">
                </div>
                <div class="pop_up_bottom clearfix">
                    <input type="submit" value="Добавить" class="submit">
                </div>
            </div>
        </div>
    </form>
    <ul class="comments clearfix">
        <li class="comment">
            <div class="comment_title">
                <span class="comment_author">Гадя Петрович Херово</span> <span class="comment_date">18 ноября 2014 в 16:48  </span>
                <div class="comment_text">
                    Ваш Грузчик. Сервисная Служба Авто Доставки. УСЛУГИ ПРОФЕСИОНАЛЬНЫХ ГРУЗЧИКОВ !!! Профессии очень ответственной и затрагивающей многие сферы жизни, могут понадобится любому человеку. Ведь все люди используют грузовые перевозки в своих
                </div>
            </div>
        </li>
        <li class="comment">
            <div class="comment_title">
                <span class="comment_author">Ирина Владимировна</span> <span class="comment_date">18 ноября 2014 в 15:46</span>
                <div class="comment_text">
                    Ваш Грузчик. Сервисная Служба Авто Доставки. УСЛУГИ ПРОФЕСИОНАЛЬНЫХ ГРУЗЧИКОВ !!! Профессии очень ответственной и затрагивающей многие сферы жизни, могут понадобится любому человеку. Ведь

                </div>
            </div>
        </li>
    </ul>
</div>