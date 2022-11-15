<?php

namespace app\views\site\assets;

use app\models\business\Asset;
use app\models\page\AssetSingleModel;
use yii\bootstrap5\ActiveForm;

abstract class AssetHtmlRenderer
{
    public abstract function getFields(AssetSingleModel $model, ActiveForm $form) : string;
    public abstract function fillModel(Asset $asset, $formData);
}