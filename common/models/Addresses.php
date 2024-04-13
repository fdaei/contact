<?php

namespace common\models;

use yii\base\Model;
use Yii;

class Addresses extends Model
{
    public $isNewRecord = true;
    public $address;
    public $postal_code;
    public $address_type;
    public $province_id;
    public $city_id;

    const TYPE_HOME = 'home';
    const TYPE_WORK = 'work';
    const TYPE_WORK_HOME = 'work_home';

    public function rules()
    {
        return [
            [['address', 'postal_code', 'address_type', 'province_id', 'city_id'], 'required'],
            [['address', 'address_type', 'province_id', 'city_id'], 'string'],
            [['postal_code'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => 'آدرس',
            'postal_code' => 'کد پستی',
            'address_type' => 'نوع آدرس',
            'province_id' => 'استان',
            'city_id' => 'شهر',
        ];
    }

    public static function handleData($defaultData = [])
    {
        $postData = Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'address' => $eachData->address,
                    'postal_code' => $eachData->postal_code,
                    'address_type' => $eachData->address_type,
                    'province' => $eachData->province,
                    'city' => $eachData->city,
                    'district' => $eachData->district,
                ];
            }
        }
        return $headlinesJson;
    }

    public static function loadDefaultValue($datas)
    {
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

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'AddressType' => [
                self::TYPE_HOME => 'منزل',
                self::TYPE_WORK => 'کار',
                self::TYPE_WORK_HOME => 'کار خونه',
            ],
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
}