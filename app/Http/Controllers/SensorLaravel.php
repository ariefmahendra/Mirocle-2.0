<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Msensor;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class SensorLaravel extends Controller
{
    public function detakjantung($id)
    {
        $sensor = Msensor::whereHas('user', function ($query) use ($id) {
            $query->where('id', $id);
        })->latest('id')->first();
        
        return response()->json($sensor);
    }
    
}
