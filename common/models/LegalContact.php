<?php

namespace common\models;

use common\behaviors\Taggable;
use common\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "legal_contact".
 *
 * @property int $id
 * @property string|null $logo
 * @property string $name
 * @property string $national_code
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

    public $contact_tag;
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
            [['name', 'national_code', 'status'], 'required'],
            [['coin', 'registration_city_id', 'registration_province_id', 'status'], 'integer'],
            [['registration_date'], 'safe'],
            [['summary', 'description', 'mobile_numbers', 'social_links', 'phone_numbers', 'fax_numbers', 'addresses', 'emails', 'websites', 'bank_accounts', 'cards', 'shaba_numbers'], 'string'],
            [[ 'name', 'national_code', 'economic_code', 'registration_address'], 'string', 'max' => 255],
            [['tagNames', 'contact_tag'], 'safe'],
            ['logo', 'image','extensions' => 'jpg, jpeg, png'],
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
            'national_code' => Yii::t('app', 'National ID'),
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
            'tagNames' => Yii::t('app', 'Tags'),
            'contact_tag' => Yii::t('app', 'Contact Tag'),
        ];
    }

    public function getFile()
    {
        return $this->hasMany(LegalContactFile::class, ['contact_id' => 'id']);
    }

    public function setTags(array $searchedTags, bool $flag)
    {
        if (!empty($searchedTags)) {
            $tagIds = [];
            foreach ($searchedTags as $tagName) {
                if (!$flag) {
                    break;
                }

                $existingTag = Tag::findOne(['name' => $tagName]);

                if ($existingTag) {
                    $tagIds[] = $existingTag->tag_id;
                } else {
                    $newTag = new Tag(['name' => $tagName, 'type' => '1']);
                    if ($flag = $newTag->save()) {
                        $tagIds[] = $newTag->tag_id;
                    }
                }
            }
            $this->tagNames = $tagIds;
        } else {
            $this->tagNames = [];
        }
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
            'taggable' => [
                'class' => Taggable::class,
                'classAttribute' => self::class,
                'deleteTagsScenario' => self::SCENARIO_DEFAULT
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
            [
                'class' => UploadBehavior::class,
                'attribute' => 'logo',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'path' => '@webroot/upload/contact/real',
                'url' => Url::to('@web/upload/contact/real'),
            ],
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
