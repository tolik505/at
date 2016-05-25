<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ingredient_to_recipe}}".
 *
 * @property integer $id
 * @property integer $ingredient_id
 * @property integer $recipe_id
 * @property string $note
 * @property integer $published
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Ingredient $ingredient
 * @property Recipe $recipe
 * @property IngredientToRecipeTranslation[] $translations
 */
class IngredientToRecipe extends \common\components\model\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient_to_recipe}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingredient_id' => 'Ingredient',
            'recipe_id' => 'Recipe',
            'note' => 'Note',
            'published' => 'Published',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(IngredientToRecipeTranslation::className(), ['model_id' => 'id']);
    }
}
