<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\business\Asset;
use app\models\business\Currency;
use app\models\business\ItemAsset;
use app\models\business\Money;
use app\models\page\AssetSingleModel;
use yii\bootstrap5\ActiveForm;

class ItemAssetHtmlRenderer extends AssetHtmlRenderer
{
    public function getName(): string
    {
        return 'Предмет';
    }

    public function getFields(AssetSingleModel $model, ActiveForm $form): string
    {
        $asset = $model->model;
        $formHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof ItemAsset);
        ?>
        <?= $form->field($asset, 'name') ?>
        <?= $formHelper->quantityInput($asset, 'quantity'); ?>

        <?= $form->field($asset, 'productionDateFormatted'); ?>

        <h3>Оценка стоимости</h3>
        <h4>Начальная стоимость</h4>
        <?= $formHelper->moneyInput($asset, 'acquisitionCost', $model->supportedCurrencies)?>

        <h4>Остаточная стоимость</h4>
        <?= $formHelper->moneyInput($asset, 'carryingCost', $model->supportedCurrencies)?>

        <h4>Рыночная стоимость</h4>
        <?= $formHelper->moneyInput($asset, 'marketValue', $model->supportedCurrencies)?>
        <?php
        return ob_get_clean();
    }

    public function fillModel(Asset $asset, $formData)
    {
        assert($asset instanceof ItemAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $asset->setProductionDateFormatted($assetData['productionDateFormatted']);
        $asset->quantity->measureUnit = $assetData['quantity']['measureUnit'];
        $asset->quantity->value = $assetData['quantity']['value'];

        $acquisitionCostData = $assetData['acquisitionCost'];
        $asset->acquisitionCost = new Money(0, new Currency($acquisitionCostData['currency']));
        $asset->acquisitionCost->setValue($acquisitionCostData['value']);

        $carryingCostData = $assetData['carryingCost'];
        $asset->estimatedValue = new Money(0, new Currency($carryingCostData['currency']));
        $asset->estimatedValue->setValue($carryingCostData['value']);

        $marketValueData = $assetData['marketValue'];
        $asset->marketValue = new Money(0, new Currency($marketValueData['currency']));
        $asset->marketValue->setValue($marketValueData['value']);
    }
}