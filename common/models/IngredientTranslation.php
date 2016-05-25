<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ingredient_translation}}".
 *
 * @property integer $model_id
 * @property string $language
 * @property string $label
 *
 * @property Ingredient $model
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
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'model_id']);
    }
}
