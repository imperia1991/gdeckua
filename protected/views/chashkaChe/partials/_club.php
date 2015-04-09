<div class="other_news">
    <div class="title"><?php echo Yii::t('main', 'Новости клуба'); ?> :</div>
    <div id="clubView">
        <?php $this->renderPartial(
            'partials/_clubView',
            [
                'clubs' => $clubs,
            ]
        ) ?>
    </div>
</div>