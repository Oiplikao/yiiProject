<?php

/** @var yii\web\View $this */
/** @var \app\models\page\IndexModel $model */

use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Список активов</h1>
    </div>

    <div class="body-content">

        <?= GridView::widget([
            'dataProvider' => $model->assets,
            'columns' => [
                'name',
                'type',
                [
                    'class' => ActionColumn::class,
                    'visibleButtons' => [
                        'view' => false,
                        'delete' => false
                    ]
                ]
            ]
        ]) ?>

        <div class="form-group">
            <form method="get" action="<?= $a = Url::to(['site/create'])?>">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Добавить актив', ['class' => 'btn btn-primary']) ?>
                    <?= Html::hiddenInput(Yii::$app->urlManager->routeParam, 'site/create')?>
                    <?= Html::dropDownList('assetType', reset($model->assetTypes), array_combine($model->assetTypes, $model->assetTypes)) ?>
                </div>
            </form>
        </div>

    </div>
</div>
