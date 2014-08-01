<div class="large-12 columns navigation-top">
    <p><a href="#"><?php echo Yii::t('main', 'Главная'); ?></a> > <?php echo Yii::t('main', 'Ошибка 404'); ?> </p>
    <hr>
</div>
<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-4  columns left-sector-error">
            <div class="error-page">
                <ul>
                    <li><?php echo Yii::t('main', 'Страница не существует'); ?> :(</li>
                    <li class="large-font-error">404</li>
                </ul>
            </div>
            <div><p><a href="/"><?php echo Yii::t('main', 'перейти на главную'); ?></a></p></div>
        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>

    </div>
</div>