<?php

namespace app\models\business;

use yii\helpers\ArrayHelper;

class BankAccountAsset extends Asset implements FixedMoneyValueInterface
{
    public string $accountNumber = '';
    public string $bankID = '';
    public Money $moneyValue;

    static public function getType() : string
    {
        return 'Банковский счёт';
    }


    public function init()
    {
        if(empty($this->moneyValue)) {
            $this->moneyValue = new Money(0, new Currency('RUB'));
        }
        parent::init();
    }

    /**
     * @return Money
     */
    public function getMoneyValue(): Money
    {
        return $this->moneyValue;
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'accountNumber' => 'Номер счёта',
            'bankID' => 'Название банка'
        ]);
    }
}