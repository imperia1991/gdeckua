<?php
$url = Yii::app()->getRequest()->getPathInfo();

$count = 1;
$url = str_replace(Yii::app()->getLanguage(), '', $url, $count);
?>

<a href="<?php echo '/ru' . $url; ?>">
    <img src="/img/lang-ru.png" alt="Русский" title="Русский">
</a>
<a href="<?php echo '/uk' . $url; ?>">
    <img src="/img/lang-ua.png" alt="Українська" title="Українська">
</a>


