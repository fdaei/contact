<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class MentorsAdviceRequest extends \common\models\MentorsAdviceRequest
{
    public function beforeValidate()
    {
        $this->status = 0;

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }
}