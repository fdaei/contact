<?php

namespace common\models;


use yii\base\Model;
use Yii;

class FaxNumbers extends Model
{

    public $isNewRecord = true;
    public $fax_number;

    public function rules()
    {
        return [
            [['fax_number'],'required'],
            [['fax_number'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fax_number' => 'شماره فکس ',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'fax_number' => $eachData->fax_number,
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