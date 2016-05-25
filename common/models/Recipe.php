<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%recipe}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $summary
 * @property string $directions
 * @property integer $published
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property IngredientToRecipe[] $ingredientToRecipes
 * @property RecipeTranslation[] $translations
 */
class Recipe extends \common\components\model\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipe}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'summary' => 'Summary',
            'directions' => 'Directions',
            'published' => 'Published',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientToRecipes()
    {
        return $this->hasMany(IngredientToRecipe::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitleImage()
    {
        return $this->hasOne(EntityToFile::className(), ['entity_model_id' => 'id'])
            ->andOnCondition(['t2.entity_model_name' => static::formName()])
            ->from(['t2' => EntityToFile::tableName()])
            ->orderBy('t2.position DESC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(RecipeTranslation::className(), ['model_id' => 'id']);
    }
}
