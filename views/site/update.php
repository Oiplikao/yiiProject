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
echo $renderer->getFields($model, $form);
?>

<?php
ActiveForm::end();
?>

<div class="form-group row">
    <div class="col-auto me-auto">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'form' => 'asset-form']) ?>
    </div>
    <?php if(!$model->isNew) { ?>
    <div class="col-auto">
        <?= Html::beginForm() ?>
            <?= Html::submitButton('Удалить', ['class' => 'btn btn-danger', 'name' => 'delete', 'value' => 'true'])?>
        <?= Html::endForm(); ?>
    </div>
    <?php } ?>
</div>





