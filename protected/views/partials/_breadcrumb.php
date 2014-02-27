<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="breadcrumb pull-left">
                    <li><a href="<?php echo Yii::app()->getHomeUrl(); ?>"><?php echo Yii::t('main', 'Главная'); ?></a></li>
                </ul><!-- /.breadcrumb -->

                <div class="account pull-right">
                    <ul class="nav nav-pills">
                        <?php if (Yii::app()->user->isGuest): ?>
                        <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/login'); ?>"><?php echo Yii::t('main', 'Войти'); ?></a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/register'); ?>"><?php echo Yii::t('main', 'Регистрация'); ?></a></li>
                        <?php else: ?>
                        <li><a href="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/logout'); ?>"><?php echo Yii::t('main', 'Выйти'); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div><!-- /.span12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb-wrapper -->