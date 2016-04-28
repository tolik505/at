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
            'languages' => [
                'en'
            ]
        ],
        'urlManager' => [
            'class' => '\common\components\UrlManager',
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'enableLanguageDetection' => false,
            'rules' => require(__DIR__ . '/url-rules.php'),
        ],
        'postman' => [
            'class' => 'rmrevin\yii\postman\Component',
            'driver' => 'smtp',
            'default_from' => ['noreply@somehost.com', 'Mailer'],
            'subject_prefix' => 'Sitename / ',
            'subject_suffix' => null,
            'table' => '{{%postman_letter}}',
            'view_path' => '/email',
            'smtp_config' => [
                'host' => 'smtp.domain.com',
                'port' => 465,
                'auth' => true,
                'user' => 'email@domain.cpom',
                'password' => 'password',
                'secure' => 'ssl',
                'debug' => false,
            ]
        ],
    ],
    'sourceLanguage' => 'xx',
    'language' => 'en',
];
