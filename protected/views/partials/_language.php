<?php
$url = '?' . Yii::app()->request->queryString;
if (!Yii::app()->request->queryString) {
    $tmp = explode(Yii::app()->getLanguage() . '/', Yii::app()->request->requestUri);

    $url = '/' . $tmp[1];
}
?>
<div class="flag">
    <div style="float: right;">
        <a href="<?php echo Yii::app()->baseUrl . '/ru' . $url; ?>" class="tooltip-rus">
            <i class="rus"></i>
            <span>Русский</span>
        </a>
        <a href="<?php echo Yii::app()->baseUrl . '/uk' . $url; ?>" class="tooltip-ua">
            <i class="ua"></i>
            <span>Українська</span>
        </a>
    </div>
</div>

