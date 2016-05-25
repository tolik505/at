<?php

namespace backend\modules\recipe\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RecipeSearch represents the model behind the search form about `Recipe`.
 */
class RecipeSearch extends Recipe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published', 'position'], 'integer'],
            [['label', 'summary', 'directions'], 'safe'],
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
    * @inheritdoc
    */
    public function behaviors()
    {
        return [];
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
        $query = Recipe::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'published' => $this->published,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'directions', $this->directions]);

        return $dataProvider;
    }
}
