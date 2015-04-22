<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%configuration_translation}}".
 *
 * @property string $model_id
 * @property string $language
 * @property string $value
 */
abstract class ConfigurationTranslation extends \common\components\model\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%configuration_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required', 'except' => ['file', 'image']],

            [['value'], 'integer', 'on' => 'integer'],

            [['value'], 'double', 'on' => 'double'],

            [['value'], 'string', 'on' => 'string'],

            [['value'], 'boolean', 'on' => 'boolean'],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->setScenario($this->getTypeScenario());
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $label =
            ($this->model && $this->model->description)
                ?
                Yii::t('app', 'Value') . ' (' . $this->model->description . ')'
                :
                Yii::t('app', 'Value');
        return [
            'value' => $label . ' [' . $this->language . ']',
        ];
    }

    /**
     * @return string
     */
    public function getTypeScenario()
    {
        if ($this->model) {
            switch ($this->model->type) {
                case Configuration::TYPE_STRING:
                case Configuration::TYPE_TEXT:
                case Configuration::TYPE_HTML:
                    return 'string';
                    break;
                case Configuration::TYPE_INTEGER:
                    return 'integer';
                    break;
                case Configuration::TYPE_DOUBLE:
                    return 'double';
                    break;
                case Configuration::TYPE_BOOLEAN:
                    return 'boolean';
                    break;
            }
        }
        return 'string';
    }
}
