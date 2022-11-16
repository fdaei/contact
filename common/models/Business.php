<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property int $user_id
 * @property int $city_id
 * @property string $title
 * @property string $link
 * @property string $slug
 * @property string $logo
 * @property string $wallpaper
 * @property string $short_description
 * @property string $success_story
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property BusinessGallery[] $businessGalleries
 * @property BusinessTimeline[] $businessTimelines
 * @property BusinessStat[] $businessStates
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 * @property string successStory
 * @mixin CdnUploadImageBehavior
 */
class Business extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%business}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'city_id', 'title', 'short_description', 'success_story', 'status', 'slug'], 'required', 'on' => [self::SCENARIO_DEFAULT]],
            [['user_id', 'city_id', 'title', 'status'], 'required', 'on' => [self::SCENARIO_UPDATE]],
            [['user_id', 'city_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['short_description', 'success_story'], 'string'],
            [['logo', "wallpaper"], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'svg'], 'checkExtensionByMimeType' => false],
            [['link'], 'url'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_UPDATE] = ['province_id', 'name', '!status'];

        return $scenarios;
    }

    public function validateTEST($attribute, $params)
    {
        if (strlen($this->title) > 65) {
            $this->addError($attribute, 'تعداد کاراکتر باید کمتر از ۶۵ باشد ');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'title' => Yii::t('app', 'Title'),
            'link' => Yii::t('app', 'Link'),
            'slug' => Yii::t('app', 'Slug'),
            'logo' => Yii::t('app', 'Logo'),
            'wallpaper' => Yii::t('app', 'Wallpaper'),
            'short_description' => Yii::t('app', 'Short Description'),
            'success_story' => Yii::t('app', 'Success Story'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[BusinessGalleries]].
     *
     * @return \yii\db\ActiveQuery|BusinessGalleryQuery
     */
    public function getBusinessGalleries()
    {
        return $this->hasMany(BusinessGallery::class, ['business_id' => 'id']);
    }
    public function getBusinessStates()
    {
        return $this->hasMany(BusinessGallery::class, ['business_id' => 'id']);
    }
    /**
     * Gets query for [[BusinessTimelines]].
     *
     * @return \yii\db\ActiveQuery|BusinessTimelineQuery
     */
    public function getBusinessTimelines()
    {
        return $this->hasMany(BusinessTimeline::class, ['business_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity(): \yii\db\ActiveQuery|CityQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * {@inheritdoc}
     * @return BusinessQuery the active query used by this AR class.
     */
    public static function find(): BusinessQuery
    {
        $query = new BusinessQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        $stat = BusinessStat::find()->active()->andWhere(['business_id' => $this->id])->limit(1)->one();

        if ($stat) {
            return false;
        }
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
                'attribute' => 'logo',
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'wallpaper',
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
            'id',
            'title' => 'title',
            'logo' => 'logo',
            'wallpaper' => 'wallpaper',
            'shortDescription' => 'short_description',
            'successStory' => 'success_story',
            'slug'=>'slug',
            'link'=>'link'
        ];
    }

    public function extraFields()
    {
        return [
            'timeLines' => 'businessTimelines',
            'galleries' => 'businessGalleries',
            'satat' => 'businessStates',
            'cityId' => 'city_id',
        ];
    }

    public function beforeSoftDelete()
    {
        return true;
    }

    public function beforeRestore()
    {
        return true;
    }
}