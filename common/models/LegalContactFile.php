<?php

namespace common\models;

use Yii;

/**
* This is the model class for table "legal_contact_file".
*
    * @property int $id
    * @property string $file_name
    * @property string $file_path
    * @property int $contact_id
    * @property int $created_at
    * @property int $created_by
    * @property int $updated_at
    * @property int $updated_by
    * @property int|null $deleted_at
    *
            * @property LegalContact $contact
            * @property User $createdBy
            * @property User $updatedBy
    */
class LegalContactFile extends \yii\db\ActiveRecord
{

/**
* {@inheritdoc}
*/
const STATUS_ACTIVE = 1;
const STATUS_DELETED = 0;
const STATUS_INACTIVE = 2;


public static function tableName()
{
return 'legal_contact_file';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['file_name', 'file_path', 'contact_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['contact_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['file_name', 'file_path'], 'string', 'max' => 255],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => LegalContact::class, 'targetAttribute' => ['contact_id' => 'id']],
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
    'file_name' => Yii::t('app', 'File Name'),
    'file_path' => Yii::t('app', 'File Path'),
    'contact_id' => Yii::t('app', 'Contact ID'),
    'created_at' => Yii::t('app', 'Created At'),
    'created_by' => Yii::t('app', 'Created By'),
    'updated_at' => Yii::t('app', 'Updated At'),
    'updated_by' => Yii::t('app', 'Updated By'),
    'deleted_at' => Yii::t('app', 'Deleted At'),
];
}

    /**
    * Gets query for [[Contact]].
    *
    * @return \yii\db\ActiveQuery|LegalContactQuery
    */
    public function getContact()
    {
    return $this->hasOne(LegalContact::class, ['id' => 'contact_id']);
    }

    /**
    * Gets query for [[CreatedBy]].
    *
    * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
    */
    public function getCreatedBy()
    {
    return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
    * Gets query for [[UpdatedBy]].
    *
    * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
    */
    public function getUpdatedBy()
    {
    return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
    
    /**
    * {@inheritdoc}
    * @return RealLegalContactQuery the active query used by this AR class.
    */
    public static function find()
    {
    $query = new RealLegalContactQuery(get_called_class());
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
    ];
    }

    public function fields()
    {
    return [
            'id' ,
            'file_name' ,
            'file_path' ,
            'contact_id' ,
            'created_at' ,
            'created_by' ,
            'updated_at' ,
            'updated_by' ,
            'deleted_at' ,
        ];
    }

    public function extraFields()
    {
    return [];
    }
}
