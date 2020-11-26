<?php

namespace App\Http\Controllers\Api;

use App\GreenhouseSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\GreenhouseSectionServiceInterface;

class GreenhouseSectionController extends Controller
{
    //Listar todos
    public function index(Request $request, GreenhouseSectionServiceInterface $GreenhouseSectionService)
    {
        $greenhouse_id = $request->query('greenhouse_id');
        return $GreenhouseSectionService->getAvailableSections($greenhouse_id);
    }
}
