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