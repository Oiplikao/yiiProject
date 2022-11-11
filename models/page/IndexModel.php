<?php


namespace app\models\page;


use yii\data\DataProviderInterface;

class IndexModel
{
    public DataProviderInterface $assets;
    public array $assetTypes;
}