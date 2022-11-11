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
}