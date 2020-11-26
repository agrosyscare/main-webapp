<?php

namespace App\Http\Controllers;

use App\Greenhouse;
use Illuminate\Http\Request;

class GreenhouseController extends Controller
{

    private function performValidation(Request $request)
    {
        $rules = [
            'name' => 'required|min:3'
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre',
            'name.min' => 'El nombre debe tener como minimo 3 caracteres'
        ];
        $this->validate($request, $rules, $messages);
    }

    //Listar todos
    public function index()
    {
        $greenhouses = Greenhouse::all();

        return view('greenhouses.index', compact('greenhouses'));
    }

    //Formulario de creación
    public function create()
    {
        return view('greenhouses.create');
    }

    //Crear
    public function store(Request $request)
    {

        //validaciones
        $this->performValidation($request);

        //Inserción
        $greenhouse = new Greenhouse();
        $greenhouse->name_greenhouse = $request->input('name');
        $greenhouse->description = $request->input('description');
        $greenhouse->save(); //INSERT A LA TABLA


        $notification = 'El invernadero se registró correctamente';
        return redirect('/greenhouses')->with(compact('notification'));
    }


    //Editar un valor
    public function edit(Greenhouse $greenhouse)
    {
        return view('greenhouses.edit', compact('greenhouse'));
    }

    //Actualiza un valor
    public function update(Request $request, Greenhouse $greenhouse)
    {
        //validaciones
        $this->performValidation($request);

        $greenhouse->name_greenhouse = $request->input('name');
        $greenhouse->description = $request->input('description');
        $greenhouse->save(); // UPDATE

        $notification = 'La especialidad se actualizó correctamente';
        return redirect('/greenhouses')->with(compact('notification'));
    }

    //Elimina un valor
    public function destroy(Greenhouse $greenhouse)
    {
        $greenhouse->delete();
        $notification = 'La especialidad se eliminó correctamente';
        return redirect('/greenhouses')->with(compact('notification'));
    }
}
