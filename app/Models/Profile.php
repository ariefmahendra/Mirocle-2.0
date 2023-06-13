<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    const PASIEN_LAKI_LAKI = 1;
    const PASIEN_PEREMPUAN = 2;

    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'umur',
        'berat_badan',
        'jenis_kelamin',
        'riwayat_penyakit',
    ];

    public function user(): BelongsTo
    {   
        return $this->belongsTo(User::class)->where('role', 2);
    }
    
    public static function getPilihanJenisKelamin(): array
    {
        return [
            1 => 'Laki-laki',
            2 => 'Perempuan',
        ];
    }
}