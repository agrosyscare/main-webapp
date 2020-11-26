<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ConditionServiceInterface;
use App\TemperatureReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TemperatureReadingController extends Controller
{
    public function index(Request $request)
    {
        $var = $request->greenhouse_section_id;

        $query = TemperatureReading::select(
            'temperature_readings.id',
            'temperature_readings.reading',
            'temperature_readings.status',
            'sensors.greenhouse_section_id'
        )
            ->join('sensors', 'sensors.id', '=', 'temperature_readings.sensor_id')
            ->where('greenhouse_section_id', '=', $var)
            ->orderByDesc('temperature_readings.id')
            ->limit(1)
            ->first();


        return response()->json($query, 200);
    }

    public function store(Request $request, ConditionServiceInterface $conditionService)
    {
        $rules =[
            'reading' => 'required',
            'sensor_id' => 'exists:sensors,id'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Data not valid', 'data' => $validator->errors()], 400);
        }

        $reading = $request->reading;
        $sensorId = $request->sensor_id;

        $resultVerification = $conditionService->getAvailableSensors($reading, $sensorId, 1);

        if (empty($resultVerification))
            return response()->json(['success' => false, 'message' => 'Settings view not configured'], 404);

        $request->merge(['status' => $resultVerification]);

        TemperatureReading::create($request->all());

        return response()->json(['success' => true, 'message' => 'Data saved successfully'], 201);
    }
}
