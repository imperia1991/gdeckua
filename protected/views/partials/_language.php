<?php
$lang = Yii::app()->language;
?>

<div class="flag">
    <a href="<?php echo Yii::app()->baseUrl . '/ru?' . Yii::app()->request->queryString; ?>" title="<?php echo Yii::app()->params['languages']['ru']; ?>" class="ru"></a>
    <a href="<?php echo Yii::app()->baseUrl . '/uk?' . Yii::app()->request->queryString; ?>" title="<?php echo Yii::app()->params['languages']['uk']; ?>" class="uk"></a>
</div>

