<?php

namespace app\models\business;

interface ComplexMoneyValueInterface
{
    /**
     * Остаточная стоимость
     * @return Money
     */
    public function getCarryingCost(): Money;

    /**
     * Начальная стоимость
     * @return Money
     */
    public function getAcquisitionCost(): Money;

    /**
     * Оценочная стоимость
     * @return Money
     */
    public function getEstimatedValue(): Money;

    /**
     * Рыночная стоимость
     * @return Money
     */
    public function getMarketValue(): ?Money;
}