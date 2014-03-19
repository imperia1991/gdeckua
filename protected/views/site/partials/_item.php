<?php
$title = 'title_' . Yii::app()->getLanguage();
?>

<h2><?php echo $data->{$title}; ?></h2>
<h2><?php echo $data->address; ?></h2>
<p><?php echo $data->description; ?></p>