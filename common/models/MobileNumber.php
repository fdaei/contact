<?php

namespace common\models;

use yii\base\Model;
use Yii;

class MobileNumber extends Model
{
    public $isNewRecord = true;
    public $mobile_title;
    public $mobile_number;
    public $mobile_type; // نوع شماره موبایل
    public $message_link; // لینک پیام

    public function rules()
    {
        return [
            [['mobile_title','mobile_number', 'mobile_type', 'message_link'],'required'],
            [['mobile_title','mobile_number', 'mobile_type', 'message_link'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'mobile_title' => 'عنوان موبایل ',
            'mobile_number'=>'شماره موبایل',
            'mobile_type' => 'نوع شماره موبایل',
            'message_link' => 'لینک پیام',
        ];
    }

    public static function handelData($defaultData = [])
    {
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if ($eachData->validate()) {
                $headlinesJson[] = [
                    'mobile_title' => $eachData->mobile_title,
                    'mobile_number' => $eachData->mobile_number,
                    'message_link'=>$eachData->message_link,
                    'mobile_type'=>$eachData->mobile_type
                ];
            }
        }
        return $headlinesJson;
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'SocialNetworks' => [
                'mobile' => 'موبایل',
                'whatsapp' => 'واتس آپ',
                'telegram' => 'تلگرام',
                'rubika' => 'روبیکا',
                'bale' => 'بله',
                'iGap' => 'ایتا',
                'soroush' => 'سروش',
            ],
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public static function loadDefaultValue($datas)
    {
        $arrayData = [];
        for ($i = 0; $i < count($datas); $i++) {
            $arrayData[$i] = new self();
            $arrayData[$i]->attributes = $datas[$i];
        }
        if (empty($arrayData)) {
            $arrayData = [new self()];
        }
        return $arrayData;
    }
}
