@extends('layouts.pasien.master')

@section('title')
    Riwayat Pasien
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-x">
                        <table class="table-bordered table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Rata Rata Detak Jantung</th>
                                    <th class="text-center">Rata Rata Saturasi Oksigen</th>
                                    <th class="text-center">Kalori Total</th>
                                    <th class="text-center">Jumlah Putaran Pedal</th>
                                    <th class="text-center">Durasi</th>
                                    <th class="text-center">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = ($sensorDataFinal->currentPage() - 1) * $sensorDataFinal->perPage() + 1;
                                @endphp
                                @foreach ($sensorDataFinal as $data)
                                    <tr>
                                        <td class="text-center">{{ $counter++ }}</td>
                                        <td class="text-center">
                                            {{ $data->rata_rata_detak_jantung != 0 ? $data->rata_rata_detak_jantung : '-' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->rata_rata_saturasi_oksigen != 0 ? $data->rata_rata_saturasi_oksigen : '-' }}
                                        </td>
                                        <td class="text-center">{{ $data->kalori_total != 0 ? $data->kalori_total : '-' }}
                                        </td>
                                        <td class="text-center">{{ $data->putaran_pedal != 0 ? $data->putaran_pedal : '-' }}
                                        </td>
                                        <td class="text-center">{{ $data->durasi != 0 ? $data->durasi : '-' }}</td>
                                        <td class="text-center">{{ $data->timestamp }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $sensorDataFinal->links() }}
                        </div>
                    </div>
                    <form method="GET" action="{{ route('pasien.riwayat') }}">
                        <div class="form-group">
                            <label for="tanggal">Pilih Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                    <div class="mt-3">
                        @if (isset($tanggal))
                            <div class="alert alert-info">
                                Menampilkan data untuk tanggal: {{ $tanggal->format('Y-m-d') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
