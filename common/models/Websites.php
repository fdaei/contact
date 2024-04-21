<?php

namespace common\models;


use yii\base\Model;
use Yii;

class Websites extends Model
{

    public $isNewRecord = true;
    public $website;

    public function rules()
    {
        return [
            [['website'],'required'],
            [['website'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'website' => 'لینک وب سایت ',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'website' => $eachData->website,
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