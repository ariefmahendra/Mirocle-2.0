<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Exports\DataFinal;
use App\Exports\DataFinalPasien;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SensorData;
use App\Models\User;
use App\Models\SensorDataFinal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;


class PasienController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = auth()->user()->id;

        // Periksa profil pengguna
        $user = User::query()->where('id', $userId)->first();
    
        $profile = Profile::query()->where('user_id', '=', Auth::user()->id)->first();

        $sensorData = SensorDataFinal::whereHas('user', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        // Inisialisasi array untuk label dan jumlah terapi
        $labels = [];
        $totalTerapi = [];
        // Loop melalui setiap data sensor
        foreach ($sensorData as $data) {
            // Ambil timestamp
            $timestamp = $data->timestamp;
            // Ambil bulan dari timestamp
            $bulan = date('Y-m', strtotime($timestamp));
            // Jika bulan belum ada dalam array labels, tambahkan ke array labels
            if (!in_array($bulan, $labels)) {
                $labels[] = $bulan;
            }
            // Hitung jumlah terapi berdasarkan bulan
            $jumlahTerapi = SensorDataFinal::where('user_id', $userId)
                ->whereMonth('timestamp', date('m', strtotime($timestamp)))
                ->whereYear('timestamp', date('Y', strtotime($timestamp)))
                ->count();
            // Tambahkan jumlah terapi ke array totalTerapi
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

    public function otot()
    {
        return view('layouts.pasien.otot');
    }

    public function riwayat(Request $request)
    {
        $userId = auth()->user()->id; // Ambil ID pengguna yang sedang login
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
        // Logika untuk mendapatkan data detak jantung dari database atau sumber data lainnya
        $data = [
            'timestamp' => now(),
            'detak_jantung' => rand(60, 100), // Contoh data detak jantung acak
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
        return redirect('/pasien');
    }
    public function dashboard()
    {
        // Ambil data detak jantung terbaru dari session
        $detakJantung = session('detakjantung');
        return view('/layouts/pasien/dashboard', compact('detakJantung'));
    }
    
    public function exportexcel()
    {
        $userId = auth()->user()->id; // Ambil ID pengguna yang sedang login
        $fileName = 'data_final.xlsx';
        return Excel::download(new DataFinal($userId), $fileName);
    }   
}