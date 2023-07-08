<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Exports\DataFinal;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\SensorDataFinal;
use Carbon\Carbon;

class PasienController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $user = User::query()->where('id', $userId)->first();
        $profile = Profile::query()->where('user_id', '=', Auth::user()->id)->first();
        $sensorData = SensorDataFinal::whereHas('user', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        $labels = [];
        $totalTerapi = [];
        foreach ($sensorData as $data) {
            $timestamp = $data->timestamp;
            $bulan = date('Y-m', strtotime($timestamp));
            if (!in_array($bulan, $labels)) {
                $labels[] = $bulan;
            }
            $jumlahTerapi = SensorDataFinal::where('user_id', $userId)
                ->whereMonth('timestamp', date('m', strtotime($timestamp)))
                ->whereYear('timestamp', date('Y', strtotime($timestamp)))
                ->count();
            $totalTerapi[] = $jumlahTerapi;
        }
        return view('layouts.pasien.dashboard', [
            'profile' => $profile,
            'labels' => $labels,
            'totalTerapi' => $totalTerapi
        ]);
    }

    public function biodata()
    {
        return view('layouts.pasien.biodata');
    }

    public function grafik()
    {
        return view('layouts.pasien.grafik');
    }

    public function riwayat(Request $request)
    {
        $userId = auth()->user()->id;
        $tanggal = $request->input('tanggal');
        $query = SensorDataFinal::whereHas('user', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
        if ($tanggal) {
            $tanggal = Carbon::parse($tanggal);
            $query->whereDate('timestamp', $tanggal);
        }
        $sensorDataFinal = $query->simplePaginate(10);
        return view('layouts.pasien.riwayat', compact('sensorDataFinal', 'tanggal'));
    }
    public function detakJantung()
    {
        $data = [
            'timestamp' => now(),
            'detak_jantung' => rand(60, 100),
        ];
        return response()->json($data);
    }

    public function update_profile(Request $request)
    {
        Profile::query()->firstOrCreate([
            'user_id' => Auth::user()->id,
            'umur' => $request->umur,
            'berat_badan' => $request->berat_badan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'riwayat_penyakit' => $request->riwayat_penyakit,
        ]);
        return redirect('/pasien/data')->with('Success', 'Data berhasil Diupdate');
    }
    public function dashboard()
    {
        // Ambil data detak jantung terbaru dari session
        $detakJantung = session('detakjantung');
        return view('/layouts/pasien/dashboard', compact('detakJantung'));
    }

    public function exportexcel()
    {
        $userId = auth()->user()->id;
        $fileName = 'data_final.xlsx';
        return Excel::download(new DataFinal($userId), $fileName);
    }

    public function otot()
    {
        return view('layouts.pasien.otot');
    }
}
