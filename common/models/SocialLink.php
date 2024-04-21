<?php

namespace common\models;


use yii\base\Model;
use Yii;

class SocialLink extends Model
{

    public $isNewRecord = true;
    public $social_link;

    public function rules()
    {
        return [
            [['social_link'],'required'],
            [['social_link'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'social_link' => 'لینک شبکه های اجتماعی',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'social_link' => $eachData->social_link,
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