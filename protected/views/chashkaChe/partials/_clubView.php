<?php /** @var CActiveDataProvider $rss */ ?>
<div class="row collapse news-in-accordion1">
    <?php $this->widget(
        'zii.widgets.CListView',
        [
            'dataProvider'     => $clubs,
            'itemView'         => 'partials/_oneClub',
            'ajaxUpdate'       => false,
            'emptyText'        => Yii::t('main', 'К сожалению в данном разделе новостей еще нет'),
            'summaryText'      => "",
            'emptyTagName'     => 'ul',
            'enablePagination' => false,
            'itemsTagName'     => 'ul',
            'htmlOptions'      => [
                'class' => 'other_news_list'
            ],
            'viewData'         => [
                'page' => isset($page) ? $page : 1,
            ],
        ]
    );
    ?>
</div>