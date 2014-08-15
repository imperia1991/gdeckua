<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<?php Yii::app()->getModule('admin')->bootstrap->register(); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <base href="<?php echo Yii::app()->baseUrl; ?>" />
</head>

<body id="top">
<div class="container" id="page" style="margin-top: 80px;">
	<div id="mainmenu">
        <?php $this->widget('bootstrap.widgets.TbNavbar', [
            'type'=>'inverse', // null or 'inverse'
            'brand'=>Yii::app()->name,
            'brandUrl'=>'/',
            'collapse'=>true, // requires bootstrap-responsive.css
            'items'=>[
                [
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>[
                        ['label'=>'Пользователи', 'url'=>'/admin/user', 'active' => $this->menuActive == 'user', 'visible' => Yii::app()->user->checkAccess('admin')],
                        ['label'=>'Места', 'url'=>'/admin/place', 'active' => $this->menuActive == 'place', 'visible' => Yii::app()->user->checkAccess('admin'), 'items' => [
                            ['label'=>'Места', 'url'=>'/admin/place'],
                            ['label'=>'Категории', 'url'=>'/admin/category'],
                            ['label'=>'Комментарии', 'url'=>'/admin/comments'],
                        ]],
                        ['label'=>'Фотографии', 'url'=>'/admin/photoCity', 'active' => $this->menuActive == 'photo', 'visible' => Yii::app()->user->checkAccess('admin'), 'items' => [
                            ['label'=>'Город/Мероприятия', 'url'=>'/admin/photoCity'],
                            ['label'=>'Фотоблог ', 'url'=>'/admin/photoBlog'],
                            ['label'=>'Комментарии фото города', 'url'=>'/admin/commentsPhotoCity'],
                            ['label'=>'Комментарии фотоблогов', 'url'=>'/admin/commentsPhotoBlog'],
                        ]],
                        ['label'=>'Районы', 'url'=>'/admin/district', 'active' => $this->menuActive == 'district', 'visible' => Yii::app()->user->checkAccess('admin')],
                        ['label'=>'Настройки', 'url'=>'/admin/search', 'active' => $this->menuActive == 'settings', 'visible' => Yii::app()->user->checkAccess('admin'), 'items' => [
                            ['label'=>'Поиск', 'url'=>'/admin/search'],
                            ['label'=>'О проекте', 'url'=>'/admin/settings'],
                        ]],
                        ['label'=>'Статистика', 'url'=>'/admin/statistics', 'active' => $this->menuActive == 'statistic', 'visible' => Yii::app()->user->checkAccess('admin')],
                        ['label'=>'Новости', 'url'=>'/admin/news', 'active' => $this->menuActive == 'news', 'visible' => Yii::app()->user->checkAccess('admin'), 'items' => [
                            ['label'=>'Новости', 'url'=>'/admin/news'],
                            ['label'=>'Категории', 'url'=>'/admin/categoryNews'],
                            ['label'=>'Комментарии', 'url'=>'/admin/commentsNews'],
                        ]],
//                        array('label'=>'Разработка', 'url'=>'/admin/develop', 'active' => $this->menuActive == 'develop', 'visible' => Yii::app()->user->checkAccess('admin')),
                        ['label'=>'Выйти', 'url'=>'/admin/default/logout', 'visible' => Yii::app()->user->checkAccess('admin')],
                    ],
                ],
            ],
        ]); ?>
    </div>
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbAlert', [
            'block'=>true, // display a larger alert block?
            'fade'=>true, // use transitions?
            'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
            'alerts'=>[ // configurations per alert type
                'success'=>['block'=>true, 'fade'=>true], // success, info, warning, error or danger
                'error'=>['block'=>true, 'fade'=>true], // success, info, warning, error or danger
            ],
        ]); ?>
    </div>
	<?php echo $content; ?>

	<div class="clear"></div>

    <div id="footer" style="text-align: center;">
        Copyright &copy; <?php echo date('Y'); ?>.
        Все права защищены.<br/>
    </div><!-- footer -->
</div>
</body>
</html>
