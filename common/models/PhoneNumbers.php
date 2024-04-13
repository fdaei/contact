<?php

namespace common\models;


use yii\base\Model;
use Yii;

class PhoneNumbers extends Model
{

    public $isNewRecord = true;
    public $phone_number;

    public function rules()
    {
        return [
            [['phone_number'],'required'],
            [['phone_number'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone_number'=>'شماره ثابت '
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'phone_number' => $eachData->phone_number,
                ];
            }
        }
        return $headlinesJson;
    }
    public static function loadDefaultValue($datas){
        $arrayData = [];
        for ($i = 0; $i < count($datas); $i++) {
            $arrayData[$i] = new self();
            $arrayData[$i]->attributes = $datas[$i];
        }
        if(empty($arrayData)){
            $arrayData = [new self()];
        }
        return $arrayData;

    }

}