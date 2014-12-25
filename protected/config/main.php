<?php

$localConfig = file_exists(dirname(__FILE__) . '/local.php') ? require_once(dirname(__FILE__) . '/local.php') : [];
// uncomment the following to define a path alias
Yii::setPathOfAlias('bootstrap', realpath(__DIR__ . '/../extensions/bootstrap'));
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$mainConfig = [
    'timeZone' => 'Europe/Kiev',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Где в Черкассах',
    //Язык по умолчанию
//    'sourceLanguage' => 'ru',
//    'language' => 'ru',
    // preloading 'log' component
    'preload' => [
        'log',
    ],
    // autoloading model and component classes
    'import' => [
        'application.models.*',
        'application.components.*',
        'ext.mail.YiiMailMessage',
        'ext.JsTrans.*',
        'ext.Scalar.*',
        'application.extensions.CAdvancedArFindBehavior',
        'ext.easyimage.EasyImage',
        'ext.tinymce.*',
        'ext.elFinder.*',
    ],
    'modules' => [
        // uncomment the following to enable the Gii tool
        'gii' => [
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => ['127.0.0.1', '::1'],
        ],
        'admin' => [
//			'layout' => 'application.modules.admin.views.layouts.main',
            'preload' => ['bootstrap'],
            'components' => [
                'bootstrap' => [
                    'class' => 'bootstrap.components.Bootstrap',
                ],
            ],
        ],
        'boards' => [
            'preload' => ['bootstrap'],
            'components' => [
                'bootstrap' => [
                    'class' => 'bootstrap.components.Bootstrap',
                ],
            ],
        ]
    ],
    // application components
    'components' => [
        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
//            'loginUrl' => 'signin'
        ],
        'request' => [
            'enableCookieValidation' => true,
//            'enableCsrfValidation' => true,
        ],
        'clientScript' => [
            'packages' => [
                'jquery' => [
                    'baseUrl' => '/js/new',
                    'js' => ['jquery-1.11.1.min.js']
                ],
//                'jquery.ui' => array(
//                    'baseUrl' => '/libraries/jquery-ui-1.10.2.custom/js',
//                    'js' => array('jquery-ui-1.10.2.custom.min.js')
//                )
            ]
        ],
        // uncomment the following to enable URLs in path-format
        'urlManager' => [
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => [
                '<module:(admin|board)>' => '<module>/default/index',
                '<module:(admin)>/sitemap.xml' => '<module>/sitemap/index',
                '<module:(admin|board)>/<controller:\w+>' => '<module>/<controller>/index',
                '<module:(admin|board)>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<language:(ru|uk)>/' => 'site/index',
                '<language:(ru|uk)>/page/<page:\d+>' => 'site/index',
                '<language:(ru|uk)>/view/<id:\d+>/<alias>' => 'site/view',
                '<language:(ru|uk)>/news/<id:\d+>/<alias>' => 'news/view',
                '<language:(ru|uk)>/news/<alias:[\w-_]+>' => 'news/index',
                '<language:(ru|uk)>/photo/<action:\w+>' => 'photo/<action>',
                '<language:(ru|uk)>/photo/<id:\d+>/<alias>' => 'photo/view',
                '<language:(ru|uk)>/photo/<action:\w+>/<id:\d+>' => 'photo/<action>',
                '<language:(ru|uk)>/poster/<alias:[\w-_]+>' => 'poster/index',
                '<language:(ru|uk)>/<controller:(news)>' => 'news/index',
                '<language:(ru|uk)>/<controller:(photo)>' => 'photo/index',
                '<language:(ru|uk)>/<controller:(poster)>' => 'poster/index',
                '<language:(ru|uk)>/<controller:(webcams)>' => 'webcams/index',
                '<language:(ru|uk)>/<action:\w+>/*' => 'site/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
            ],
        ],
//        'db' => array(
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
//        ),
        // uncomment the following to use a MySQL database
        'db' => [
            'connectionString' => 'mysql:host=localhost;dbname=gdeckua',
            'emulatePrepare' => true,
            'username' => 'gdeckua',
            'password' => 'gdeckua2014',
            'charset' => 'utf8',
        ],
        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ],
        ],
        'image' => [
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => ['directory' => '/imagemagick'],
        ],
        'mail' => [
            'class' => 'ext.mail.YiiMail',
//			'transportType' => 'smtp',
//			'transportOptions'=>array(
//					'host'=>'mail.ukraine.com.ua',
//					'encryption'=>'ssl',
//					'username'=>'support@frahts.com',
//					'password'=>'teacher1991',
//					'port'=>465,
//			  ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ],
        'easyImage' => [
            'class' => 'application.extensions.easyimage.EasyImage',
            'retinaSupport' => true,
            'quality' => 100,
            'driver' => 'Imagick',
        ],
        'search' => [
            'class' => 'application.components.DGSphinxSearch',
            'server' => '127.0.0.1',
            'port' => 9312,
            'maxQueryTime' => 3000,
            'enableProfiling' => 0,
            'enableResultTrace' => 0,
            'fieldWeights' => [
                'name' => 10000,
                'keywords' => 100,
            ],
        ],
        'sphinx' => [
            'class' => 'system.db.CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;port=9306',
        ],
    ],
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => [
        // this is used in contact page
        'adminEmail' => 'support@gde.ck.ua',
        'supportEmail' => 'support@gde.ck.ua',
        'languages' => ['ru' => 'Русский', 'uk' => 'Українська'],
        'languagesSelect' => ['ru' => 'uk', 'uk' => 'ru'],
        'pageSize' => 10,
        'pageSizeComment' => 20,
        'pageSizeNews' => 20,
        'pageSizePhotos' => 20,
        'pageSizePosters' => 10,
        'admin' => [
            'pageSize' => 30,
            'uploadsPath' => realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . '/',
            'files' => [
                'banners' => 'uploads/b/',
                'images' => 'uploads/images/',
                'tmp' => 'uploads/tmp/',
                'news' => 'uploads/photos/news/',
                'photoBlog' => 'uploads/photos/photoBlog/',
                'photoCity' => 'uploads/photos/photoCity/',
                'photoPoster' => 'uploads/photos/photoPoster/',
                'boards' => 'uploads/photos/boards/',
                'boardIcons' => 'uploads/photos/boards/icons',
            ],
            'images' => [
                'small' => [
                    'height' => 80,
                    'width' => 80,
                ],
                'middle' => [
                    'height' => 195,
                    'width' => 195,
                ],
                'big' => [
                    'height' => 950,
                    'width' => 466,
                ],
                'allowedExtensions' => ['jpg', 'jpeg', 'png'],
                'sizeLimit' => 2 * 1024 * 1024
            ],
        ],
    ],
];

return is_array($localConfig) ? CMap::mergeArray($mainConfig, $localConfig) : $mainConfig;
