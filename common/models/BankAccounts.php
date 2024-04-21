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