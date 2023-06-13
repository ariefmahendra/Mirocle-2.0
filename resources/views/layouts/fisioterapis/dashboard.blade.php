@extends('layouts.fisioterapis.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row w-100 justify-content-center">
        <!-- Jumlah Pasien -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadowy">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="font-weight-bold text-danger text-uppercase mb-1 text-xl">
                                Jumlah Pasien</div>
                            <div class="h5 font-weight-bold mb-0 text-gray-900">{{ $users->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumlah Pasien Laki-laki -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadowy">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="font-weight-bold text-info text-uppercase mb-1 text-xl">
                                Pasien Laki-laki</div>
                            <div class="h5 font-weight-bold mb-0 text-gray-900">{{ $jumlahLakiLaki }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumlah Pasien Perempuan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadowy">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="font-weight-bold text-warning text-uppercase mb-1 text-xl">
                                Pasien Perempuan</div>
                            <div class="h5 font-weight-bold mb-0 text-gray-900">{{ $jumlahPerempuan }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4 shadow">
                <!-- Card Header - Dropdown -->
                <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                    <h6 class="font-weight-bold m-0 text-gray-900">Total Pasien Yang Melakukan Terapi Dalam Setiap Bulan
                    </h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="jumlah-pasien"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            < script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" >
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            var labels = @json($labels);
            var terapiData = @json($totalPasienTerapi);
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Total Terapi',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: terapiData,
                }]
            };
            const config = {
                type: 'line',
                data: data,
                options: {}
            };
            const myChart = new Chart(
                document.getElementById('jumlah-pasien'),
                config
            );
        </script>
    @endsection