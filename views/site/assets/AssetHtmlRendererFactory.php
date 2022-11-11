<?php

namespace app\views\site\assets;

use app\models\business\Asset;
use app\models\business\BankAccountAsset;
use app\models\business\BuildingAsset;
use app\models\business\ItemAsset;
use app\models\business\BonusCouponsAsset;
use app\models\business\MoneyAsset;

class AssetHtmlRendererFactory
{
    static public $renderers = [
        BankAccountAsset::class => BankAccountAssetHtmlRenderer::class,
        MoneyAsset::class => MoneyAssetHtmlRenderer::class,
        BuildingAsset::class => BuildingAssetHtmlRenderer::class,
        BonusCouponsAsset::class => BonusCouponAssetHtmlRenderer::class,
        ItemAsset::class => ItemAssetHtmlRenderer::class
    ];

    public function getSupportedAssets()
    {
        return array_map(function($class) { return $class::getType(); } , array_keys(self::$renderers));
    }

    public function getRendererFor(Asset $asset) : AssetHtmlRenderer
    {
        $assetClass = get_class($asset);
        $assetHtmlRendererClass = static::$renderers[$assetClass];
        return new $assetHtmlRendererClass();
    }
}