<?php


namespace app\views\site\assets;


use app\models\ActiveFormHelper;
use app\models\business\Asset;
use app\models\business\BankAccountAsset;
use app\models\business\Currency;
use app\models\business\Money;
use app\models\page\AssetSingleModel;
use yii\bootstrap5\ActiveForm;

class BankAccountAssetHtmlRenderer extends AssetHtmlRenderer
{
    /**
     * @param AssetSingleModel $model
     * @param ActiveForm $form
     * @return string
     */
    public function getFields(AssetSingleModel $model, ActiveForm $form): string
    {
        $asset = $model->model;
        $formHelper = new ActiveFormHelper($form);
        ob_start();
        assert($asset instanceof BankAccountAsset);
        ?>
        <?= $form->field($asset, 'name') ?>
        <?= $form->field($asset, 'bankID') ?>
        <?= $form->field($asset, 'accountNumber') ?>
        <?= $formHelper->moneyInput($asset, 'moneyValue', $model->supportedCurrencies) ?>
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
        $asset->moneyValue = new Money(0, new Currency($moneyData['currency']));
        $asset->moneyValue->setValue($moneyData['value']);
    }
}