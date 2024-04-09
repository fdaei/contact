<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "real_contact".
 *
 * @property int $id
 * @property string|null $image
 * @property string $first_name
 * @property string $last_name
 * @property string $national_id
 * @property int|null $coin
 * @property int|null $birth_city_id
 * @property int|null $birth_province_id
 * @property string|null $birth_address
 * @property int $registration_date
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
class RealContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'real_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'national_id', 'registration_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['coin', 'birth_city_id', 'birth_province_id', 'registration_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['summary', 'description', 'mobile_numbers', 'social_links', 'phone_numbers', 'fax_numbers', 'addresses', 'emails', 'websites', 'bank_accounts', 'cards', 'shaba_numbers'], 'string'],
            [['image'], 'string', 'max' => 256],
            [['first_name', 'last_name', 'national_id'], 'string', 'max' => 128],
            [['birth_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'national_id' => Yii::t('app', 'National ID'),
            'coin' => Yii::t('app', 'Coin'),
            'birth_city_id' => Yii::t('app', 'Birth City ID'),
            'birth_province_id' => Yii::t('app', 'Birth Province ID'),
            'birth_address' => Yii::t('app', 'Birth Address'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'status' => Yii::t('app', 'Status'),
            'summary' => Yii::t('app', 'Summary'),
            'description' => Yii::t('app', 'Description'),
            'mobile_numbers' => Yii::t('app', 'Mobile Numbers'),
            'social_links' => Yii::t('app', 'Social Links'),
            'phone_numbers' => Yii::t('app', 'Phone Numbers'),
            'fax_numbers' => Yii::t('app', 'Fax Numbers'),
            'addresses' => Yii::t('app', 'Addresses'),
            'emails' => Yii::t('app', 'Emails'),
            'websites' => Yii::t('app', 'Websites'),
            'bank_accounts' => Yii::t('app', 'Bank Accounts'),
            'cards' => Yii::t('app', 'Cards'),
            'shaba_numbers' => Yii::t('app', 'Shaba Numbers'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RealContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RealContactQuery(get_called_class());
    }
}
