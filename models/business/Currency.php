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
                '{0}',
                2,
                function ($units, $dotPlaces) {
                    return number_format($units / (10 ** $dotPlaces), $dotPlaces, '.', '');
                },
                function (string $value) {
                    if(!preg_match('/^(?<whole>(0|[1-9][0-9]*))(\.(?<decimal>\d{1,2}))?$/', $value, $matches))
                    {
                        return false;
                    }
                    $whole = (int)str_replace(',', '', $matches['whole']);
                    $decimal = ArrayHelper::getValue($matches, 'decimal', 0);
                    return $whole * (10 ** 2) + $decimal;
                }
            ],
            'USD' => [
                '{0}',
                2,
                function ($units, $dotPlaces) {
                    return number_format($units / (10 ** $dotPlaces), $dotPlaces, '.', '');
                },
                function (string $value) {
                    if(!preg_match('/^(?<whole>(0|[1-9][0-9]*))(\.(?<decimal>\d{1,2}))?/', $value, $matches))
                    {
                        return false;
                    }
                    $whole = (int)str_replace(',', '', $matches['whole']);
                    $decimal = (int)$matches['decimal'];
                    return $whole * (10 ** 2) + $decimal;
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

    public function unitsFromString(string $value) : int
    {
        $definition = static::getDefinitions()[$this->code];
        $units = $definition[3]($value);
        if($units === false) {
            throw new \Exception('Failed to convert');
        }
        return $units;
    }
}