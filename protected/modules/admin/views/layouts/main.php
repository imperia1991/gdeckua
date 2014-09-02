<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <?php Yii::app()->getModule('admin')->bootstrap->register(); ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <base href="<?php echo Yii::app()->baseUrl; ?>"/>
</head>

<body id="top">
<div class="container" id="page" style="margin-top: 80px;">
    <div id="mainmenu">
        <?php $this->widget(
            'bootstrap.widgets.TbNavbar',
            [
                'type' => 'inverse', // null or 'inverse'
                'brand' => Yii::app()->name,
                'brandUrl' => '/',
                'collapse' => true, // requires bootstrap-responsive.css
                'items' => [
                    [
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => [
                            [
                                'label' => 'Пользователи',
                                'url' => '/admin/user',
                                'active' => $this->menuActive == 'user',
                                'visible' => Yii::app()->user->checkAccess('admin')
                            ],
                            [
                                'label' => 'Сайт',
                                'url' => '/admin/place',
                                'active' => in_array(
                                    $this->menuActive,
                                    ['district', 'place', 'news', 'photo', 'poster', 'settings', 'statistic']
                                ),
                                'visible' => Yii::app()->user->checkAccess('admin'),
                                'items' => [
                                    [
                                        'label' => 'Районы',
                                        'url' => '/admin/district',
                                        'active' => $this->menuActive == 'district',
                                        'visible' => Yii::app()->user->checkAccess('admin')
                                    ],
                                    [
                                        'label' => 'Места',
                                        'url' => '/admin/place',
                                        'items' => [
                                            ['label' => 'Места', 'url' => '/admin/place'],
                                            ['label' => 'Категории', 'url' => '/admin/category'],
                                            ['label' => 'Комментарии', 'url' => '/admin/comments'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Новости',
                                        'url' => '/admin/news',
                                        'active' => $this->menuActive == 'news',
                                        'items' => [
                                            ['label' => 'Новости', 'url' => '/admin/news'],
                                            ['label' => 'Категории', 'url' => '/admin/categoryNews'],
                                            ['label' => 'Комментарии', 'url' => '/admin/commentsNews'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Фотографии',
                                        'url' => '/admin/photoCity',
                                        'active' => $this->menuActive == 'photo',
                                        'items' => [
                                            ['label' => 'Города', 'url' => '/admin/photoCity'],
                                            ['label' => 'Фотоблог ', 'url' => '/admin/photoBlog'],
//                            ['label'=>'Комментарии фото города', 'url'=>'/admin/commentsPhotoCity'],
//                            ['label'=>'Комментарии фотоблогов', 'url'=>'/admin/commentsPhotoBlog'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Афиша',
                                        'url' => '/admin/poster',
                                        'active' => $this->menuActive == 'poster',
                                        'items' => [
                                            ['label' => 'Категории', 'url' => '/admin/categoryPoster'],
                                            ['label' => 'Афишы', 'url' => '/admin/posters'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Статистика',
                                        'url' => '/admin/statistics',
                                        'active' => $this->menuActive == 'statistic',
                                        'visible' => Yii::app()->user->checkAccess('admin')
                                    ],
                                    [
                                        'label' => 'О проекте',
                                        'url' => '/admin/settings',
                                        'active' => $this->menuActive == 'settings'
                                    ],
                                ]
                            ],
                            [
                                'label' => 'Настройки',
                                'url' => '/admin/search',
                                'active' => $this->menuActive == 'search',
                                'visible' => Yii::app()->user->checkAccess('admin'),
                                'items' => [
                                    ['label' => 'Поиск', 'url' => '/admin/search'],
                                ]
                            ],
//                            [
//                                'label' => 'Разработка',
//                                'url' => '/admin/develop',
//                                'active' => $this->menuActive == 'develop',
//                                'visible' => Yii::app()->user->checkAccess('admin')
//                            ],
                            [
                                'label' => 'Реклама',
                                'url' => '/admin/banners',
                                'active' =>  in_array($this->menuActive, ['banners']),
                                'visible' => Yii::app()->user->checkAccess('admin'),
                                'items' => [
                                    [
                                        'label' => 'Банеры',
                                        'url' => '/admin/banners',
                                        'active' => $this->menuActive == 'banners',
                                        'visible' => Yii::app()->user->checkAccess('admin')
                                    ],
                                ]
                            ],
                            [
                                'label' => 'Выйти',
                                'url' => '/admin/default/logout',
                                'visible' => Yii::app()->user->checkAccess('admin')
                            ],
                        ],
                    ],
                ],
            ]
        ); ?>
    </div>
    <div class="row">
        <?php $this->widget(
            'bootstrap.widgets.TbAlert',
            [
                'block' => true, // display a larger alert block?
                'fade' => true, // use transitions?
                'closeText' => '&times;', // close link text - if set to false, no close link is displayed
                'alerts' => [ // configurations per alert type
                    'success' => ['block' => true, 'fade' => true], // success, info, warning, error or danger
                    'error' => ['block' => true, 'fade' => true], // success, info, warning, error or danger
                ],
            ]
        ); ?>
    </div>
    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer" style="text-align: center;">
        Copyright &copy; <?php echo date('Y'); ?>.
        Все права защищены.<br/>
    </div>
    <!-- footer -->
</div>
</body>
</html>
