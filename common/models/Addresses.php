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
            [['address', 'address_type'], 'string'],
            [['postal_code', 'province_id', 'city_id'], 'integer'],
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

    public static function handelData($defaultData = [])
    {
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if ($eachData->validate()) {
                $headlinesJson[] = [
                    'address' => $eachData->address,
                    'postal_code' => $eachData->postal_code,
                    'address_type' => $eachData->address_type,
                    'province_id' => $eachData->province_id,
                    'city_id' => $eachData->city_id,
                ];
            }
        }
        return $headlinesJson;
    }

    public static function loadDefaultValue($data)
    {
        $addressModels = [];

        // Check if $data is a non-empty string (assuming it's a JSON string)
        if (!empty($data) && is_string($data)) {
            // Decode the JSON string into an array
            $decodedData = json_decode($data, true);

            // Check if decoding was successful
            if (is_array($decodedData)) {
                foreach ($decodedData as $addressData) {
                    $addressModel = new self();
                    $addressModel->attributes = $addressData;
                    $addressModels[] = $addressModel;
                }
            } else {
                // If decoding failed, initialize with a single empty address model
                $addressModels[] = new self();
            }
        } else {
            // If $data is empty or not a string, initialize with a single empty address model
            $addressModels[] = new self();
        }

        return $addressModels;
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
