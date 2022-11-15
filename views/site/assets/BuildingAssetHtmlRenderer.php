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
        $formHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof BuildingAsset);
        ?>
        <?= $form->field($asset, 'name') ?>

        <?= $form->field($asset, 'productionDateFormatted'); ?>

        <?= $form->field($asset, 'inventoryNumber') ?>

        <h3>Адрес</h3>
        <?= $formHelper->subField($asset, 'address', 'country') ?>
        <?= $formHelper->subField($asset, 'address', 'city') ?>
        <?= $formHelper->subField($asset, 'address', 'street') ?>
        <?= $formHelper->subField($asset, 'address', 'house') ?>
        <?= $formHelper->subField($asset, 'address', 'apartment') ?>

        <h3>Оценка стоимости</h3>
        <h4>Начальная стоимость</h4>
        <?= $formHelper->moneyInput($asset, 'acquisitionCost') ?>

        <h4>Оценочная стоимость</h4>
        <?= $formHelper->moneyInput($asset, 'estimatedValue') ?>

        <h4>Остаточная стоимость</h4>
        <?= $formHelper->moneyInput($asset, 'carryingCost') ?>

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