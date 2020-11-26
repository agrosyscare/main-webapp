<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
	private $environmentalConditions = [
		'Temperatura', 'Humedad ambiental', 'Humedad radicular'
	];

    public function edit($id)
    {

		$settings = Setting::where('greenhouse_section_id', $id)->get();

		$environmentalConditions = $this->environmentalConditions;
		return view('setting', compact('settings', 'environmentalConditions', 'id'));
    }

    public function store(Request $request)
    {
		$min_value = $request->input('min_value');
		$max_value = $request->input('max_value');
		$greenhouse_section = $request->input('greenhouse_section_id');

		$errors = [];
		
		for ($i=0; $i < 3; $i++) { 

			if ($min_value[$i] > $max_value[$i]) {
				$errors[] = 'Los límites ingresados en '.$this->environmentalConditions[$i].' son inconsistentes';
			} 
			
			Setting::updateOrCreate(
				[
					'environmental_condition_id' => $i+1,
					'greenhouse_section_id' => $greenhouse_section
				], 
				[
					'min_value' => $min_value[$i], 
					'max_value' => $max_value[$i] 
				]);
		}

		if (count($errors) > 0) {
			return back()->with(compact('errors'));
		}

		$notification = "Los datos ingresados se guardaron correctamente";
		return back()->with(compact('notification'));
    }
}
