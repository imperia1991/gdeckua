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
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'type'=>'inverse', // null or 'inverse'
            'brand'=>Yii::app()->name,
            'brandUrl'=>'/',
            'collapse'=>true, // requires bootstrap-responsive.css
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(
                        array('label'=>'Пользователи', 'url'=>'/admin/user', 'active' => $this->menuActive == 'user', 'visible' => Yii::app()->user->checkAccess('admin')),
                        array('label'=>'Места', 'url'=>'/admin/place', 'active' => $this->menuActive == 'place', 'visible' => Yii::app()->user->checkAccess('admin')),
                        array('label'=>'Районы', 'url'=>'/admin/district', 'active' => $this->menuActive == 'district', 'visible' => Yii::app()->user->checkAccess('admin')),
                        array('label'=>'Настройки поиска', 'url'=>'/admin/search', 'active' => $this->menuActive == 'search', 'visible' => Yii::app()->user->checkAccess('admin')),
                        array('label'=>'Статистика', 'url'=>'/admin/statistics', 'active' => $this->menuActive == 'statistic', 'visible' => Yii::app()->user->checkAccess('admin')),
                        array('label'=>'Выйти', 'url'=>'/admin/default/logout', 'visible' => Yii::app()->user->checkAccess('admin')),
                    ),
                ),
            ),
        )); ?>
    </div>
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
            'block'=>true, // display a larger alert block?
            'fade'=>true, // use transitions?
            'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
            'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true, 'fade'=>true), // success, info, warning, error or danger
                'error'=>array('block'=>true, 'fade'=>true), // success, info, warning, error or danger
            ),
        )); ?>
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
