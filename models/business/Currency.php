<?php

namespace app\models\business;

class Currency
{
    public $code;

    public function __construct(string $code)
    {
        $this->code = $code;
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

    public function format($units)
    {
        $definition = static::getDefinitions()[$this->code];
        $decimalValue = $definition[2]($units, $definition[1]);
        return str_replace('{0}', $decimalValue, $definition[0]);
    }
}