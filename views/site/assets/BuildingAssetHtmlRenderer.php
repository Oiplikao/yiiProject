<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\Address;
use app\models\business\Asset;
use app\models\business\BuildingAsset;
use app\models\business\Currency;
use app\models\business\Money;
use yii\bootstrap5\ActiveForm;

class BuildingAssetHtmlRenderer extends AssetHtmlRenderer
{
    /**
     * @param ActiveForm $form
     * @param BuildingAsset $asset
     * @return string
     */
    public function getFields(Asset $asset, ActiveForm $form): string
    {
        $activeFormHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof BuildingAsset);
        ?>
        <?= $form->field($asset, 'name') ?>

        <?= $form->field($asset, 'productionDateFormatted'); ?>

        <?= $form->field($asset, 'inventoryNumber') ?>

        <h3>Адрес</h3>
        <?= $activeFormHelper->subField($asset, 'address', 'country') ?>
        <?= $activeFormHelper->subField($asset, 'address', 'city') ?>
        <?= $activeFormHelper->subField($asset, 'address', 'street') ?>
        <?= $activeFormHelper->subField($asset, 'address', 'house') ?>
        <?= $activeFormHelper->subField($asset, 'address', 'apartment') ?>

        <h3>Оценка стоимости</h3>
        <h4>Начальная стоимость</h4>
        <?= $activeFormHelper->subField($asset, 'acquisitionCost', 'units') ?>
        <?= $activeFormHelper->subField($asset, 'acquisitionCost', 'currency') ?>

        <h4>Оценочная стоимость</h4>
        <?= $activeFormHelper->subField($asset, 'estimatedValue', 'units') ?>
        <?= $activeFormHelper->subField($asset, 'estimatedValue', 'currency') ?>

        <h4>Остаточная стоимость</h4>
        <?= $activeFormHelper->subField($asset, 'carryingCost', 'units') ?>
        <?= $activeFormHelper->subField($asset, 'carryingCost', 'currency') ?>

        <?php
        return ob_get_clean();
    }

    public function fillModel(Asset $asset, $formData)
    {
        assert($asset instanceof BuildingAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $asset->inventoryNumber = $assetData['inventoryNumber'];
        $asset->setProductionDateFormatted($assetData['productionDateFormatted']);

        $addressData = $assetData['address'];
        $asset->address = new Address($addressData);
        $acquisitionCostData = $assetData['acquisitionCost'];
        $asset->acquisitionCost = new Money($acquisitionCostData['units'], new Currency($acquisitionCostData['currency']));

        $estimatedValueData = $assetData['estimatedValue'];
        $asset->estimatedValue = new Money($estimatedValueData['units'], new Currency($estimatedValueData['currency']));

        $carryingCostData = $assetData['carryingCost'];
        $asset->carryingCost = new Money($carryingCostData['units'], new Currency($carryingCostData['currency']));
    }
}