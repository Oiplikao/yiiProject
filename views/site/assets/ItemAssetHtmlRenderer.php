<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\business\Asset;
use app\models\business\Currency;
use app\models\business\ItemAsset;
use app\models\business\Money;
use yii\bootstrap5\ActiveForm;

class ItemAssetHtmlRenderer extends AssetHtmlRenderer
{
    public function getName(): string
    {
        return 'Предмет';
    }

    public function getFields(Asset $asset, ActiveForm $form): string
    {
        $activeFormHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof ItemAsset);
        ?>
        <?= $form->field($asset, 'name') ?>

        <?= $form->field($asset, 'productionDateFormatted'); ?>

        <h3>Оценка стоимости</h3>
        <h4>Начальная стоимость</h4>
        <?= $activeFormHelper->subField($asset, 'acquisitionCost', 'units') ?>
        <?= $activeFormHelper->subField($asset, 'acquisitionCost', 'currency') ?>

        <h4>Остаточная стоимость</h4>
        <?= $activeFormHelper->subField($asset, 'carryingCost', 'units') ?>
        <?= $activeFormHelper->subField($asset, 'carryingCost', 'currency') ?>

        <h4>Рыночная стоимость</h4>
        <?= $activeFormHelper->subField($asset, 'marketValue', 'units') ?>
        <?= $activeFormHelper->subField($asset, 'marketValue', 'currency') ?>
        <?php
        return ob_get_clean();
    }

    public function fillModel(Asset $asset, $formData)
    {
        assert($asset instanceof ItemAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $asset->setProductionDateFormatted($assetData['productionDateFormatted']);

        $acquisitionCostData = $assetData['acquisitionCost'];
        $asset->acquisitionCost = new Money($acquisitionCostData['units'], new Currency($acquisitionCostData['currency']));

        $estimatedValueData = $assetData['estimatedValue'];
        $asset->estimatedValue = new Money($estimatedValueData['units'], new Currency($estimatedValueData['currency']));

        $marketValueData = $assetData['marketValue'];
        $asset->marketValue = new Money($marketValueData['units'], new Currency($marketValueData['currency']));
    }
}