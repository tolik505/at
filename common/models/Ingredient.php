<?php

namespace common\models;

use Yii;

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
class Ingredient extends \common\components\model\ActiveRecord
{
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
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(IngredientTranslation::className(), ['model_id' => 'id']);
    }
}
