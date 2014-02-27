<div id="header-wrapper">
    <div id="header">
        <div id="header-inner">
            <div class="container">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="row">
                            <div class="logo-wrapper span4">
                                <a href="#nav" class="hidden-desktop" id="btn-nav"><?php echo Yii::t('main', 'Меню'); ?></a>

                                <div class="logo">
                                    <a href="<?php echo Yii::app()->baseUrl . '/' . Yii::app()->getLanguage(); ?>" title="<?php echo Yii::t('main', 'Главная'); ?>">
                                        <img src="/img/logo.png" alt="<?php echo Yii::t('main', 'Главная'); ?>">
                                    </a>
                                </div><!-- /.logo -->

                                <div class="site-name">
                                    <a href="<?php echo Yii::app()->baseUrl . '/' . Yii::app()->getLanguage(); ?>" title="<?php echo Yii::t('main', 'Главная'); ?>" class="brand"><?php echo Yii::t('main', 'Работенка'); ?></a>
                                </div><!-- /.site-name -->

                                <div class="site-slogan">
                                    <span><?php echo Yii::t('main', 'Сайт мелких поручений'); ?></span>
                                </div><!-- /.site-slogan -->
                            </div><!-- /.logo-wrapper -->

                            <div class="info">
                                <div class="site-phone">
                                    <?php if (Yii::app()->user->isGuest): ?>
                                    <span class="welcome"><?php echo Yii::t('main', 'Добро пожаловать') ?>, <?php echo Yii::t('main', 'Гость'); ?></span>
                                    <?php else: ?>
                                    <span class="welcome"><?php echo Yii::t('main', 'Добро пожаловать') ?>, <?php echo Yii::t('main', $this->modelUser->name); ?></span>
                                    <?php endif; ?>
                                </div><!-- /.site-email -->
                            </div><!-- /.info -->

                            <a class="btn btn-primary btn-large list-your-property arrow-right" href="/errands/create"><?php echo CHtml::encode(Yii::t('main', 'Добавить объявление')); ?></a>
                        </div><!-- /.row -->
                    </div><!-- /.navbar-inner -->
                </div><!-- /.navbar -->
            </div><!-- /.container -->
        </div><!-- /#header-inner -->
    </div><!-- /#header -->
</div><!-- /#header-wrapper -->
