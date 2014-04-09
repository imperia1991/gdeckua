<?php
$title = 'title_' . Yii ::app()->getLanguage();
$this->pageTitle = $model->{$title};
?>
<div class="search-block">
<?php
$this->renderPartial('/partials/_search', array(
    'currentPage' => 1,
    'model' => $model,
));
?>
</div>
<div class="container">
    <div class="content" style="padding-left: 0;width: 100%;">
        <div id="placeMap" class="map" style="width: 100%;">
            <?php
                $this->renderPartial('partials/_mapOne', array(
                    'model' => $model,
                ));
            ?>
        </div>
        <div class="content-ad">
            <!--<img src="/images/rek492x70.png" alt="">-->

        </div>

        <div style="margin-bottom: 20px;">
            <?php $this->renderPartial('/partials/_find_' . Yii::app()->language); ?>
        </div>
    </div>
</div><!-- .container-->
