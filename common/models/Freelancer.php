<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%freelancer}}".
 *
 * @property int $id
 * @property string $name
 * @property int|null $sex
 * @property string $email
 * @property string $mobile
 * @property int $city
 * @property int $province
 * @property int $marital_status
 * @property int $military_service_status
 * @property string $activity_field
 * @property string $experience
 * @property string $experience_period
 * @property string $skills
 * @property string $record_job
 * @property string $record_educational
 * @property string|null $portfolio
 * @property string $resume_file
 * @property string $description_user
 * @property int|null $project_number
 * @property int $status
 * @property int $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 */
class Freelancer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'mobile', 'city', 'province', 'marital_status', 'military_service_status', 'activity_field', 'experience', 'experience_period', 'skills',], 'required'],
            [['sex', 'city', 'province', 'marital_status', 'military_service_status', 'project_number', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['record_job', 'record_educational', 'portfolio'], 'safe'],
            [['description_user'], 'string'],
            [['name', 'email', 'mobile', 'activity_field', 'experience', 'experience_period'], 'string', 'max' => 255],
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
            'sex' => Yii::t('app', 'Sex'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'military_service_status' => Yii::t('app', 'Military Service Status'),
            'activity_field' => Yii::t('app', 'Activity Field'),
            'experience' => Yii::t('app', 'Experience'),
            'experience_period' => Yii::t('app', 'Experience Period'),
            'skills' => Yii::t('app', 'Skills'),
            'record_job' => Yii::t('app', 'Record Job'),
            'record_educational' => Yii::t('app', 'Record Educational'),
            'portfolio' => Yii::t('app', 'Portfolio'),
            'resume_file' => Yii::t('app', 'Resume File'),
            'description_user' => Yii::t('app', 'Description User'),
            'project_number' => Yii::t('app', 'Project Number'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FreelancerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FreelancerQuery(get_called_class());
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => null,
                'updatedByAttribute' => 'updated_by',
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'resume_file',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/freelancer",
                'basePath' => "@inceRoot/freelancer",
                'path' => "@inceRoot/freelancer",
                'url' => "@cdnWeb/freelancer"
            ],
        ];
    }
}