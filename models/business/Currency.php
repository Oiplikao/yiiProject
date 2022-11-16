<?php

namespace app\models\business;

use yii\base\Model;

class Currency extends Model
{
    public $code;

    public function __construct(string $code, $config = [])
    {
        $this->code = $code;
        parent::__construct($config);
    }

    public static function getDefinitions()
    {
        return [
            'RUB' => [
                '{0} р.',
                2,
                function ($units, $dotPlaces) {
                    return number_format($units / (10 * $dotPlaces), $dotPlaces, ',', ' ');
                }
            ],
            'USD' => [
                '${0}',
                2,
                function ($units, $dotPlaces) {
                    return number_format($units / (10 * $dotPlaces), $dotPlaces, '.', ' ');
                }
            ]
        ];
    }

    public static function getSupportedCurrencies()
    {
        return array_keys(self::getDefinitions());
    }

    public function format($units)
    {
        $definition = static::getDefinitions()[$this->code];
        $decimalValue = $definition[2]($units, $definition[1]);
        return str_replace('{0}', $decimalValue, $definition[0]);
    }
}