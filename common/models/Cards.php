<?php

namespace common\models;


use yii\base\Model;
use Yii;

class Cards extends Model
{

    public $isNewRecord = true;
    public $card;

    public function rules()
    {
        return [
            [['card'],'required'],
            [['card'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'card' => 'شماره کارت',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'card' => $eachData->card,
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