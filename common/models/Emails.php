<?php

namespace common\models;


use yii\base\Model;
use Yii;

class Emails extends Model
{

    public $isNewRecord = true;
    public $email;

    public function rules()
    {
        return [
            [['email'],'required'],
            [['email'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'ایمیل',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'email' => $eachData->email,
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