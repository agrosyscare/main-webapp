<?php

namespace App\Http\Controllers\Api;

use App\Greenhouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GreenhouseController extends Controller
{
    //Listar todos
    public function index()
    {
        return Greenhouse::all(['id', 'name_greenhouse']);
    }
}
