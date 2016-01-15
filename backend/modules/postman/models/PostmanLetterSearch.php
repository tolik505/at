<?php

namespace backend\modules\postman\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PostmanLetterSearch represents the model behind the search form about `backend\modules\postman\models\PostmanLetter`.
 */
class PostmanLetterSearch extends PostmanLetter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_create', 'date_send', 'subject', 'body', 'recipients', 'attachments', 'code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PostmanLetter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_create' => $this->date_create,
        ]);

        $query->andWhere([
            'date_send' => null,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'recipients', $this->recipients])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
