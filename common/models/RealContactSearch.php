<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RealContact;

/**
 * RealContactSearch represents the model behind the search form of `common\models\RealContact`.
 */
class RealContactSearch extends RealContact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'coin', 'birth_city_id', 'birth_province_id', 'registration_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['image', 'first_name', 'last_name', 'national_id', 'birth_address', 'summary', 'description', 'mobile_numbers', 'social_links', 'phone_numbers', 'fax_numbers', 'addresses', 'emails', 'websites', 'bank_accounts', 'cards', 'shaba_numbers'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = RealContact::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'coin' => $this->coin,
            'birth_city_id' => $this->birth_city_id,
            'birth_province_id' => $this->birth_province_id,
            'registration_date' => $this->registration_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'birth_address', $this->birth_address])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'mobile_numbers', $this->mobile_numbers])
            ->andFilterWhere(['like', 'social_links', $this->social_links])
            ->andFilterWhere(['like', 'phone_numbers', $this->phone_numbers])
            ->andFilterWhere(['like', 'fax_numbers', $this->fax_numbers])
            ->andFilterWhere(['like', 'addresses', $this->addresses])
            ->andFilterWhere(['like', 'emails', $this->emails])
            ->andFilterWhere(['like', 'websites', $this->websites])
            ->andFilterWhere(['like', 'bank_accounts', $this->bank_accounts])
            ->andFilterWhere(['like', 'cards', $this->cards])
            ->andFilterWhere(['like', 'shaba_numbers', $this->shaba_numbers]);

        return $dataProvider;
    }
}
