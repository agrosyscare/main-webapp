<?php namespace App\Interfaces;

interface ConditionServiceInterface
{
    public function getAvailableSensors($reading, $sensorId, $conditionId);
}
