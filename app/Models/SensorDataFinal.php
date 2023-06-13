<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SensorDataFinal extends Model
{
    use HasFactory;
    
    protected $table = 'sensor_data_final';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
