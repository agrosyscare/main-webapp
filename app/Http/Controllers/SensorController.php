<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use App\Arduino;
use App\GreenhouseSection;
use App\EnvironmentalCondition;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensors = Sensor::paginate(5);

        return view('sensors.index', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $environmental_conditions = EnvironmentalCondition::all();
        $greenhouse_sections = GreenhouseSection::all();
        $arduinos = Arduino::all();
        return view('sensors.create', compact('environmental_conditions', 'greenhouse_sections', 'arduinos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'model_sensor' => 'required',
            'serial_sensor' => 'required',
            'environmental_condition_id' => 'required',
            'arduino_id' => 'required',
            'greenhouse_section_id' => 'required'
        ];
        $messages = [
            'model_sensor.required' => 'Es necesario ingresar un modelo',
            'serial_sensor.required' => 'Es necesario ingresar un número de serie',
            'environmental_condition.required' => 'Es necesario asociar una Condicion Ambiental',
            'arduino_id.required' => 'Es necesario asociar un Arduino',
            'greenhouse_section_id.required' => 'Es necesario asociar una Cancha'
        ];
        $this->validate($request, $rules);

        //Inserción
        Sensor::create(
            $request->only('model_sensor', 'serial_sensor','environmental_condition_id', 'arduino_id', 'greenhouse_section_id')
        );

        $notification = 'El sensor se registró correctamente';
        return redirect('/sensors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);
        $environmental_conditions = EnvironmentalCondition::all();
        $environmental_condition_ids = Sensor::find($sensor->id)->environmental_condition_id;
        $arduinos = Arduino::all();
        $arduino_ids = Sensor::find($sensor->id)->arduino_id;
        $greenhouse_sections = GreenhouseSection::all();
        $greenhouse_section_ids = Sensor::find($sensor->id)->greenhouse_section_id;

        return view('sensors.edit', compact('sensor', 'environmental_conditions', 'environmental_condition_ids', 'arduinos', 'arduino_ids', 'greenhouse_sections', 'greenhouse_section_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'model_sensor' => 'required',
            'serial_sensor' => 'required',
            'environmental_condition_id' => 'required',
            'arduino_id' => 'required',
            'greenhouse_section_id' => 'required'
        ];
        $messages = [
            'model_sensor.required' => 'Es necesario ingresar un modelo',
            'serial_sensor.required' => 'Es necesario ingresar un número de serie',
            'environmental_condition.required' => 'Es necesario asociar una Condicion Ambiental',
            'arduino_id.required' => 'Es necesario asociar un Arduino',
            'greenhouse_section_id.required' => 'Es necesario asociar una Cancha'
        ];
        $this->validate($request, $rules);

        //Inserción
        $sensor = Sensor::findOrFail($id);

        $data = $request->only('model_sensor', 'serial_sensor','environmental_condition_id', 'arduino_id', 'greenhouse_section_id');

        $sensor->fill($data);
        $sensor->save();

        $notification = 'El sensor se actualizó correctamente';
        return redirect('/sensors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        $notification = 'El sensor se eliminó correctamente';
        return redirect('/sensors')->with(compact('notification'));
    }
}
