<?php
$title = 'title_' . Yii::app()->getLanguage();
?>

<li onmouseover="showPlacemark(<?php echo $data->id; ?>)" onclick="clickPlacemark(<?php echo $data->id; ?>)" onmouseout="hidePlacemark(<?php echo $data->id; ?>)">
    <a class="big-photo" rel="lightgallery" href="images/photo.png">
        <img src="images/photo.png" alt="">
        <i class="enlarge">Увеличить</i>
    </a>
    <div class="item">
        <h1><?php echo $data->{$title}; ?></h1>
        <div class="address">
            <span><?php echo $data->address; ?></span>
            <span><?php echo $data->description; ?></span>
        </div>
    </div>
</li>