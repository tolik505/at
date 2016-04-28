<?php

namespace backend\modules\departmentOnMap\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DepartmentOnMapSearch represents the model behind the search form about `DepartmentOnMap`.
 */
class DepartmentOnMapSearch extends DepartmentOnMap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mark_baloon_type', 'published', 'position'], 'integer'],
            [['contact_person', 'contact_address', 'contact_tel', 'contact_email', 'contact_fax', 'lat', 'long'], 'safe'],
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
        $query = DepartmentOnMap::find();

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
            'mark_baloon_type' => $this->mark_baloon_type,
            'published' => $this->published,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'contact_address', $this->contact_address])
            ->andFilterWhere(['like', 'contact_tel', $this->contact_tel])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'contact_fax', $this->contact_fax])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long]);

        return $dataProvider;
    }
}
