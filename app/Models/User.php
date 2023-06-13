<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Profile;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_FISIOTERAPIS = 1;
    const ROLE_PASIEN = 2;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'device_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class)->whereHas('user', function ($query) {
            $query->where('role', self::ROLE_PASIEN);
        });
    }

    public function sensorDataFinal(): HasOne
    {
        return $this->hasOne(sensorDataFinal::class)->whereHas('user', function ($query) {
            $query->where('role', self::ROLE_PASIEN);
        });
    }

    public function sensorData(): HasOne
    {
        return $this->hasOne(sensorData::class)->whereHas('user', function ($query) {
            $query->where('role', self::ROLE_PASIEN);
        });
    }
}
