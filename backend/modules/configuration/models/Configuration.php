<?php

namespace backend\modules\configuration\models;

use backend\components\BackendModel;
use backend\components\ImperaviContent;
use metalguardian\formBuilder\ActiveFormBuilder;
use Yii;
use kartik\datecontrol\DateControl;

/**
 *
 */
class Configuration extends \common\models\Configuration implements BackendModel
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'file' => [
                'class' => \metalguardian\fileProcessor\behaviors\UploadDeleteBehavior::className(),
                'attribute' => 'value',
                'validator' => [
                    'extensions' => [
                        'pdf',
                        'doc',
                        'docx',
                        'xls',
                        'xlsx',
                        'txt',
                        'png',
                        'gif',
                        'jpg',
                        'jpeg',
                        'ico',
                        'svg'
                    ],
                    'on' => ['file', 'image'],
                ],
                'required' => true,
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'required'],
            [['type', 'preload', 'published'], 'integer'],
            [['id'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],

            [['value'], 'required', 'except' => ['file', 'image', 'boolean']],

            [['value'], 'integer', 'on' => 'integer'],

            [['value'], 'double', 'on' => 'double'],

            [['value'], 'string', 'on' => 'string'],

            [['value'], 'boolean', 'on' => 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'type' => Yii::t('app', 'Field type'),
            'description' => Yii::t('app', 'Description'),
            'preload' => Yii::t('app', 'Preload'),
            'published' => Yii::t('app', 'Published'),
        ];
    }

    /**
     * Get title for the template page
     *
     * @return string
     */
    public function getTitle()
    {
        return Yii::t('app', 'Configuration');
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
     * @inheritdoc
     */
    public function getColumns($page)
    {
        switch ($page) {
            case 'index':
                return [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'type',
                        'filter' => static::getList('type'),
                        'value' => function (Configuration $data) {
                            return $data->getListValue('type');
                        },
                    ],
                    'description',
                    //'published:boolean',
                    //'preload:boolean',

                    ['class' => 'yii\grid\ActionColumn'],
                ];
                break;
            case 'view':
                return [
                    'id',
                    $this->getTypeValueView(),
                    [
                        'attribute' => 'type',
                        'value' => $this->getListValue('type'),
                    ],
                    'description',
                    //'published:boolean',
                    //'preload:boolean',
                ];
                break;
            case 'model':
                return [
                    'id',
                    'description',
                    $this->getTypeValueView(),
                    //'published:boolean',
                ];
                break;
        }
        return [];
    }

    /**
     * @return ConfigurationSearch
     */
    public function getSearchModel()
    {
        return new ConfigurationSearch();
    }

    /**
     * @return array
     */
    public function getFormConfig()
    {
        return [
            'id' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => 20
                ],
            ],
            'type' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => static::getList('type'),
                'options' => [
                    'class' => 'config-type form-control',
                    'data-url' => $this->getChangeTypeUrl(),
                    'prompt' => 'select',
                ],
            ],
            'value' => $this->getValueFieldConfig(),
            'description' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => 255
                ],
            ],
            /*'preload' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'published' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],*/
        ];
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->setScenario($this->getTypeScenario());
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $scenario = $this->getTypeScenario();

            $this->setScenario($scenario);

            //Detach UploadBehavior if field type not file/image
            if (!in_array($scenario, ['file', 'image'])) {
                $this->detachBehavior('file');
            }

            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getValueFieldConfig()
    {
        $description = $this->description ? $this->description : null;
        switch ($this->type) {
            case static::TYPE_STRING:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXT,
                    'hint' => $description,
                ];
            case static::TYPE_TEXT:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                    'hint' => $description,
                ];
            case static::TYPE_HTML:
                return [
                    'type' => ActiveFormBuilder::INPUT_WIDGET,
                    'widgetClass' => ImperaviContent::className(),
                    'hint' => $description,
                ];
            case static::TYPE_INTEGER:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXT,
                    'hint' => $description,
                ];
            case static::TYPE_DOUBLE:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXT,
                    'hint' => $description,
                ];
            case static::TYPE_BOOLEAN:
                return [
                    'type' => ActiveFormBuilder::INPUT_CHECKBOX,
                    'hint' => $description,
                ];
            case static::TYPE_FILE:
                return [
                    'type' => ActiveFormBuilder::INPUT_FILE,
                    //'hint' => $description . '<p>' . Html::a(FPM::originalSrc($this->value), FPM::originalSrc($this->value)) . '</p>',
                ];
            case static::TYPE_DATE:
                return [
                    'type' => ActiveFormBuilder::INPUT_WIDGET,
                    'widgetClass' => DateControl::className(),
                    'options' => [
                        'type'=>DateControl::FORMAT_DATE,
                    ],
                ];
            case static::TYPE_DATE_TIME:
                return [
                    'type' => ActiveFormBuilder::INPUT_WIDGET,
                    'widgetClass' => DateControl::className(),
                    'options' => [
                        'type'=>DateControl::FORMAT_DATETIME,
                    ],
                ];
        }
        return [
            'type' => ActiveFormBuilder::INPUT_TEXT,
        ];
    }

    /**
     * @return string
     */
    public function getTypeScenario()
    {
        switch ($this->type) {
            case static::TYPE_INTEGER:
                return 'integer';
            case static::TYPE_DOUBLE:
                return 'double';
            case static::TYPE_BOOLEAN:
                return 'boolean';
            case static::TYPE_FILE:
                return 'file';
        }

        return 'string';
    }

    /**
     * @return string
     */
    public function getTypeValueView()
    {
        switch ($this->type) {
            case static::TYPE_BOOLEAN:
                return 'value:boolean';
            case static::TYPE_FILE:
                return 'value:file';
        }

        return 'value:text';
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getUpdateUrl($params = [])
    {
        return ['/configuration/default/update', 'id' => $this->id];
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public static function getChangeTypeUrl($params = [])
    {
        return static::createUrl('/configuration/default/get-form', $params);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(ConfigurationTranslation::className(), ['model_id' => 'id']);
    }
}
