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
            'class' => '\metalguardian\language\UrlManager',
            'showDefault' => false,
            'enablePrettyUrl' => true,
            'languages' => function () {
                $models = \common\helpers\LanguageHelper::getLanguageModels();
                $languages = [];
                foreach ($models as $model) {
                    $languages[$model->code] = $model->locale;
                }
                return $languages;
            },
            'showScriptName' => false,
            'enableStrictParsing' => true,
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
