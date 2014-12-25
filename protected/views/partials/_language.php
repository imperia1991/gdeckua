<?php
$url = Yii::app()->getRequest()->getPathInfo();

$count = 1;
$url = str_replace(Yii::app()->getLanguage(), '', $url, $count);
?>

<ul class="languages">
    <li <?php if (Yii::app()->getLanguage() == 'uk'): ?> class="active" <?php endif; ?>><a href="<?php echo '/uk' . $url; ?>" title="Українська">UA</a></li>
    <li <?php if (Yii::app()->getLanguage() == 'ru'): ?> class="active" <?php endif; ?>><a href="<?php echo '/ru' . $url; ?>" title="Русский">RU</a></li>
</ul>



