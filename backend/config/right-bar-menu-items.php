<?php

return [
    [
        'label' => Yii::t('app', 'Configuration'),
        'url' => ['/configuration/default/index'],
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
        'label' => Yii::t('app', 'Redirects'),
        'url' => ['/redirects/redirects/index'],
    ],
    [
        'label' => 'Logout',
        'url' => ['/admin/default/logout'],
        'linkOptions' => ['data-method' => 'post']
    ]
];
