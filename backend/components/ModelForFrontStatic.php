<?php

namespace backend\components;

use yii\base\InvalidConfigException;
use Yii;
use yii\db\ActiveRecord;
use Zelenin\yii\modules\I18n\models\query\SourceMessageQuery;
use Zelenin\yii\modules\I18n\models\SourceMessage;
use Zelenin\yii\modules\I18n\Module;

class ModelForFrontStatic extends SourceMessage
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $firstLang = Yii::$app->getI18n()->languages[0];

        return [
            'id' => Module::t('ID'),
            'category' => 'Категория',
            'message' => 'Original text',
            'status' => 'Status',
            'translation' => 'replaced by'
        ];
    }

}
