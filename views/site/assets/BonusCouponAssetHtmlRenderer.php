<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\business\Asset;
use app\models\business\BonusCouponsAsset;
use app\models\business\Currency;
use app\models\business\Money;
use app\models\page\AssetSingleModel;
use yii\bootstrap5\ActiveForm;

class BonusCouponAssetHtmlRenderer extends AssetHtmlRenderer
{
    public function getFields(AssetSingleModel $model, ActiveForm $form): string
    {
        $asset = $model->model;
        $formHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof BonusCouponsAsset);
        ?>
        <?= $form->field($asset, 'name') ?>
        <?= $formHelper->moneyInput($asset, 'moneyValue', $model->supportedCurrencies) ?>
        <?php
        return ob_get_clean();
    }

    public function fillModel(Asset $asset, $formData)
    {
        assert($asset instanceof BonusCouponsAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $moneyData = $assetData['moneyValue'];
        $asset->moneyValue = new Money(0, new Currency($moneyData['currency']));
        $asset->moneyValue->setValue($moneyData['value']);
    }
}