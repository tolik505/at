<?php

namespace backend\modules\departmentOnMap\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RegionsMapScaleSearch represents the model behind the search form about `RegionsMapScale`.
 */
class RegionsMapScaleSearch extends RegionsMapScale
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published', 'position'], 'integer'],
            [['label', 'lat', 'long', 'scale'], 'safe'],
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
        $query = RegionsMapScale::find();

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
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'scale', $this->scale]);

        return $dataProvider;
    }
}
