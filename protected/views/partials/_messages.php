<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success" style="margin-top: 7px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo Yii::t('main', 'Успешно'); ?>. </strong><?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-error" style="margin-top: 7px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo Yii::t('main', 'Ошибка'); ?>. </strong><?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('info')): ?>
    <div class="alert alert-info" style="margin-top: 7px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo Yii::t('main', 'Информация'); ?>. </strong><?php echo Yii::app()->user->getFlash('info'); ?>
    </div>
<?php endif; ?>