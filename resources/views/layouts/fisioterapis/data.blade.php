@extends('layouts.fisioterapis.master')

@section('title')
    Data Pasien
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Umur</th>
                                        <th class="text-center">Berat Badan</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Riwayat Penyakit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->profile->umur ?? '-' }} th</td>
                                            <td class="text-center">{{ $user->profile->berat_badan ?? '-' }} Kg</td>
                                            <td class="text-center">
                                                @if ($user->profile && $user->profile->jenis_kelamin == \App\Models\Profile::PASIEN_LAKI_LAKI)
                                                    Laki-laki
                                                @elseif ($user->profile && $user->profile->jenis_kelamin == \App\Models\Profile::PASIEN_PEREMPUAN)
                                                    Perempuan
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->profile->riwayat_penyakit ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
