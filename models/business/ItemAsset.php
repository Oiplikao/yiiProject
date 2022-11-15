<?php


namespace app\models\business;

class ItemAsset extends Asset implements ComplexMoneyValueInterface, HasProductionDateInterface
{
    public \DateTime $productionDate;
    public Quantity $quantity;
    public string $productionDateFormat = 'Y';
    public Money $acquisitionCost;
    public Money $carryingCost;
    public Money $estimatedValue;
    public ?Money $marketValue;

    public static function getType(): string
    {
        return 'Предмет';
    }

    public function init()
    {
        if(empty($this->productionDate)) {
            $this->productionDate = new \DateTime(0);
        }
        if(empty($this->acquisitionCost)) {
            $this->acquisitionCost = new Money(0, new Currency('RUB'));
        }
        if(empty($this->carryingCost)) {
            $this->carryingCost = new Money(0, new Currency('RUB'));
        }
        if(empty($this->estimatedValue)) {
            $this->estimatedValue = new Money(0, new Currency('RUB'));
        }
        if(empty($this->marketValue)) {
            $this->marketValue = new Money(0, new Currency('RUB'));
        }
        parent::init();
    }

    public function getProductionDate(): \DateTime
    {
        return $this->productionDate;
    }

    public function getProductionDateFormatted() : string
    {
        return $this->productionDate->format($this->productionDateFormat);
    }

    public function setProductionDateFormatted(string $value)
    {
        $this->productionDate = new \DateTime($value);
    }

    public function getProductionDateFormat(): string
    {
        return $this->productionDateFormat;
    }

    public function getAcquisitionCost(): Money
    {
        return $this->acquisitionCost;
    }

    public function getCarryingCost(): Money
    {
        return $this->carryingCost;
    }

    public function getEstimatedValue(): Money
    {
        return $this->estimatedValue;
    }

    public function getMarketValue() : ?Money
    {
        return $this->marketValue;
    }
}