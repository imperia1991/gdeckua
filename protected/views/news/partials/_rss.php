<div class="llarge-12 columns news-accordion">
    <ul class="tabs" data-tab >
        <li class="tab-title active"
            style="float: none;font-size: 0.85em;font-weight: 700;line-height: 30px;margin-bottom: 5px;font-family: 'tahoma', 'arial', 'verdana', sans-serif, 'Lucida Sans';text-align: center;" >
            <?php echo Yii::t('main', 'Новости Черкащины'); ?>
        </li>
    </ul>
    <div class="tabs-content">
        <div id="rssView" class="content active2">

            <?php $this->renderPartial(
                'partials/_rssView',
                [
                    'rss' => $rss,
                ]
            ) ?>

        </div>
    </div>
</div>