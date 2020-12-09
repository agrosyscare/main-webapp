<?php

namespace App\Http\Controllers;

use App\GreenhouseSection;
use App\Greenhouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GreenhouseSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $greenhouse_sections = GreenhouseSection::paginate(5);

        return view('greenhouse-sections.index', compact('greenhouse_sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $greenhouses = Greenhouse::all();
        return view('greenhouse-sections.create', compact('greenhouses'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name_section' => 'required',
            'planting_type' => 'required',
            'greenhouse_id' => 'required',
        ];
        $messages = [
            'name_section.required' => 'Es necesario ingresar un nombre',
            'name_section.required' => 'Es necesario ingresar un tipo de plantacion',
            'greenhouse_id.required' => 'Debe escoger un invernadero'
        ];
        $this->validate($request, $rules);

        //Inserción
        GreenhouseSection::create(
            $request->only('name_section', 'planting_type', 'greenhouse_id')
        );

        $notification = 'La cancha se registró correctamente';
        return redirect('/greenhouse-sections')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $greenhouse_section = GreenhouseSection::findOrFail($id);
        $greenhouses = Greenhouse::all();
        $greenhouse_ids = GreenhouseSection::find($greenhouse_section->id)->greenhouse_id;

        return view('greenhouse-sections.edit', compact('greenhouse_section', 'greenhouses', 'greenhouse_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_section' => 'required',
            'planting_type' => 'required',
            'greenhouse_id' => 'required',
        ];
        $messages = [
            'name_section.required' => 'Es necesario ingresar un nombre',
            'name_section.required' => 'Es necesario ingresar un tipo de plantacion',
            'greenhouse_id.required' => 'Debe escoger un invernadero'
        ];
        $this->validate($request, $rules);

        //Inserción
        $greenhouse_section = GreenhouseSection::findOrFail($id);

        $data = $request->only('name_section', 'planting_type', 'greenhouse_id');

        $greenhouse_section->fill($data);
        $greenhouse_section->save();

        $notification = 'La cancha se actualizó correctamente';
        return redirect('/greenhouse-sections')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(GreenhouseSection $greenhouse_section)
    {
        $greenhouse_section->delete();

        $notification = 'La cancha se eliminó correctamente';
        return redirect('/greenhouse-sections')->with(compact('notification'));
    }
}
