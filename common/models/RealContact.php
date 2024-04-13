<?php

namespace common\models;

use common\behaviors\Taggable;
use sadi01\moresettings\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
class RealContact extends ActiveRecord
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
        return '{{%real_contact}}';
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
            [['contact_tag'], 'required'],
            [['tagNames', 'contact_tag'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'contact_type' => Yii::t('app', 'Contact Type'),
            'national_id' => Yii::t('app', 'National ID'),
            'economic_code' => Yii::t('app', 'Economic Code'),
            'coin' => Yii::t('app', 'Coin'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'address' => Yii::t('app', 'Address'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'status' => Yii::t('app', 'Status'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'birth_city_id' => Yii::t('app', 'Birth City ID'),
            'birth_province_id' => Yii::t('app', 'Birth Province ID'),
            'birth_address' => Yii::t('app', 'Birth Address'),
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
            'image' => Yii::t('app', 'Image'),
            'tagNames' => Yii::t('app', 'Tags'),
            'contact_tag' => Yii::t('app', 'Contact Tag'),
        ];
    }

    public function setTags(array $searchedTags, bool $flag)
    {
        if (!empty($searchedTags)) {
            $tagIds = [];
            foreach ($searchedTags as $tagName) {
                if (!$flag) {
                    break;
                }

                $existingTag = Tag::findOne(['tag_id' => $tagName]);
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
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'path' => '@webroot/upload/contact/real',
                'url' => '@web/upload/contact/real',
            ],
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
