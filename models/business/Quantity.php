<?php


namespace app\models\business;


use yii\base\Model;

class Quantity extends Model
{
    const MEASURE_PIECE = 'pc';
    const MEASURE_KILOGRAM = 'kg';
    const MEASURE_METER = 'm';

    public string $measureUnit = self::MEASURE_PIECE;
    public int $value = 0;

    public function __construct($value, $measureUnit, $config = [])
    {
        $this->value = $value;
        $this->measureUnit = $measureUnit;
        parent::__construct($config);
    }

    const MEASURE_UNITS = [
        'pc' => 'шт',
        'kg' => 'кг',
        'm' => 'м'
    ];

    public function attributeLabels()
    {
        return [
            'measureUnit' => 'Единица измерения',
            'value' => 'Значение'
        ];
    }
}