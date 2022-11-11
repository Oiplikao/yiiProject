<?php

/** @var yii\web\View $this */
/** @var \app\models\page\AssetSingleModel $model */

use app\views\site\assets\AssetHtmlRendererFactory;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = "Редактирование - {$model->model->name}";

$form = ActiveForm::begin([
    'id' => 'asset-form',
    'options' => ['class' => 'form-horizontal'],
]);

/** @var \app\models\business\BankAccountAsset $asset */
$asset = $model->model;

$rendererFactory = new AssetHtmlRendererFactory();

$renderer = $rendererFactory->getRendererFor($asset);
echo $renderer->getFields($asset, $form);
?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php
ActiveForm::end();
?>



