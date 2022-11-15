<?php

namespace app\models\business;

class MoneyAsset extends Asset implements FixedMoneyValueInterface
{
    public Money $moneyValue;

    public function init()
    {
        if(empty($this->moneyValue)) {
            $this->moneyValue = new Money(0, new Currency('RUB'));
        }
        parent::init();
    }

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