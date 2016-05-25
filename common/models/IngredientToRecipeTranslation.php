<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ingredient_to_recipe_translation}}".
 *
 * @property integer $model_id
 * @property string $language
 * @property string $note
 *
 * @property IngredientToRecipe $model
 */
class IngredientToRecipeTranslation extends \common\components\model\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient_to_recipe_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'note' => 'Note' . ' [' . $this->language . ']',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(IngredientToRecipe::className(), ['id' => 'model_id']);
    }
}
