<?php

namespace app\models\business;

use yii\base\Model;

abstract class Asset extends Model implements AssetInterface
{
    public string $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public abstract static function getType() : string;

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'type' => 'Тип'
        ];
    }
}
