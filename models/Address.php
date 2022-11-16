<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class Address extends Model
{
    public string $country = '';
    public string $city = '';
    public string $street = '';
    public string $house = '';

    //not required
    public string $apartment = '';

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'country' => 'Страна',
            'city' => 'Город',
            'street' => 'Улица',
            'house' => 'Дом',
            'apartment' => 'Квартира'
        ]);
    }
}