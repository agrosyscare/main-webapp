<?php

namespace App\Http\Controllers;

use App\Arduino;
use Illuminate\Http\Request;

class ArduinoController extends Controller
{
    private function performValidation(Request $request)
    {
        $rules = [
            'model' => 'required|min:3',
            'serial' => 'required|min:3'
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un modelo',
            'name.min' => 'El modelo debe tener como minimo 3 caracteres',
            'serial.required' => 'Es necesario ingresar un número de serie',
            'serial.min' => 'El número de serie debe tener como minimo 3 caracteres'
        ];
        $this->validate($request, $rules, $messages);
    }

    //Listar todos
    public function index()
    {
        $arduinos = Arduino::all();

        return view('arduinos.index', compact('arduinos'));
    }

    //Formulario de creación
    public function create()
    {
        return view('arduinos.create');
    }

    //Crear
    public function store(Request $request)
    {

        //validaciones
        $this->performValidation($request);

        //Inserción
        $arduino = new Arduino();
        $arduino->model_arduino = $request->input('model');
        $arduino->serial_arduino = $request->input('serial');
        $arduino->save(); //INSERT A LA TABLA


        $notification = 'El dispositivo Arduino se registró correctamente';
        return redirect('/arduinos')->with(compact('notification'));
    }


    //Editar un valor
    public function edit(Arduino $arduino)
    {
        return view('arduinos.edit', compact('arduino'));
    }

    //Actualiza un valor
    public function update(Request $request, Arduino $arduino)
    {
        //validaciones
        $this->performValidation($request);

        $arduino->model_arduino = $request->input('model');
        $arduino->serial_arduino = $request->input('serial');
        $arduino->save(); // UPDATE

        $notification = 'El dispositivo Arduino se actualizó correctamente';
        return redirect('/arduinos')->with(compact('notification'));
    }

    //Elimina un valor
    public function destroy(Arduino $arduino)
    {
        $arduino->delete();
        $notification = 'El dispositivo Arduino se eliminó correctamente';
        return redirect('/arduinos')->with(compact('notification'));
    }
}
