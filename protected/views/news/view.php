<?php
/** @var News $prevNewsModel */
/** @var News $currentNewsModel */
/** @var News $nextNewsModel */
?>
<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Просмотр новости') . ' - ' . $currentNewsModel->title,
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<?php
//$currentNewsModel = isset($newsModels[])
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
<!--                        --><?php //$this->renderPartial(
//                            '/partials/_social',
//                            [
//                                'image' => Yii::app()->createUrl('/uploads/photos/news/' . $currentNewsModel->photo),
//                                'title' => $currentNewsModel->title,
//                            ]
//                        ); ?>
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