<?php

namespace app\models;

use yii\base\Model;

class Address extends Model
{
    public string $country = '';
    public string $city = '';
    public string $street = '';
    public string $house = '';

    //not required
    public string $apartment = '';
}