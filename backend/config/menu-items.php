<?php

return [
    [
        'label' => Yii::t('app', 'Configuration'),
        'url' => ['/configuration/default/index'],
        'items' => [
            [
                'label' => Yii::t('app', 'Configuration'),
                'url' => ['/configuration/default/index'],
            ],
            [
                'label' => Yii::t('app', 'Translations'),
                'url' => ['/i18n/default/index'],
            ],
            [
                'label' => Yii::t('app', 'Seo Tags'),
                'url' => ['/meta/tag/index'],
            ],
            [
                'label' => Yii::t('app', 'Robots.txt'),
                'url' => ['/seo/robots/index'],
            ],
            [
                'label' => Yii::t('app', 'Language'),
                'url' => ['/language/language/index'],
            ],
            [
                'label' => Yii::t('app', 'Redirects'),
                'url' => ['/redirects/redirects/index'],
            ],
        ],
    ]
];
