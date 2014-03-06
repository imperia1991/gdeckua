<?php
$lang = Yii::app()->language;
?>

<a href="<?php echo Yii::app()->baseUrl . '/ru?' . Yii::app()->request->queryString; ?>" title="<?php echo Yii::app()->params['languages']['ru']; ?>"><?php echo Yii::app()->params['languages']['ru']; ?></a>&nbsp;&nbsp;
<a href="<?php echo Yii::app()->baseUrl . '/uk?' . Yii::app()->request->queryString; ?>" title="<?php echo Yii::app()->params['languages']['uk']; ?>"><?php echo Yii::app()->params['languages']['uk']; ?></a>
