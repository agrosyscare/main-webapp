<?php

namespace App\Http\Controllers\Api;

use App\EnvironmentalHumidityReading;
use App\Http\Controllers\Controller;
use App\Interfaces\ConditionServiceInterface;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EnvironmentalHumidityReadingController extends Controller
{
    public function index(Request $request)
    {
        $var = $request->greenhouse_section_id;

        $query = EnvironmentalHumidityReading::select(
                'environmental_humidity_readings.id',
                'environmental_humidity_readings.reading',
                'environmental_humidity_readings.status',
                'sensors.greenhouse_section_id'
            )
            ->join('sensors', 'sensors.id', '=', 'environmental_humidity_readings.sensor_id')
            ->where('greenhouse_section_id', '=', $var)
            ->orderByDesc('environmental_humidity_readings.id')
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

        $resultVerification = $conditionService->getAvailableSensors($reading, $sensorId, 2);

        if (empty($resultVerification))
            return response()->json(['success' => false, 'message' => 'Settings view not configured'], 404);

        $request->merge(['status' => $resultVerification]);

        EnvironmentalHumidityReading::create($request->all());

        return response()->json(['success' => true, 'message' => 'Data saved successfully'], 201);
    }
}
