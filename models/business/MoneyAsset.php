<?php

namespace app\models\business;

class MoneyAsset extends Asset implements FixedMoneyValueInterface
{
    public Money $moneyValue;

    public static function getType(): string
    {
        return 'Деньги в кассе';
    }

    /**
     * @return string
     */
    public function getMoneyValue(): Money
    {
        return $this->moneyValue;
    }
}