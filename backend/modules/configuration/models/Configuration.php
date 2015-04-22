<?php

namespace backend\modules\configuration\models;

use backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;
use vova07\imperavi\Widget;
use Yii;
use yii\helpers\Html;

/**
 *
 */
class Configuration extends \common\models\Configuration implements BackendModel
{
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

            [['value'], 'required', 'except' => ['file', 'image']],

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
        $label = $this->description ? Yii::t('app', 'Value') . ' (' . $this->description . ')' : Yii::t('app', 'Value');
        return [
            'id' => Yii::t('app', 'Key'),
            'value' => $label,
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
                            return $data->getListLabel('type');
                        },
                    ],
                    'description',
                    'published:boolean',
                    'preload:boolean',

                    ['class' => 'yii\grid\ActionColumn'],
                ];
                break;
            case 'view':
                return [
                    'id',
                    $this->getTypeValueView(),
                    [
                        'attribute' => 'type',
                        'value' => $this->getListLabel('type'),
                    ],
                    'description',
                    'published:boolean',
                    'preload:boolean',
                ];
                break;
            case 'model':
                return [
                    'id',
                    'description',
                    $this->getTypeValueView(),
                    'published:boolean',
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
            'value' => $this->getValueFieldConfig(),
            'type' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => static::getList('type'),
                'options' => [
                    'prompt' => 'select',
                ],
            ],
            'description' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => 255
                ],
            ],
            'preload' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'published' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->setScenario($this->getTypeScenario());
    }

    /**
     * @return array
     */
    public function getValueFieldConfig()
    {
        switch ($this->type) {
            case static::TYPE_STRING:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXT,
                ];
                break;
            case static::TYPE_TEXT:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                ];
                break;
            case static::TYPE_HTML:
                return [
                    'type' => ActiveFormBuilder::INPUT_WIDGET,
                    'widgetClass' => Widget::className(),
                ];
                break;
            case static::TYPE_INTEGER:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXT,
                ];
                break;
            case static::TYPE_DOUBLE:
                return [
                    'type' => ActiveFormBuilder::INPUT_TEXT,
                ];
                break;
            case static::TYPE_BOOLEAN:
                return [
                    'type' => ActiveFormBuilder::INPUT_CHECKBOX,
                ];
                break;
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
            case static::TYPE_STRING:
            case static::TYPE_TEXT:
            case static::TYPE_HTML:
                return 'string';
                break;
            case static::TYPE_INTEGER:
                return 'integer';
                break;
            case static::TYPE_DOUBLE:
                return 'double';
                break;
            case static::TYPE_BOOLEAN:
                return 'boolean';
                break;
        }
        return 'string';
    }

    /**
     * @return string
     */
    public function getTypeValueView()
    {
        switch ($this->type) {
            case static::TYPE_STRING:
            case static::TYPE_TEXT:
            case static::TYPE_HTML:
            case static::TYPE_INTEGER:
            case static::TYPE_DOUBLE:
                return 'value:text';
                break;
            case static::TYPE_BOOLEAN:
                return 'value:boolean';
                break;
        }
        return 'value:text';
    }

    /**
     * @param array $params
     * @return array
     */
    public function getUpdateUrl($params = [])
    {
        return ['/configuration/default/update', 'id' => $this->id];
    }
}
