<?php

namespace backend\modules\recipe\models;

use Yii;

/**
* This is the model class for table "{{%recipe_translation}}".
*
* @property integer $model_id
* @property string $language
* @property string $label
* @property string $summary
* @property string $directions
*/
class RecipeTranslation extends \common\components\model\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%recipe_translation}}';
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'label' => 'Label' . ' [' . $this->language . ']',
            'summary' => 'Summary' . ' [' . $this->language . ']',
            'directions' => 'Directions' . ' [' . $this->language . ']',
        ];
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['summary', 'directions'], 'string'],
            [['label'], 'string', 'max' => 255],
         ];
    }
}
