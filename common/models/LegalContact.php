<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use sadi01\moresettings\behaviors\UploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
class LegalContact extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%legal_contact}}';
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'logo' => Yii::t('app', 'Logo'),
            'name' => Yii::t('app', 'Name'),
            'national_id' => Yii::t('app', 'National ID'),
            'economic_code' => Yii::t('app', 'Economic Code'),
            'coin' => Yii::t('app', 'Coin'),
            'registration_city_id' => Yii::t('app', 'Registration City ID'),
            'registration_province_id' => Yii::t('app', 'Registration Province ID'),
            'registration_address' => Yii::t('app', 'Registration Address'),
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

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
            ],
            'StatusClass' => [
                self::STATUS_DELETED => 'danger',
                self::STATUS_ACTIVE => 'success',
                self::STATUS_INACTIVE => 'warning',
            ],
            'StatusColor' => [
                self::STATUS_DELETED => '#ff5050',
                self::STATUS_ACTIVE => '#04AA6D',
                self::STATUS_INACTIVE => '#eea236',
            ],
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                    'status' => self::STATUS_DELETED
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => self::STATUS_ACTIVE
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
//            [
//                'class' => UploadImageBehavior::class,
//                'attribute' => 'logo',
//                'scenarios' => [self::SCENARIO_DEFAULT],
//                'instanceByName' => false,
//                //'placeholder' => "/assets/images/default.jpg",
//                'deleteBasePathOnDelete' => false,
//                'createThumbsOnSave' => false,
//                'transferToCDN' => false,
//                'cdnPath' => "@cdnRoot/legalContact",
//                'basePath' => "@inceRoot/legalContact",
//                'path' => "@inceRoot/legalContact",
//                'url' => "@cdnWeb/legalContact"
//            ],
        ];
    }
    /**
     * {@inheritdoc}
     * @return LegalContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LegalContactQuery(get_called_class());
    }
}
