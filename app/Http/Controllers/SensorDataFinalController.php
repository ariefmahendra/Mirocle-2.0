<?php

namespace App\Http\Controllers;

use App\Models\SensorDataFinal;
use App\Http\Requests\StoreSensorDataFinalRequest;
use App\Http\Requests\UpdateSensorDataFinalRequest;

class SensorDataFinalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSensorDataFinalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSensorDataFinalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SensorDataFinal  $sensorDataFinal
     * @return \Illuminate\Http\Response
     */
    public function show(SensorDataFinal $sensorDataFinal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SensorDataFinal  $sensorDataFinal
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorDataFinal $sensorDataFinal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSensorDataFinalRequest  $request
     * @param  \App\Models\SensorDataFinal  $sensorDataFinal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSensorDataFinalRequest $request, SensorDataFinal $sensorDataFinal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SensorDataFinal  $sensorDataFinal
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorDataFinal $sensorDataFinal)
    {
        //
    }
    
}
