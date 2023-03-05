<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Mentor extends \common\models\Mentor
{
    public function fields()
    {
        return [
            'id',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
            'picture_mentor' => function (self $model) {
                return $model->getUploadUrl('picture_mentor');
            },
            'activity_field',
            'activity_description',
            'instagram',
            'linkedin',
            'twitter',
            'telegram',
            'services',
            'records',
        ];
    }
}