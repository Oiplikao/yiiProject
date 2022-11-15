<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\business\Asset;
use app\models\business\Currency;
use app\models\business\Money;
use app\models\business\MoneyAsset;
use yii\bootstrap5\ActiveForm;

class MoneyAssetHtmlRenderer extends AssetHtmlRenderer
{
    /**
     * @param ActiveForm $form
     * @param MoneyAsset $asset
     * @return string
     */
    public function getFields(Asset $asset, ActiveForm $form): string
    {
        $formHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof MoneyAsset);
        ?>
        <?= $form->field($asset, 'name') ?>
        <?= $formHelper->moneyInput($asset, 'moneyValue') ?>
        <?php
        return ob_get_clean();
    }

    public function fillModel(Asset $asset, $formData)
    {
        assert($asset instanceof MoneyAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $moneyData = $assetData['moneyValue'];
        $asset->moneyValue = new Money($moneyData['units'], new Currency($moneyData['currency']));
    }
}