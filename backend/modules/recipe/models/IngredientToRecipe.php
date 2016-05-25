<?php

namespace backend\modules\recipe\models;

use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;
use \common\components\model\Translateable;

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
class IngredientToRecipe extends \common\components\model\ActiveRecord implements BackendModel, Translateable
{
    use \backend\components\TranslateableTrait;
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
    public function rules()
    {
        return [
            [['ingredient_id'], 'required'],
            [['ingredient_id', 'recipe_id', 'published', 'position'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['ingredient_id'], 'exist', 'targetClass' => \common\models\Ingredient::className(), 'targetAttribute' => 'id'],
            [['recipe_id'], 'exist', 'targetClass' => \common\models\Recipe::className(), 'targetAttribute' => 'id'],
            [['published'], 'default', 'value' => 1],
            [['position'], 'default', 'value' => 0],
            
        ];
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
    * @return array
    */
    public static function getTranslationAttributes()
    {
        return [
            'note',
        ];
    }

    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'translateable' => [
                'class' => \creocoder\translateable\TranslateableBehavior::className(),
                'translationAttributes' => static::getTranslationAttributes(),
            ],
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
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
    /**
    * Get title for the template page
    *
    * @return string
    */
    public function getTitle()
    {
        return \Yii::t('app', 'Ingredient To Recipe');
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
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    'ingredient_id',
                    'recipe_id',
                    'note',
                    'published:boolean',
                    'position',
                    ['class' => 'yii\grid\ActionColumn'],
                ];
            break;
            case 'view':
                return [
                    'id',
                    'ingredient_id',
                    'recipe_id',
                    'note',
                    'published:boolean',
                    'position',
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
        return new IngredientToRecipeSearch();
    }

    /**
    * @return array
    */
    public function getFormConfig()
    {
        return [
            'ingredient_id' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => \common\models\Ingredient::getItems(),
                'options' => [
                    'prompt' => 'Выберите ингредиент',
                ],
            ],
            'note' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'published' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
        ];
    }

}
