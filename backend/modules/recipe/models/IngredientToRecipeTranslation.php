<?php

namespace backend\modules\recipe\models;

use Yii;

/**
* This is the model class for table "{{%ingredient_to_recipe_translation}}".
*
* @property integer $model_id
* @property string $language
* @property string $note
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
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['note'], 'string', 'max' => 255],
         ];
    }
}
