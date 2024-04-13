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