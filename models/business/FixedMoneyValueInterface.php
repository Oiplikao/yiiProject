<?php

namespace app\models\business;

interface FixedMoneyValueInterface
{
    public function getMoneyValue(): Money;
}