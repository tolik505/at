<?php

return [
    [
        'label' => Yii::t('app', 'Translations'),
        'items' => [
            [
                'label' => Yii::t('app', 'Translations'),
                'url' => ['/i18n/default/index'],
            ],
            [
                'label' => Yii::t('app', 'Language'),
                'url' => ['/language/language/index'],
            ],
        ],

    ],
    [
        'label' => 'Configuration',
        'items' => [
            [
                'label' => Yii::t('app', 'Configuration'),
                'url' => ['/configuration/default/index'],
            ],
            [
                'label' => Yii::t('app', 'Config Form Sample'),
                'url' => ['/configuration/sample/update'],
            ],
            [
                'label' => Yii::t('app', 'Page SEO'),
                'url' => ['/seo/page-seo/index'],
            ]
        ]
    ],

];
