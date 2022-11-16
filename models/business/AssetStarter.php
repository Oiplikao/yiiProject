<?php


namespace app\models\business;

use app\models\Address;
use yii\helpers\ArrayHelper;

class AssetStarter
{
    static $assets = [];

    static function getAssets(): array
    {
        self::$assets = unserialize(\Yii::$app->session->get('assets'));
        if(empty(self::$assets)) {
            \Yii::$app->session->set('assets', serialize(self::initAssets()));
            self::$assets = unserialize(\Yii::$app->session->get('assets'));
        }
        return self::$assets;
    }

    static function saveAssets()
    {
        \Yii::$app->session->set('assets', serialize(self::$assets));
    }

    static function addAsset(Asset $asset)
    {
        if(empty(self::$assets)) {
            self::getAssets();
        }
        self::$assets[] = $asset;
    }

    static function deleteAsset(Asset $asset)
    {
        ArrayHelper::removeValue(self::$assets, $asset);
    }

    static function initAssets()
    {
        return [
            new BankAccountAsset([
                'name' => 'Счёт в ЕвроВорБанк',
                'accountNumber' => 5,
                'bankID' => 'ЕвроВорБанк',
                'moneyValue' => new Money(100000, new Currency('RUB'))
            ]),
            new BankAccountAsset([
                'name' => 'Счёт в Внешторбанке',
                'accountNumber' => 3,
                'bankID' => 'Внешторбанк',
                'moneyValue' => new Money(500, new Currency('USD'))
            ]),
            new MoneyAsset([
                'name' => 'Рубли в кассе',
                'moneyValue' => new Money(10000, new Currency('RUB'))
            ]),
            new BonusCouponsAsset([
                'name' => 'Талоны на бензин от Аспека',
                'moneyValue' => new Money(300000, new Currency('RUB'))
            ]),
            new BuildingAsset([
                'name' => ' Торговое здание',
                'productionDate' => new \DateTime('1970'),
                'inventoryNumber' => 7,
                'address' => new Address([
                    'country' => 'Россия',
                    'city' => 'Ижевск',
                    'street' => 'Бассейная',
                    'house' => '6'
                ]),
                'acquisitionCost' => new Money(3000000, new Currency('RUB')),
                'estimatedValue' => new Money(100000000, new Currency('RUB')),
                'carryingCost' => new Money(500000, new Currency('RUB')),
            ]),
            new ItemAsset([
                'name' => 'Гвозди',
                'quantity' => new Quantity(100, Quantity::MEASURE_KILOGRAM),
                'productionDate' => new \DateTime('2000'),
                'acquisitionCost' => new Money(100000, new Currency('RUB')),
                'carryingCost' => new Money(10000, new Currency('RUB')),
                'marketValue' => new Money(200000, new Currency('RUB'))
            ])
        ];
    }
}