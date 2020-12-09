<?php

namespace App\Http\Controllers;

use App\EnvironmentalHumidityReading;
use App\GreenhouseSection;
use App\ReticularHumidityReading;
use App\TemperatureReading;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function temperatures()
    {
        $temperatures = TemperatureReading::all()
            ->sortByDesc('created_at')
            ->take(10);

        $temperatures->map(function ($temperature) {
            $temperature->created_at = new Carbon($temperature->created_at, 'America/Santiago');
            return $temperature;
        });

        $data = TemperatureReading::all(
            DB::raw('ROUND(AVG(reading), 2) as average'),
            DB::raw('MIN(reading) as minimum'),
            DB::raw('MAX(reading) as maximum'))
            ->sortByDesc('created_at')
            ->take(10);

        return view('charts.temperatures', compact('temperatures', 'data'));
    }

    public function temperaturesJson(): array
    {
        $sections = GreenhouseSection::all()->pluck('name_section');

        foreach ($sections as $key => $section) {
            $index = $key + 1;
            $readings = TemperatureReading::select(
                DB::raw('DAYOFWEEK(temperature_readings.created_at) as day'),
                DB::raw('ROUND(AVG(temperature_readings.reading), 1) as average'),
                DB::raw('date(temperature_readings.created_at) as register'))
                ->join('sensors', 'sensors.id', '=', 'temperature_readings.sensor_id')
                ->where('greenhouse_section_id', $index)
                ->where('environmental_condition_id', 1)
                ->groupBy('day', 'register')
                ->orderBy('register', 'DESC')
                ->take(7)
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

    public function environmentalHumidities()
    {
        $envHumidities = EnvironmentalHumidityReading::all()
            ->sortByDesc('created_at')
            ->take(10);

        $envHumidities->map(function ($envHumidity) {
            $envHumidity->created_at = new Carbon($envHumidity->created_at, 'America/Santiago');
            return $envHumidity;
        });

        $data = EnvironmentalHumidityReading::all(
            DB::raw('ROUND(AVG(reading), 2) as average'),
            DB::raw('MIN(reading) as minimum'),
            DB::raw('MAX(reading) as maximum'))
            ->sortByDesc('created_at')
            ->take(10);

        return view('charts.environmental-humidities', compact('envHumidities', 'data'));
    }

    public function environmentalHumiditiesJson(): array
    {
        $sections = GreenhouseSection::all()->pluck('name_section');

        foreach ($sections as $key => $section) {
            $index = $key + 1;
            $readings = EnvironmentalHumidityReading::select(
                DB::raw('DAYOFWEEK(environmental_humidity_readings.created_at) as day'),
                DB::raw('ROUND(AVG(environmental_humidity_readings.reading), 1) as average'),
                DB::raw('date(environmental_humidity_readings.created_at) as register'))
                ->join('sensors', 'sensors.id', '=', 'environmental_humidity_readings.sensor_id')
                ->where('greenhouse_section_id', $index)
                ->where('environmental_condition_id', 2)
                ->groupBy('day', 'register')
                ->orderBy('register', 'DESC')
                ->take(7)
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

    public function reticularHumidities()
    {
        $retHumidities = ReticularHumidityReading::all()
            ->sortByDesc('created_at')
            ->take(10);

        $retHumidities->map(function ($retHumidity) {
            $retHumidity->created_at = new Carbon($retHumidity->created_at, 'America/Santiago');
            return $retHumidity;
        });

        $data = ReticularHumidityReading::all(
            DB::raw('ROUND(AVG(reading), 2) as average'),
            DB::raw('MIN(reading) as minimum'),
            DB::raw('MAX(reading) as maximum'))
            ->sortByDesc('created_at')
            ->take(10);

        return view('charts.reticular-humidities', compact('retHumidities', 'data'));
    }

    public function reticularHumiditiesJson(): array
    {
        $sections = GreenhouseSection::all()->pluck('name_section');

        foreach ($sections as $key => $section) {
            $index = $key + 1;
            $readings = ReticularHumidityReading::select(
                DB::raw('DAYOFWEEK(reticular_humidity_readings.created_at) as day'),
                DB::raw('ROUND(AVG(reticular_humidity_readings.reading), 1) as average'),
                DB::raw('date(reticular_humidity_readings.created_at) as register'))
                ->join('sensors', 'sensors.id', '=', 'reticular_humidity_readings.sensor_id')
                ->where('greenhouse_section_id', $index)
                ->where('environmental_condition_id', 3)
                ->groupBy('day', 'register')
                ->orderBy('register', 'DESC')
                ->take(7)
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
