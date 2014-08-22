<?php
$dataUrl = 'http://' . Yii::app()->getRequest()->serverName . Yii::app()->getRequest()->requestUri;
if (isset($url)) {
    $dataUrl = 'http://' . Yii::app()->getRequest()->serverName . $url;;
}
$dataImage = 'http://' . Yii::app()->getRequest()->serverName . '/img/logo.png';
if (isset($image)) {
    $dataImage = 'http://' . Yii::app()->getRequest()->serverName . $image;;
}
$dataTitle = $this->pageTitle;
if (isset($title)) {
    $dataTitle = $title;
}
?>
<div class="share42init"
     data-image="<?php echo $dataImage; ?>"
     data-url="<?php echo $dataUrl; ?>"
     data-title="<?php echo $dataTitle; ?>"
    ></div>

<script type="text/javascript" src="http://<?php echo Yii::app()->getRequest()->serverName; ?>/js/share42/share42.js"></script>

