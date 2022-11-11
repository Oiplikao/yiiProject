<?php


namespace app\models\business;


use DateTime;

interface HasProductionDateInterface
{
    public function getProductionDate() : DateTime;
    public function getProductionDateFormat() : string;
    public function getProductionDateFormatted() : string;
}