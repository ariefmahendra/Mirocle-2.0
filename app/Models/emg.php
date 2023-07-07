<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emg extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'emg';
    protected $primaryKey = 'id';
    protected $fillable = ['amplitudo_awal', 'amplitudo_akhir', 'timestamp'];
}
