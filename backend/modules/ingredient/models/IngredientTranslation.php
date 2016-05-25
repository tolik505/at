<?php

namespace backend\modules\ingredient\models;

use Yii;

/**
* This is the model class for table "{{%ingredient_translation}}".
*
* @property integer $model_id
* @property string $language
* @property string $label
*/
class IngredientTranslation extends \common\components\model\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%ingredient_translation}}';
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'label' => 'Label' . ' [' . $this->language . ']',
        ];
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['label'], 'string', 'max' => 255],
         ];
    }
}
