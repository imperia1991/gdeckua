<?php
$url = '?' . Yii::app()->request->queryString;
if (!Yii::app()->request->queryString) {
    $tmp = explode(Yii::app()->getLanguage() . '/', Yii::app()->request->requestUri);

    $url = '/' . $tmp[1];
}
?>
<div class="flag">
    <a href="<?php echo Yii::app()->baseUrl . '/ru' . $url; ?>" class="tooltip-rus">
        <i class="rus"></i>
        <span>Русская версия сайта</span>
    </a>
    <a href="<?php echo Yii::app()->baseUrl . '/uk' . $url; ?>" class="tooltip-ua">
        <i class="ua"></i>
        <span>Українська версія сайту</span>
    </a>
</div>

