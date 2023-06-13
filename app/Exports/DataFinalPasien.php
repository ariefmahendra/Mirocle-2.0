<?php

namespace App\Exports;

use App\Models\SensorDataFinal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataFinalPasien implements FromQuery, WithHeadings, ShouldQueue
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function query()
    {
        return SensorDataFinal::select('waktu_mulai', 'waktu_selesai', 'rata_rata_detak_jantung', 'rata_rata_saturasi_oksigen', 'kalori_total', 'putaran_pedal', 'durasi')
            ->where('user_id', $this->userId);
    }

    public function headings(): array
    {
        return ['Waktu Mulai', 'Waktu Selesai', 'Rata-rata Detak Jantung (BPM)','Rata-rata Saturasi Oksigen (%)', 'Kalori Total (Kcal)', 'Putaran Pedal (Kali)', 'Durasi (Detik)'];
    }
}
