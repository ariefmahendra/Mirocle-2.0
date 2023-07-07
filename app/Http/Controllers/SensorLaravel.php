<?php

namespace App\Http\Controllers;

use App\Models\emg;
use App\Models\Msensor;

class SensorLaravel extends Controller
{
    public function detakjantung($id)
    {
        $sensor = Msensor::whereHas('user', function ($query) use ($id) {
            $query->where('id', $id);
        })->latest('id')->first();

        return response()->json($sensor);
    }
    public function otot($id)
    {
        $data = emg::orderBy('id', 'desc')->take(5)->get();
        // dd($data);

        return response()->json($data);
    }
}
