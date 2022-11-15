<?php


namespace app\models;

use yii\base\Model;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

class ActiveFormHelper
{
    private ActiveForm $form;

    public function __construct(ActiveForm $form)
    {
        $this->form = $form;
    }

    public function subField(Model $model, string $subModelName, string $subName)
    {
        $subModel = $model->$subModelName;
        return $this->form->field($subModel, $subName)->textInput([
            'name' => Html::getInputName($model, $subModelName) . "[$subName]"
        ]);
    }

    public function moneyInput(Model $model,  string $moneyAttributeName)
    {
        ob_start();
        ?>
        <div class="money-field-group mb-3 ">
            <?= $this->form->field($model->$moneyAttributeName, 'currency', ['options' => ['class' => 'money-currency']])
                ->textInput(['name' => \yii\bootstrap5\Html::getInputName($model, $moneyAttributeName) . '[currency]',]); ?>
            <?= $this->form->field($model->$moneyAttributeName, 'units', ['options' => ['class' => 'money-value']])
                ->textInput(['name' => Html::getInputName($model, $moneyAttributeName) . '[units]']); ?>
        </div>
        <?php
        return ob_get_clean();
    }
}