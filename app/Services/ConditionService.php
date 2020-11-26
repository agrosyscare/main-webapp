<?php namespace App\Services;

use App\Interfaces\ConditionServiceInterface;
use App\Sensor;
use App\User;

class ConditionService implements ConditionServiceInterface
{
    public function getAvailableSensors($reading, $sensorId, $conditionId)
    {
        $query = Sensor::select('settings.min_value', 'settings.max_value', 'greenhouse_sections.name_section', 'environmental_conditions.name')
            ->join('greenhouse_sections', 'sensors.greenhouse_section_id', '=', 'greenhouse_sections.id')
            ->join('settings', 'settings.greenhouse_section_id', '=', 'greenhouse_sections.id')
            ->join('environmental_conditions', 'settings.environmental_condition_id', '=', 'environmental_conditions.id')
            ->where('settings.environmental_condition_id', $conditionId)
            ->where('sensors.environmental_condition_id', $conditionId)
            ->where('sensors.id', $sensorId)
            ->first();

        $minValue = $query->min_value;
        $maxValue = $query->max_value;
        $sectionName = $query->name_section;
        $environmentalConditionName = $query->name;

        if (empty($query) || ($query->min_value == 0 && $query->max_value == 0))
            return [];

        return $this->getReadingStatus($reading, $minValue, $maxValue, $environmentalConditionName, $sectionName);
    }

    private function getReadingStatus($reading, $minValue, $maxValue, $environmentalConditionName, $sectionName)
    {
        if ($reading < $minValue) {
            $status = 'Bajo';
            $this->statusNotification($environmentalConditionName, $sectionName, $status);

        } elseif ($reading > $maxValue) {
            $status = 'Alto';
            $this->statusNotification($environmentalConditionName, $sectionName, $status);

        } else {
            $status = 'Normal';
        }
        return $status;
    }

    private function statusNotification($environmentalConditionName, $sectionName, string $status)
    {
        $recipients = User::whereNotNull('device_token')->pluck('device_token')->toArray();

        fcm()
            ->to($recipients) // $recipients must an array
           ->priority('high')
           ->timeToLive(0)
            ->notification([
                'title' => 'Aviso de Variable fuera de rango',
                'body' => 'La lectura recibida en '.$sectionName.' para la variable '.$environmentalConditionName.' fue registrada como '.$status.'. Favor revisar',
            ])
            ->send();
    }
}

