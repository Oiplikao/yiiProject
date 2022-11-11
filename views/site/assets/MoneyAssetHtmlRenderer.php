<?php


namespace app\views\site\assets;


use app\models\business\Asset;
use app\models\business\Currency;
use app\models\business\Money;
use app\models\business\MoneyAsset;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

class MoneyAssetHtmlRenderer extends AssetHtmlRenderer
{
    /**
     * @param ActiveForm $form
     * @param MoneyAsset $asset
     * @return string
     */
    public function getFields(Asset $asset, ActiveForm $form): string
    {
        ob_start();
        assert($asset instanceof MoneyAsset);
        ?>
        <?= $form->field($asset, 'name') ?>
        <?= $form->field($asset->moneyValue, 'units')->textInput([
        'name' => Html::getInputName($asset, 'moneyValue') . '[units]'
    ]); ?>
        <?= $form->field($asset->moneyValue, 'currency')->textInput([
        'name' => Html::getInputName($asset, 'moneyValue') . '[currency]'
    ]); ?>
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