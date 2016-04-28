<?php

namespace backend\components;

use backend\components\ModelForFrontStatic;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\ArrayHelper;
use Zelenin\yii\modules\I18n\models\Message;
use Zelenin\yii\modules\I18n\models\search\SourceMessageSearch;
use Zelenin\yii\modules\I18n\models\SourceMessage;
use Zelenin\yii\modules\I18n\Module;

class SearchForFrontStatic extends SourceMessageSearch
{

    public function search($params)
    {
        $query = ModelForFrontStatic::find()->andWhere(['category' => 'front_static'])->joinWith('message');
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->status == static::STATUS_TRANSLATED) {
            $query->translated();
        }
        if ($this->status == static::STATUS_NOT_TRANSLATED) {
            $query->notTranslated();
        }

        $query
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', Message::tableName().'.translation', $this->translation]);
        return $dataProvider;
    }

    public static function getStatus($id = null)
    {
        $statuses = [
            self::STATUS_TRANSLATED => 'Replaced',
            self::STATUS_NOT_TRANSLATED => 'Not Replaced',
        ];
        if ($id !== null) {
            return ArrayHelper::getValue($statuses, $id, null);
        }
        return $statuses;
    }

}
