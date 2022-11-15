<?php


namespace app\models;

use app\models\business\Quantity;
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

    public function moneyInput(Model $model, string $moneyAttributeName, array $supportedCurrencies)
    {
        ob_start();
        ?>
        <div class="field-group mb-3 ">
            <?= $this->form->field($model->$moneyAttributeName, 'units', ['options' => ['class' => 'money-value']])
                ->textInput(['name' => Html::getInputName($model, $moneyAttributeName) . '[units]']); ?>
            <?= $this->form->field($model->$moneyAttributeName, 'currency', ['options' => ['class' => 'money-currency']])
                ->dropDownList(
                    array_combine($supportedCurrencies, $supportedCurrencies),
                    ['name' => \yii\bootstrap5\Html::getInputName($model, $moneyAttributeName) . '[currency]',]
                ); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    public function quantityInput(Model $model, string $quantityAttributeName) : string
    {
        ob_start();
        ?>
        <div class="field-group mb-3 ">
            <?= $this->form->field($model->$quantityAttributeName, 'value', ['options' => ['class' => 'money-value']])
                ->textInput(['name' => Html::getInputName($model, $quantityAttributeName) . '[value]']); ?>
            <?= $this->form->field($model->$quantityAttributeName, 'measureUnit', ['options' => ['class' => 'money-currency']])
                ->dropDownList(Quantity::MEASURE_UNITS, ['name' => \yii\bootstrap5\Html::getInputName($model, $quantityAttributeName) . '[measureUnit]']); ?>
        </div>
        <?php
        return ob_get_clean();
    }
}