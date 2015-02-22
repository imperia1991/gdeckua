<?php
/** @var Places $model */

$title            = 'title_' . Yii::app()->getLanguage();
$address          = 'address_' . Yii::app()->getLanguage();
$description      = 'description_' . Yii::app()->getLanguage();
$shortDescription = 'short_description_' . Yii::app()->getLanguage();
$this->keywords   = $model->tags->tags . ', ' . $model->{$title};

$this->pageTitle = CHtml::encode( $model->{$title} );
?>
<?php
$this->breadcrumbs = [
    '' => Yii::t( 'main', 'Расширенный просмотр' ) . ': ' . $model->{$title}
];
?>

<div class="page_content object_page">
    <div class="object_columns clearfix">
        <div class="object_photo_block">
            <h2>
                <?php echo $model->{$title}; ?>
            </h2>
            <?php $path = '/' . Yii::app()->params['admin']['files']['imagesB'] . $model->photos[0]->title; ?>
            <div class="object_big_photo">
                <a href="<?php echo $path; ?>" class="colorbox">
	                <img src="<?php echo $path ?>">
                </a>
            </div>
            <ul class="objects_previews">
                <?php $index = 0;
                foreach ( $model->photos as $photo ): ?>
                    <?php
                    if ( $index ++ == 0 ) {
                        continue;
                    }
                    $pathB = '/' . Yii::app()->params['admin']['files']['imagesB'] . $photo->title;
                    $pathS = '/' . Yii::app()->params['admin']['files']['imagesS'] . $photo->title;
                    ?>
                    <li class="objects_previews_item active">
                        <a class="colorbox" href="<?php echo $pathB; ?>"
                           title="<?php echo $model->{$title}; ?>"
                           alt="<?php echo $model->{$title}; ?>">
                            <img src="<?php echo $pathS; ?>" />
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="object_adress">
            <h2><?php echo $model->{$address}; ?></h2>

            <div class="object_map">
                <div id="placeMap" style="height: 378px">
                    <?php
                    $this->renderPartial(
                        'partials/_mapOne',
                        [
                            'model' => $model,
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="object_desc">
        <h2><?php echo Yii::t( 'main', 'Описание' ); ?>:</h2>

        <p>
            <?php echo $model->{$description}; ?>
        </p>

        <h2><?php echo Yii::t( 'main', 'Контакты' ); ?>:</h2>
        <?php if ( !$model->isEmptyContact() ): ?>

            <p>
                <?php if ( !$model->isEmptyContact() ): ?>
                    <?php if ( $model->contact->phone_city ): ?>
                        <?php echo Yii::t( 'main', 'Телефон городской' ); ?>
                        : <?php echo $model->contact->phone_city; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->phone_mobile1 ): ?>
                        <?php echo Yii::t( 'main', 'Телефон мобильный' ); ?>
                        : <?php echo $model->contact->phone_mobile1; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->phone_mobile2 ): ?>
                        <?php echo Yii::t( 'main', 'Телефон мобильный (дополнительный)' ); ?>
                        : <?php echo $model->contact->phone_mobile2; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->phone_mobile3 ): ?>
                        <?php echo Yii::t( 'main', 'Телефон мобильный (дополнительный)' ); ?>
                        : <?php echo $model->contact->phone_mobile3; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->phax ): ?>
                        <?php echo Yii::t( 'main', 'Факс' ); ?>: <?php echo $model->contact->phax; ?>
                        <br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->email ): ?>
                        <?php echo Yii::t( 'main', 'Электронный адрес (email)' ); ?>
                        : <?php echo $model->contact->email; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->skype ): ?>
                        <?php echo Yii::t( 'main', 'Скайп (skype)' ); ?>
                        : <?php echo $model->contact->skype; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->operation_time ): ?>
                        <?php echo Yii::t( 'main', 'Время работы' ); ?>
                        : <?php echo $model->contact->operation_time; ?><br/>
                    <?php endif; ?>
                    <?php if ( $model->contact->site ): ?>
                        <?php $site = str_replace( [ 'http://', 'https://' ], '', $model->contact->site ); ?>
                        <?php echo Yii::t( 'main', 'Сайт' ); ?>:
                        <a href="<?php echo $model->contact->site; ?>" target="_blank"><?php echo $site; ?></a>
                        <br/>
                    <?php endif; ?>
                <?php endif; ?>
            </p>

            <?php $howToGet = 'how_to_get_' . Yii::app()->getLanguage(); ?>
            <?php if ( $model->{$howToGet} ): ?>
                <h2><?php echo Yii::t( 'main', 'Как добраться' ); ?>:</h2>
                <p>
                    <?php echo $model->{$howToGet} ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ( $model->isEmptyContact() ): ?>

            <p><?php echo Yii::t( 'main', 'Информация уточняется' ); ?></p>
        <?php endif; ?>
    </div>

    <?php echo $this->renderPartial(
        '/partials/_comments',
        [
            'comment' => $comment,
            'model' => $model,
            'caption' => Yii::t('main', 'Комментарии к объекту'),
            'url' => Yii::app()->createUrl('/comments/comments'),
        ]
    ); ?>

</div>