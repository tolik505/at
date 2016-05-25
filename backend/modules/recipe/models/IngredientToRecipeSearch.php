<?php

namespace backend\modules\recipe\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * IngredientToRecipeSearch represents the model behind the search form about `IngredientToRecipe`.
 */
class IngredientToRecipeSearch extends IngredientToRecipe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ingredient_id', 'recipe_id', 'published', 'position'], 'integer'],
            [['note'], 'safe'],
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
        $query = IngredientToRecipe::find();

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
            'ingredient_id' => $this->ingredient_id,
            'recipe_id' => $this->recipe_id,
            'published' => $this->published,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
