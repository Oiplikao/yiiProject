<?php

namespace app\models\business;

class BonusCouponsAsset extends Asset implements AssetInterface, FixedMoneyValueInterface
{
    public Money $moneyValue;

    public static function getType(): string
    {
        return 'Бонусные купоны';
    }

    /**
     * @return Money
     */
    public function getMoneyValue(): Money
    {
        return $this->moneyValue;
    }
}