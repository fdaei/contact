<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class MentorCreate extends \api\models\Mentor
{
    public function beforeValidate()
    {
        $this->user_id = 1;
        $this->created_by = 1;
        $this->records =  (json_decode($this->records));

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }
}
