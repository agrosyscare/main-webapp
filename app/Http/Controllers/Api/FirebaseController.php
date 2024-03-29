<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseController extends Controller
{
    public function postToken(Request $request)
    {

        $user = Auth::guard('api')->user();
        if ($request->input('device_token')) {
            $user->device_token = $request->input('device_token');
            $user->save();
        }
    }
}
