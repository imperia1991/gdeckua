<?php
$this->pageTitle = Yii::t('main', 'О проекте');

$this->breadcrumbs = [
    '' => Yii::t('main', 'О проекте')
];
?>

<?php
/** @var Settings $settingsModel */
?>

<div class="page_content about">
    <div class="about_text">
        <?php echo $settingsModel->about; ?>
    </div>

    <div class="about_contacts">
        <div class="title"><?php echo Yii::t('main', 'Контактная информация') ?></div>
        <div class="clearfix">
            <div class="contacts">
                <?php echo $settingsModel->contacts; ?>
            </div>
        </div>
    </div>

    <div id="help" class="help">
        <div class="title"><?php echo Yii::t('main', 'Помочь сайту') ?></div>
        <div class="help_content">
            <?php echo $settingsModel->helps; ?>
        </div>
    </div>
</div>