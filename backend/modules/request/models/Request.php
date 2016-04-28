<?php

namespace backend\modules\request\models;

use kartik\date\DatePicker;
use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;

/**
 * This is the model class for table "{{%request}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property integer $created_at
 */
class Request extends \common\components\model\ActiveRecord implements BackendModel
{

    public $showCreateButton = false;
    public $showUpdateButton = false;
//    public $showDeleteButton = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%request}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            [['message'], 'string'],
            [['email'], 'email'],
            [['name', 'email'], 'string', 'max' => 255],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
        ];
    }

    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }
    /**
    * Get title for the template page
    *
    * @return string
    */
    public function getTitle()
    {
        return \Yii::t('app', 'Request');
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
//                    ['class' => 'yii\grid\SerialColumn'],
//                     'id',
                    [
                        'attribute' => 'created_at',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return \Yii::$app->formatter->asDatetime($data->created_at, 'medium');
                        },
                        'filter' => DatePicker::widget(
                            [
                                'model' => $this,
                                'attribute' => 'created_at',
                                'options' => [
                                    'class' => 'form-control form-control-filters'
                                ],
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]
                        ),
                        'headerOptions' => ['class' => 'col-md-3'],
                    ],
                    'name',
                    'email:email',
//                    'message:ntext',
                    [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {delete}'
                    ],
                ];
            break;
            case 'view':
                return [
//                    'id',

                    'name',
                    'email:email',
                    [
                        'attribute' => 'message',
                        'format' => 'html',
                    ],
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
        return new RequestSearch();
    }

    /**
    * @return array
    */
    public function getFormConfig()
    {
        return [
            'name' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'email' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'message' => [
                'type' => ActiveFormBuilder::INPUT_WIDGET,
                'widgetClass' => \backend\components\ImperaviContent::className(),
                'options' => [
                    'model' => $this,
                    'attribute' => 'message',
                ]
            ],
            
        ];
    }

}
