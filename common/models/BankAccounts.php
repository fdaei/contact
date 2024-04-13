<?php

namespace common\models;


use yii\base\Model;
use Yii;

class BankAccounts extends Model
{

    public $isNewRecord = true;
    public $bank_accounts;

    public function rules()
    {
        return [
            [['bank_accounts'],'required'],
            [['bank_accounts'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'bank_accounts' => 'شماره حساب',
        ];
    }
    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'bank_accounts' => $eachData->bank_accounts,
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