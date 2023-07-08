@extends('layouts.pasien.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Content Row -->
            <div class="row w-100 justify-content-center">
                <!-- Detak jantung -->
                <div class="col-auto mb-4">
                    <div class="card border-left-primary shadowy">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs"> Detak Jantung
                                    </div>
                                    <div class="h5 font-weight-bold mb-0 text-gray-800"> <span
                                            id="detak_jantung">{{ $detak_jantung ?? '-' }}</span> BPM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Durasi -->
                <div class="col-auto mb-4">
                    <div class="card border-left-warning shadowy">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="font-weight-bold text-warning text-uppercase mb-1 text-xs">
                                        Durasi</div>
                                    <div class="h5 font-weight-bold mb-0 text-gray-800"> <span
                                            id="jumlah_detak_jantung">{{ $durasi ?? '-' }}</span> Detik</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Saturasi Oksigen -->
                <div class="col-auto mb-4">
                    <div class="card border-left-info shadowy">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="font-weight-bold text-info text-uppercase mb-1 text-xs">
                                        Saturasi Oksigen</div>
                                    <div class="h5 font-weight-bold mb-0 text-gray-800"><span
                                            id="saturasi_oksigen">{{ $saturasi_oksigen ?? '-' }}</span> %</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Putaran Pedal -->
                <div class="col-auto mb-4">
                    <div class="card border-left-success shadowy">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="font-weight-bold text-success text-uppercase mb-1 text-xs">
                                        Jumlah Putaran Pedal</div>
                                    <div class="h5 font-weight-bold mb-0 text-gray-800"><span
                                            id="putaran_pedal">{{ $putaran_pedal ?? '-' }}</span> kali</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Kalori Terbakar -->
                <div class="col-auto mb-4">
                    <div class="card border-left-danger shadowy">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="font-weight-bold text-danger text-uppercase mb-1 text-xs">
                                        Jumlah Kalori Terbakar</div>
                                    <div class="h5 font-weight-bold mb-0 text-gray-800"><span
                                            id="kalori">{{ $kalori ?? '- ' }}</span> KKal</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Row -->
            <div class="row">
                {{-- DAERAH GRAFIK TOTAL TERAPI --}}
                <div class="col-xl-8 col-lg-7">
                    <div class="card mb-5 shadow">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Total Terapi dalam setiap bulan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <canvas id="total-terapi"></canvas>
                        </div>
                    </div>
                </div>
                {{-- BIODATA PASIEN ADA DISINI  --}}
                <div class="col-xl-4 col-lg-5">
                    <div class="card mb-4 shadow">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Biodata Pasien</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img class="rounded-circle" width="130px"
                                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                </div>
                                <div class="col-md-10 mx-10"><label class="labels">Nama :
                                        @if (Auth::check())
                                            {{ Auth::user()->name }}
                                        @else
                                            '-'
                                        @endif
                                    </label></div>
                                <div class="col-md-10 mx-10"><label class="labels">Umur :
                                        @if ($profile)
                                            {{ $profile->umur }}
                                        @else
                                            '-'
                                        @endif
                                    </label></div>
                                <div class="col-md-10 mx-10"><label class="labels">Berat Badan :
                                        @if ($profile)
                                            {{ $profile->berat_badan }}
                                        @else
                                            '-'
                                        @endif
                                    </label>
                                    </label></div>
                                <div class="col-md-10 mx-10">
                                    <label class="labels">Jenis Kelamin :
                                        @if ($profile)
                                            @if ($profile->jenis_kelamin == 1)
                                                Laki-laki
                                            @elseif ($profile->jenis_kelamin == 2)
                                                Perempuan
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </label>
                                </div>
                                <div class="col-md-10 mx-10"><label class="labels">Riwayat Penyakit :
                                        @if ($profile)
                                            {{ $profile->riwayat_penyakit }}
                                        @else
                                            '-'
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var currentUser = <?= Auth::guard()->user() ?>;
        console.log("current id", currentUser.id)
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: '/detakjantung/' + currentUser.id, // URL untuk mengambil data
                    type: 'GET', // Metode HTTP
                    success: function(data) {
                        console.log(data);
                        $("#detak_jantung").text(data.detak_jantung);
                        $("#jumlah_detak_jantung").text(data.durasi);
                        $("#saturasi_oksigen").text(data.saturasi_oksigen);
                        $("#putaran_pedal").text(data.putaran_pedal);
                        $("#kalori").text(data.kalori);
                    },
                });
            }, 1000); // 1000ms = 1s
        });
        var labels = @json($labels);
        var users = @json($totalTerapi);
        const data = {
            labels: labels,
            datasets: [{
                label: 'Total Terapi',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: users,
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('total-terapi'),
            config
        );
    </script>
@endsection
