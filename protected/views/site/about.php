<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'О Проекте')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<?php
/** @var Settings $settingsModel */
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns left-sector-about-page">
            <div class="row">
                <div class="large-12 columns user-information">
                    <?php echo $settingsModel->about; ?>
                </div>
                <div class="large-12 columns contact-divider">
                    <p> <?php echo Yii::t('main', 'Контактная информация') ?> </p>
                    <hr>
                </div>
                <div class="row collapse">
                    <div class="large-12 columns contact-information">
                        <div class="large-6 medium-6 columns">
                            <?php echo $settingsModel->contacts; ?>
                        </div>
                        <div class="large-6 medium-6 columns">
                            <img src="/img/map.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->renderPartial('/partials/_previewNews'); ?>

    </div>
</div>