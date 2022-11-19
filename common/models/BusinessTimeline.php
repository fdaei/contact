<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "business_timeline".
 *
 * @property int $id
 * @property int $business_id
 * @property string $year
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property Business $business
 * @property User $createdBy
 * @property User $updatedBy
 */
class BusinessTimeline extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%business_timeline}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_id', 'year', 'description', 'status'], 'required'],
            [['business_id', 'status'], 'integer'],
            [['year'], 'safe'],
            [['business_id'], 'exist', 'skipOnError' => true, 'targetClass' => Business::class, 'targetAttribute' => ['business_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_id' => Yii::t('app', 'Business ID'),
            'year' => Yii::t('app', 'Year'),
            'description' => Yii::t('app', 'Description'),
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return BusinessTimelineQuery the active query used by this AR class.
     */
    public static function find(): BusinessTimelineQuery
    {
        $query = new BusinessTimelineQuery(get_called_class());
        return $query->active();
    }

    public function convert($array, $mod = '')
    {
        return Yii::$app->formatter->asSpellout($this->year);
    }

    public function canDelete()
    {
        if (1!=1) {
            $this->addError('status', 'قادر به حذف نیستیم ');
            return  false;
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
        ];
    }

    public function fields()
    {
        return [
            'id',
            'businessId' => 'business_id',
            'year',
            'description' => 'description',
            'yearFa' => function (self $model) {
                return $model->convert([$model->year]);
            },
        ];
    }

    public function extraFields()
    {
        return [

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