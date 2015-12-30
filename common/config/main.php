<?php
use \metalguardian\fileProcessor\helpers\FPM;

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'fileProcessor' => [
            'class' => '\metalguardian\fileProcessor\Module',
            'imageSections' => [
                /*'module' => [
                    'size' => [
                        'action' => 'frame',
                        'width' => 400,
                        'height' => 200,
                        'startX' => 100,
                        'startY' => 100,
                    ],
                ],*/
                'admin' => [
                    'file' => [
                        'action' => FPM::ACTION_THUMBNAIL,
                        'width' => 100,
                        'height' => 100,
                    ]
                ]
            ],
        ],
    ],
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'formatter' => [
            'timeFormat' => 'H:i:s',
            'dateFormat' => 'Y-m-d',
        ],
        'i18n' => [
            'class' => 'Zelenin\yii\modules\I18n\components\I18N',
            'languages' => function () {
                return \common\helpers\LanguageHelper::getApplicationLanguages();
            },
        ],
        'urlManager' => [
            'class' => '\common\components\UrlManager',
            'showScriptName' => false,
            'enableStrictParsing' => true,
        ],
    ],
    'sourceLanguage' => 'xx',
    'language' => 'en',
];
