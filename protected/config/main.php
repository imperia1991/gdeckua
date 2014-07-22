<?php

$localConfig = file_exists(dirname(__FILE__) . '/local.php') ? require_once(dirname(__FILE__) . '/local.php') : array();
// uncomment the following to define a path alias
Yii::setPathOfAlias('bootstrap', realpath(__DIR__ . '/../extensions/bootstrap'));
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$mainConfig = array(
    'timeZone' => 'Europe/Kiev',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Где в Черкассах?',
    //Язык по умолчанию
//    'sourceLanguage' => 'ru',
//    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.mail.YiiMailMessage',
        'ext.JsTrans.*',
        'ext.Scalar.*',
        'application.extensions.CAdvancedArFindBehavior',
        'ext.easyimage.EasyImage',
        'ext.tinymce.*',
        'ext.elFinder.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'admin' => array(
//			'layout' => 'application.modules.admin.views.layouts.main',
            'preload' => array('bootstrap'),
            'components' => array(
                'bootstrap' => array(
                    'class' => 'bootstrap.components.Bootstrap',
                ),
            ),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
        ),
        'request' => array(
            'enableCookieValidation' => true,
//            'enableCsrfValidation' => true,
        ),
        'clientScript' => array(
            'packages' => array(
                'jquery' => array(
                    'baseUrl' => '/js',
                    'js' => array('jquery-1.11.1.min.js')
                ),
//                'jquery.ui' => array(
//                    'baseUrl' => '/libraries/jquery-ui-1.10.2.custom/js',
//                    'js' => array('jquery-ui-1.10.2.custom.min.js')
//                )
            )
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                '<module:(admin)>' => '<module>/default/index',
                '<module:(admin)>/sitemap.xml' => '<module>/sitemap/index',
                '<module:(admin)>/<controller:\w+>' => '<module>/<controller>/index',
                '<module:(admin)>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<language:(ru|uk)>/' => 'site/index',
                '<language:(ru|uk)>/page/<page:\d+>' => 'site/index',
                '<language:(ru|uk)>/view/<id:\d+>/<alias>' => 'site/view',
                '<language:(ru|uk)>/<action:\w+>/*' => 'site/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
            ),
        ),
//        'db' => array(
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
//        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=gangstas.mysql.ukraine.com.ua;dbname=gangstas_gde',
            'emulatePrepare' => true,
            'username' => 'gangstas_gde',
            'password' => 'tflk4mrq',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/imagemagick'),
        ),
        'mail' => array(
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
        ),
        'easyImage' => array(
            'class' => 'application.extensions.easyimage.EasyImage',
        )
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'supportEmail' => 'support@rabotenka.com.ua',
        'languages' => array('ru' => 'Русский', 'uk' => 'Українська'),
        'pageSize' => 12,
        'admin' => array(
            'pageSize' => 30,
            'uploadsPath' => realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . '/',
            'files' => array(
                'images' => 'uploads/images/',
                'tmp' => 'uploads/tmp/',
            ),
            'images' => array(
                'small' => array(
                    'height' => 80,
                    'width' => 80,
                ),
                'middle' => array(
                    'height' => 195,
                    'width' => 195,
                ),
                'big' => array(
                    'height' => 950,
                    'width' => 466,
                ),
                'allowedExtensions' => array('jpg', 'jpeg', 'png'),
                'sizeLimit' => 2 * 1024 * 1024
            ),
        ),
    ),
);

return is_array($localConfig) ? CMap::mergeArray($mainConfig, $localConfig) : $mainConfig;
