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