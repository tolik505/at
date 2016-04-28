<?php

return [
//    [
//        'label' => Yii::t('app', 'Translations'),
//        'items' => [
//            [
//                'label' => Yii::t('app', 'Translations'),
//                'url' => ['/i18n/default/index'],
//            ],
//            [
//                'label' => Yii::t('app', 'Language'),
//                'url' => ['/language/language/index'],
//            ],
//        ],
//
//    ],
//    [
//        'label' => 'Configuration',
//        'items' => [
//            [
//                'label' => Yii::t('app', 'Configuration'),
//                'url' => ['/configuration/default/index'],
//            ],
//            [
//                'label' => Yii::t('app', 'Config Form Sample'),
//                'url' => ['/configuration/sample/update'],
//            ],
//            [
//                'label' => Yii::t('app', 'Page SEO'),
//                'url' => ['/seo/page-seo/index'],
//            ]
//        ]
//    ],
    [
        'label' => 'Static texts',
        'url' => ['/front-static/index'],
    ],
    [
        'label' => 'Map on main page',
        'items' => [
            [
                'label' => Yii::t('app', 'Department on map'),
                'url' => ['/department-on-map/department-on-map/index'],
            ],
            [
                'label' => Yii::t('app', 'Regions on map'),
                'url' => ['/department-on-map/regions-map-scale/index'],
            ],
        ]
    ],
    [
        'label' => 'Request',
        'url' => ['/request/request/index'],
    ],

];
