<?php


namespace app\views\site\assets;


use app\models\business\Asset;
use app\models\business\BonusCouponsAsset;
use app\models\business\Currency;
use app\models\business\Money;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

class BonusCouponAssetHtmlRenderer extends AssetHtmlRenderer
{
    public function getFields(Asset $asset, ActiveForm $form): string
    {
        ob_start();
        assert($asset instanceof BonusCouponsAsset);
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
        assert($asset instanceof BonusCouponsAsset);
        $assetData = $formData[$asset->formName()];
        $asset->name = $assetData['name'];
        $moneyData = $assetData['moneyValue'];
        $asset->moneyValue = new Money($moneyData['units'], new Currency($moneyData['currency']));
    }
}