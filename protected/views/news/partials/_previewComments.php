<div class="right-section">
    <h4><?php echo Yii::t('main', 'Комментарии'); ?></h4>

    <?php
    /** @var CommentsNews[] $previewComments */
    /** @var CommentsNews $comment */
    ?>
    <?php foreach ($previewComments as $comment): ?>
    <div class="news-box row">
        <div class="row collapse">
            <div class="large-12 medium-3 small-12 columns oglavlenie">
                <div class="row collapse">
                    <div class="large-12 medium-12 small-12 columns">
                        <p class="right"><?php echo $comment->created_at; ?></p><br>
                        <h4><?php echo $comment->news->title; ?></h4>
                    </div>
                </div>
            </div>
            <div class="large-12 columns medium-9 small-12 description">
                <p><strong><?php echo $comment->name; ?></strong></p>
                <p><?php echo substr($comment->message, 0, 80); ?><?php if (strlen($comment->message) > 80) echo '...'; ?></p>
            </div>
            <div align="center" class="large-12 columns medium-9 small-12 news-link">
                <a align="center"href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/news/' . $comment->news->id . '/' . $comment->news->alias . '#comments') ?>"><?php echo Yii::t('main', 'все комментарии к новости'); ?></a>
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div>