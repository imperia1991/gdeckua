<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <?php Yii::app()->getModule('boards')->bootstrap->register(); ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" href="/css/board.css" />
    <script type="text/javascript" src="/js/board/board.js"></script>
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
                                            [
                                                'label' => 'Места',
                                                'url' => '/admin/place',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/place'],
                                                    ['label' => 'Добавить', 'url' => '/admin/place/create'],
                                                ]
                                            ],
                                            ['label' => 'Категории', 'url' => '/admin/category'],
                                            ['label' => 'Комментарии', 'url' => '/admin/comments'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Новости',
                                        'url' => '/admin/news',
                                        'active' => $this->menuActive == 'news',
                                        'items' => [
                                            [
                                                'label' => 'Новости',
                                                'url' => '/admin/news',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/news'],
                                                    ['label' => 'Добавить', 'url' => '/admin/news/create'],
                                                ]
                                            ],
                                            [
                                                'label' => 'Категории',
                                                'url' => '/admin/categoryNews',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/categoryNews'],
                                                    ['label' => 'Добавить', 'url' => '/admin/categoryNews/create'],
                                                ]
                                            ],
                                            ['label' => 'Комментарии', 'url' => '/admin/commentsNews'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Фотографии',
                                        'url' => '/admin/photoCity',
                                        'active' => $this->menuActive == 'photo',
                                        'items' => [
                                            [
                                                'label' => 'Города',
                                                'url' => '/admin/photoCity',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/photoCity'],
                                                    ['label' => 'Добавить', 'url' => '/admin/photoCity/add'],
                                                ]
                                            ],
                                            ['label' => 'Фотоблог ', 'url' => '/admin/photoBlog'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Афиша',
                                        'url' => '/admin/poster',
                                        'active' => $this->menuActive == 'poster',
                                        'items' => [
                                            [
                                                'label' => 'Афишы',
                                                'url' => '/admin/posters',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/posters'],
                                                    ['label' => 'Добавить', 'url' => '/admin/posters/create'],
                                                ]
                                            ],
                                            [
                                                'label' => 'Категории',
                                                'url' => '/admin/categoryPoster',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/categoryPoster'],
                                                    ['label' => 'Добавить', 'url' => '/admin/categoryPoster/create'],
                                                ]
                                            ],
                                        ]
                                    ],
                                    [
                                        'label' => 'Объявления',
                                        'url' => '/admin/categoryBoards',
                                        'active' => $this->menuActive == 'boards',
                                        'items' => [
                                            [
                                                'label' => 'Объявления',
                                                'url' => '/admin/boards',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/boards'],
                                                    ['label' => 'Добавить', 'url' => '/admin/boards/create'],
                                                ]
                                            ],
                                            [
                                                'label' => 'Категории',
                                                'url' => '/admin/categoryBoards',
                                                'items' => [
                                                    ['label' => 'Все', 'url' => '/admin/categoryBoards'],
                                                    ['label' => 'Добавить', 'url' => '/admin/categoryBoards/create'],
                                                ]
                                            ],
                                        ]
                                    ],
                                    [
                                        'label' => 'Rss',
                                        'url' => '/admin/rss',
                                        'active' => $this->menuActive == 'rss',
                                        'items' => [
                                            ['label' => 'Сайты', 'url' => '/admin/rss'],
                                            ['label' => 'Новости', 'url' => '/admin/rss/news'],
                                            ['label' => 'Добавить сайт', 'url' => '/admin/rss/create'],
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
