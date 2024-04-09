<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "legal_contact".
 *
 * @property int $id
 * @property string|null $logo
 * @property string $name
 * @property string $national_id
 * @property string|null $economic_code
 * @property int|null $coin
 * @property int|null $registration_city_id
 * @property int|null $registration_province_id
 * @property string|null $registration_address
 * @property string|null $registration_date
 * @property int $status
 * @property string|null $summary
 * @property string|null $description
 * @property string|null $mobile_numbers
 * @property string|null $social_links
 * @property string|null $phone_numbers
 * @property string|null $fax_numbers
 * @property string|null $addresses
 * @property string|null $emails
 * @property string|null $websites
 * @property string|null $bank_accounts
 * @property string|null $cards
 * @property string|null $shaba_numbers
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int|null $deleted_at
 */
class ContactSearch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'legal_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'national_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['coin', 'registration_city_id', 'registration_province_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['registration_date'], 'safe'],
            [['summary', 'description', 'mobile_numbers', 'social_links', 'phone_numbers', 'fax_numbers', 'addresses', 'emails', 'websites', 'bank_accounts', 'cards', 'shaba_numbers'], 'string'],
            [['logo', 'name', 'national_id', 'economic_code', 'registration_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function search($params)
    {
        $query = ContactSearch::find();

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
