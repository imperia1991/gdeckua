<div class="other_news">
    <div class="title"><?php echo Yii::t('main', 'Новости Черкащины'); ?> :</div>
    <div id="rssView">
        <?php $this->renderPartial(
            'partials/_rssView',
            [
                'rss' => $rss,
            ]
        ) ?>
    </div>
</div>