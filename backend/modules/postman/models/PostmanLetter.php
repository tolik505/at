<?php

namespace backend\modules\postman\models;

use backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;

/**
 * Class PostmanLetter
 */
class PostmanLetter extends \common\models\PostmanLetter implements BackendModel
{

    /**
     * Get title for the template page
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Postman Letter');
    }

    /**
     * Has search form on index template page
     *
     * @return bool
     */
    public function hasSearch()
    {
        return false;
    }

    /**
     * Get attribute columns for index and view page
     *
     * @param $page
     *
     * @return array
     */
    public function getColumns($page)
    {
        switch ($page) {
            case 'index':
                return [
                    'id',
                    'date_create',
                    'date_send',
                    'subject',
                    //'body:ntext',
                     'recipients:ntext',
                    // 'attachments:ntext',
                    // 'code',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                    ],
                ];
                break;
            case 'view':
                return [
                    'id',
                    'date_create',
                    'date_send',
                    'subject',
                    'body:ntext',
                    'recipients:ntext',
                    //'attachments:ntext',
                    //'code',
                ];
                break;
        }
        return [];
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getSearchModel()
    {
        return new PostmanLetterSearch();
    }

    /**
     * @return array
     */
    public function getFormConfig()
    {
        return [
            'date_create' => [
                'type' => ActiveFormBuilder::INPUT_WIDGET,
                'widgetClass' => \metalguardian\dateTimePicker\Widget::className(),
                'options' => [
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            'date_send' => [
                'type' => ActiveFormBuilder::INPUT_WIDGET,
                'widgetClass' => \metalguardian\dateTimePicker\Widget::className(),
                'options' => [
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            'subject' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'body' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                'options' => [
                    'rows' => 6,
                ],
            ],
            'recipients' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                'options' => [
                    'rows' => 6,
                ],
            ],
            'attachments' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                'options' => [
                    'rows' => 6,
                ],
            ],
            'code' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
        ];
    }
}
