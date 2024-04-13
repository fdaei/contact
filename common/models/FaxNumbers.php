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