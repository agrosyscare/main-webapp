<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ConditionServiceInterface;
use App\ReticularHumidityReading;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReticularHumidityReadingController extends Controller
{
    public function index(Request $request)
    {
        $var = $request->greenhouse_section_id;

        $query = ReticularHumidityReading::select(
                'reticular_humidity_readings.id',
                'reticular_humidity_readings.reading',
                'reticular_humidity_readings.status',
                'sensors.greenhouse_section_id'
            )
            ->join('sensors', 'sensors.id', '=', 'reticular_humidity_readings.sensor_id')
            ->where('greenhouse_section_id', '=', $var)
            ->orderByDesc('reticular_humidity_readings.id')
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

        $resultVerification = $conditionService->getAvailableSensors($reading, $sensorId, 3);

        if (empty($resultVerification))
            return response()->json(['success' => false, 'message' => 'Settings view not configured'], 404);

        $request->merge(['status' => $resultVerification]);
        ReticularHumidityReading::create($request->all());

        return response()->json(['success' => true, 'message' => 'Data saved successfully'], 201);
    }
}
