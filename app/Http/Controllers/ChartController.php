<?php

namespace App\Http\Controllers;

use App\GreenhouseSection;
use App\Sensor;
use App\TemperatureReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function temperatures()
    {
//        $weeklyAverages = TemperatureReading::select(
//            DB::raw('DAYOFWEEK(temperature_readings.created_at) as day'),
//            DB::raw('ROUND(AVG(temperature_readings.reading), 1) as average'))
//            ->join('sensors','sensors.id','=','temperature_readings.sensor_id')
//            ->join('greenhouse_sections','greenhouse_sections.id','=','sensors.greenhouse_section_id')
////            ->where('greenhouse_sections.name_section', '=', '$greenhouseSection')
//            ->groupBy('day')
//            ->get()
//            ->toArray();
//
//        $averages = array_fill(0,7,0);
//
//        foreach ($weeklyAverages as $weeklyAverage)
//        {
//            $index = $weeklyAverage['day'] - 1;
//            $averages[$index] = $weeklyAverage['average'];
//        }
//
//        dd($averages);
//
        return view('charts.temperatures');
    }

    public function temperaturesJson()
    {
        $sections = GreenhouseSection::all()->pluck('name_section');

        foreach ($sections as $key => $section) {
            $index = $key + 1;
            $readings = TemperatureReading::select(
                DB::raw('DAYOFWEEK(temperature_readings.created_at) as day'),
                DB::raw('ROUND(AVG(temperature_readings.reading), 1) as average'))
                ->join('sensors', 'sensors.id', '=', 'temperature_readings.sensor_id')
                ->where('greenhouse_section_id', $index)
                ->where('environmental_condition_id', 1)
                ->groupBy('day')
                ->get()
                ->toArray();

            $averages = array_fill(0, 7, 0);

            foreach ($readings as $reading) {
                $index = $reading['day'] - 1;
                $averages[$index] = $reading['average'];
            }

            $data = [];
            $data['name'] = $section;
            $data['data'] = $averages;
            $graph[] = $data;
        }

        return $graph;
    }
}
