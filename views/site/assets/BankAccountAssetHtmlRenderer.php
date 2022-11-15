<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\business\Asset;
use app\models\business\BankAccountAsset;
use app\models\business\Currency;
use app\models\business\Money;
use yii\bootstrap5\ActiveForm;

class BankAccountAssetHtmlRenderer extends AssetHtmlRenderer
{
    /**
     * @param ActiveForm $form
     * @param BankAccountAsset $asset
     * @return string
     */
    public function getFields(Asset $asset, ActiveForm $form): string
    {
        $formHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof BankAccountAsset);
        ?>
        <?= $form->field($asset, 'name') ?>
        <?= $form->field($asset, 'bankID') ?>
        <?= $form->field($asset, 'accountNumber') ?>
        <?= $formHelper->moneyInput($asset, 'moneyValue') ?>
        <?php
        return ob_get_clean();
    }

    /**
     * @param BankAccountAsset $asset
     * @param $formData
     * @throws \yii\base\InvalidConfigException
     */
    public function fillModel(Asset $asset, $formData)
    {
        assert($asset instanceof BankAccountAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $asset->bankID = $assetData['bankID'];
        $asset->accountNumber = $assetData['accountNumber'];
        $moneyData = $assetData['moneyValue'];
        $asset->moneyValue = new Money($moneyData['units'], new Currency($moneyData['currency']));
    }
}