<?php

namespace common\models;


use yii\base\Model;
use Yii;

class ShabaNumbers extends Model
{

    public $isNewRecord = true;
    public $shaba_numbers;

    public function rules()
    {
        return [
            [['shaba_numbers'],'required'],
            [['shaba_numbers'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'shaba_numbers' => 'شماره شبا',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'shaba_numbers' => $eachData->shaba_numbers,
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