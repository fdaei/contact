<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LegalContact;

/**
 * LegalContacttSearch represents the model behind the search form of `common\models\LegalContact`.
 */
class LegalContacttSearch extends LegalContact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'coin', 'registration_city_id', 'registration_province_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['logo', 'name', 'national_id', 'economic_code', 'registration_address', 'registration_date', 'summary', 'description', 'mobile_numbers', 'social_links', 'phone_numbers', 'fax_numbers', 'addresses', 'emails', 'websites', 'bank_accounts', 'cards', 'shaba_numbers'], 'safe'],
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
        $query = LegalContact::find();

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
            'registration_city_id' => $this->registration_city_id,
            'registration_province_id' => $this->registration_province_id,
            'registration_date' => $this->registration_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'economic_code', $this->economic_code])
            ->andFilterWhere(['like', 'registration_address', $this->registration_address])
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
