<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "ince_business_member".
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $image
 * @property string $position
 * @property int $id
 * @property int $business_id
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property Business $business
 */
class BusinessMember extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ince_business_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'image', 'position','status'],'required', 'on' => [self::SCENARIO_CREATE]],
            [['first_name', 'last_name', 'position','!status'],'required', 'on' => [self::SCENARIO_UPDATE]],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg'], 'checkExtensionByMimeType' => false],
            ['image', 'image', 'minWidth' => 648, 'maxWidth' => 648, 'minHeight' => 348, 'maxHeight' => 348, 'extensions' => 'jpg, gif, png', 'maxSize' => 648 * 348 * 2],
            [['business_id'], 'integer'],
            [['first_name', 'last_name', 'position'], 'string', 'max' => 64],
            [['business_id'], 'exist', 'skipOnError' => true, 'targetClass' => Business::class, 'targetAttribute' => ['business_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['first_name', 'last_name', 'image', 'position','!status'];
        $scenarios[self::SCENARIO_UPDATE] = ['first_name', 'last_name', 'position','!status'];

        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'image' => Yii::t('app', 'Image'),
            'position' => Yii::t('app', 'Position'),
            'id' => Yii::t('app', 'ID'),
            'business_id' => Yii::t('app', 'Business ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Business]].
     *
     * @return \yii\db\ActiveQuery|BusinessQuery
     */
    public function getBusiness()
    {
        return $this->hasOne(Business::class, ['id' => 'business_id']);
    }

    /**
     * {@inheritdoc}
     * @return BusinessMemberQuery the active query used by this AR class.
     */
    public static function find(): BusinessMemberQuery
    {
        $query = new BusinessMemberQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/Business",
                'basePath' => "@inceRoot/Business",
                'path' => "@inceRoot/Business",
                'url' => "@cdnWeb/Business"
            ],
        ];
    }

    public function fields()
    {
        return [
            'first_name',
            'last_name',
            'position',
            'image' => function (self $model) {
                return $model->getUploadUrl('image');
            },
        ];
    }

    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }
}