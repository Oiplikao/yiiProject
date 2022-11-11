<?php

namespace app\views\site\assets;

use app\models\business\Asset;
use yii\bootstrap5\ActiveForm;

abstract class AssetHtmlRenderer
{
    public abstract function getFields(Asset $asset, ActiveForm $form) : string;
    public abstract function fillModel(Asset $asset, $formData);
}