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
    public static function loadDefaultValue($jsonData, $modelClass)
    {
        $models = [];

        if (!empty($jsonData) && is_string($jsonData)) {
            $decodedData = json_decode($jsonData, true);

            if (is_array($decodedData)) {
                foreach ($decodedData as $data) {
                    $model = new $modelClass();
                    $model->attributes = $data;
                    $models[] = $model;
                }
            } else {
                $models[] = new $modelClass();
            }
        } else {
            $models[] = new $modelClass();
        }

        return $models;
    }


}