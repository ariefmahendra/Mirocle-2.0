<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msensor extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected $table = 'sensor_data';
    protected $primaryKey = 'id';
    protected $fillable = ['detak_jantung', 'durasi', 'saturasi_oksigen','putaran_pedal', 'kalori', 'timestamp'];
}
