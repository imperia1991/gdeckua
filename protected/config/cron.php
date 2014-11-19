<?php
$localConfig = file_exists(dirname(__FILE__) . '/cron_local.php') ? require_once(dirname(__FILE__) . '/cron_local.php') : [];
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$cronConfig =  [
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'Cron',

    // preloading 'log' component
    'preload'    => ['log'],

    'import'     => [
        'application.components.*',
        'application.models.*',
    ],

    // application components
    'components' => [
        'db'  => [
            'connectionString' => 'mysql:host=localhost;dbname=gdeckua',
            'emulatePrepare'   => true,
            'username'         => 'root',
            'password'         => '123456',
            'charset'          => 'utf8',
        ],
        'log' => [
            'class'  => 'CLogRouter',
            'routes' => [
                [
                    'class'   => 'CFileLogRoute',
                    'logFile' => 'cron.log',
                    'levels'  => 'error, warning',
                ],
                [
                    'class'   => 'CFileLogRoute',
                    'logFile' => 'cron_trace.log',
                    'levels'  => 'trace',
                ],
            ],
        ],
        'simplepie' => [
            'class' => 'ext.simplepie-library.bootstrap'
        ]
    ],
];

return is_array($localConfig) ? CMap::mergeArray($cronConfig, $localConfig) : $cronConfig;