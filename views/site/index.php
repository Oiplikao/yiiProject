<?php

/** @var yii\web\View $this */
/** @var \app\models\page\IndexModel $model */

use yii\grid\ActionColumn;
use yii\grid\GridView;

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
                    'buttons' => [
                            'view' => function() { return ''; }
                    ]
                ]
            ]
        ]) ?>

    </div>
</div>
