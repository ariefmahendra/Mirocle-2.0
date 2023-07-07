<?php

namespace App\Http\Controllers;

use App\Models\emg;
use App\Models\Msensor;

class SensorLaravel extends Controller
{
    public function detakjantung($id)
    {
        $data = Msensor::orderBy('id', 'desc')->take(5)->get();
        // dd($data);
        return response()->json($data);
    }
    public function otot($id)
    {
        $data = emg::orderBy('id', 'desc')->take(5)->get();
        // dd($data);

        return response()->json($data);
    }
}
