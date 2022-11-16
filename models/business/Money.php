<?php

namespace app\models\business;

use yii\base\Model;

class Money extends Model
{
    public int $units;
    public Currency $currency;

    public function __construct(int $units, Currency $currency, $config = [])
    {
        $this->units = $units;
        $this->currency = $currency;
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'units' => 'Минимальные единицы валюты',
            'currency' => 'Валюта',
            'value' => 'Значение'
        ];
    }

    public function setValue(string $value)
    {
        $this->units = $this->currency->unitsFromString($value);
    }

    public function getValue() : string
    {
        return $this->currency->format($this->units);
    }
}