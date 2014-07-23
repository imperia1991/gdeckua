<?php
$url = '?' . Yii::app()->request->queryString;
if (!Yii::app()->request->queryString) {
    $tmp = explode(Yii::app()->getLanguage() . '/', Yii::app()->request->requestUri);

    $url = '/' . $tmp[1];
}
?>

<a href="<?php echo Yii::app()->baseUrl . '/ru' . $url; ?>">
    <img src="/img/lang-ru.png" alt="Русский" title="Русский">
</a>
<a href="<?php echo Yii::app()->baseUrl . '/uk' . $url; ?>">
    <img src="/img/lang-ua.png" alt="Українська" title="Українська">
</a>


