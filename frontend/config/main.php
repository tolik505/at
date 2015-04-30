<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Project',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'fileProcessor', 'config'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'config' => [
            'class' => '\common\components\ConfigurationComponent',
        ],
        'user' => [
            'loginUrl' => ['/user/login'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                '' => 'site/index',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
    ],
    'params' => $params,
];
