@extends('layouts.fisioterapis.master')

@section('title')
    Riwayat Terapi
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-bordered table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Rata Rata Detak jantung (BPM)</th>
                                <th class="text-center">Rata Rata Saturasi Oksigen (%)</th>
                                <th class="text-center">Jumlah Kalori (KKal)</th>
                                <th class="text-center">Jumlah Putaran Pedal (Putaran)</th>
                                <th class="text-center">Durasi (Menit)</th>
                                <th class="text-center">Dashboard</th>
                                <th class="text-center">Unduh Data Pasien</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sensorDataFinal as $data)
                                <tr>
                                    <td class="text-center">
                                        {{ $data->user->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->timestamp->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->rata_rata_detak_jantung != 0 ? $data->rata_rata_detak_jantung : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->rata_rata_saturasi_oksigen != 0 ? $data->rata_rata_saturasi_oksigen : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->kalori_total != 0 ? $data->kalori_total : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->putaran_pedal != 0 ? $data->putaran_pedal : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->durasi != 0 ? $data->durasi : '-' }}</td>
                                    <td class="text-center">
                                        @if ($data->user)
                                            <a href="{{ route('fisioterapis.monitoring', $data->user->id) }}">Dashboard</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($data->user)
                                            <a href="{{ route('exportExcelPasien', $data->user->id) }}">Unduh</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Tambahkan kode paginasi di bawah tabel -->
                    <div class="d-flex justify-content-center">
                        {{ $sensorDataFinal->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
