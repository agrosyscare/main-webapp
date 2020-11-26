<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    //Listar todos
    public function index()
    {
        return 'publico Status';
    }
}