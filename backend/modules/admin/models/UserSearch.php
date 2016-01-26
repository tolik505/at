<?php

namespace backend\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `backend\modules\admin\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'subscribe', 'status', 'send_new_project', 'send_partnership', 'send_investing', 'send_abuse', 'type_id'], 'integer'],
            [['username', 'email', 'fb_link', 'vk_link', 'tw_link', 'fio', 'address', 'nationality', 'web_site', 'skype', 'mobile_telephone', 'telephone', 'other_social', 'contact_name', 'legal_address', 'jurisdiction', 'bank_account', 'identification_number_organization'], 'safe'],
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

    public function searchToConfirm($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->orWhere(['fio_check' => null]);
        $query->orWhere(['address_check' => null]);
        $query->orWhere(['nationality_check' => null]);
        $query->orWhere(['mobile_telephone_check' => null]);
        $query->orWhere(['contact_name_check' => null]);
        $query->orWhere(['legal_address_check' => null]);
        $query->orWhere(['jurisdiction_check' => null]);
        $query->orWhere(['identification_number_organization_check' => null]);
        $query->orWhere(['bank_account_check' => null]);

        return $dataProvider;
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
        $query = User::find();

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
            'image_id' => $this->image_id,
            'subscribe' => $this->subscribe,
            'status' => $this->status,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fb_link', $this->fb_link])
            ->andFilterWhere(['like', 'vk_link', $this->vk_link])
            ->andFilterWhere(['like', 'tw_link', $this->tw_link])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'web_site', $this->web_site])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'mobile_telephone', $this->mobile_telephone])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'other_social', $this->other_social])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'legal_address', $this->legal_address])
            ->andFilterWhere(['like', 'jurisdiction', $this->jurisdiction])
            ->andFilterWhere(['like', 'bank_account', $this->bank_account])
            ->andFilterWhere(['like', 'identification_number_organization', $this->identification_number_organization]);

        return $dataProvider;
    }
}
