<?php

namespace backend\modules\ingredient\models;

use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;
use \common\components\model\Translateable;

/**
 * This is the model class for table "{{%ingredient}}".
 *
 * @property integer $id
 * @property string $label
 * @property integer $published
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property IngredientTranslation[] $translations
 */
class Ingredient extends \common\components\model\ActiveRecord implements BackendModel, Translateable
{
    use \backend\components\TranslateableTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['published', 'position'], 'integer'],
            [['label'], 'string', 'max' => 255],
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
            'label' => 'Label',
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
            'label',
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
    public function getTranslations()
    {
        return $this->hasMany(IngredientTranslation::className(), ['model_id' => 'id']);
    }
    /**
    * Get title for the template page
    *
    * @return string
    */
    public function getTitle()
    {
        return \Yii::t('app', 'Ingredient');
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
                    'label',
                    'published:boolean',
                    'position',
                    ['class' => 'yii\grid\ActionColumn'],
                ];
            break;
            case 'view':
                return [
                    'id',
                    'label',
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
        return new IngredientSearch();
    }

    /**
    * @return array
    */
    public function getFormConfig()
    {
        return [
            'label' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'published' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'position' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
            ],
            
        ];
    }

}
