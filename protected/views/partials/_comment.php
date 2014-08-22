<?php
$odd = false;
if (isset($page) && $page > 1) {
    $odd = (($index + $page) % 2) ? true : false;
} else {
    $odd = ($index % 2) ? false : true;
}
?>
<div class="large-12 columns row collapse">
    <?php if ($odd): ?>
        <div class="large-1 medium-1 columns comment-icon">
            <img src="/img/comment.png" class="left">
        </div>

        <div class="large-11 medium-11 columns comment-box-left">
            <div class="comment-box-inner-left">
                <div class="large-6 medium-6 small-4 columns right"><p class="right"><a href="javascript:void(0)"><?php echo CHtml::encode($data->name); ?></a></p></div>
                <div class="large-6 medium-6 small-8 columns left"><p class="left"><?php echo $data->created_at; ?></p></div>
                <p><?php echo $data->message; ?></p>
            </div>
            <div class="comment-square-left"></div>
        </div>

    <?php else: ?>

        <div class="large-11 medium-11 columns comment-box-right">
            <div class="comment-square-right"></div>
            <div class="comment-box-inner-right">
                <div class="large-6 columns left small-4"><p class="left"><a href="javascript:void(0)"><?php echo CHtml::encode($data->name); ?></a></p></div>
                <div class="large-6 columns right small-8"><p class="right"><?php echo $data->created_at; ?></p></div>
                <p><?php echo $data->message; ?></p>
            </div>
        </div>
        <div class="large-1 medium-1 columns comment-icon-right">
            <img src="/img/comment-right.png" class="right">
        </div>

    <?php endif; ?>

</div>
<div class="large-12 columns"></div>
